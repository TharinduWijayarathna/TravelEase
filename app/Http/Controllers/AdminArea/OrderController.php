<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use domain\Facades\CartFacade\CartFacade;
use domain\Facades\CustomerFacade\CustomerFacade;
use domain\Facades\OrderFacade\OrderFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrderController extends Controller
{
    public function index()
    {
        return Inertia::render('AdminArea/Orders/index');
    }

    public function all()
    {
        $query = Order::orderBy('id', 'desc');

        if (request('code')) {
            $code = request('code');
            $query->where('code', 'like', "%{$code}%");
        }

        if (request('date_from') && request('date_to')) {
            $date_from = request('date_from');
            $date_to = request('date_to');
            $query->whereBetween('created_at', [$date_from, $date_to]);
        }

        if (request('customer_name')) {
            $customer_name = request('customer_name');
            $query->where('customer_name', 'like', "%{$customer_name}%");
        }

        if (request('is_paid')) {

            $status = request('is_paid');
            if ($status == 1) {
                $query->where('is_paid', 1);
            } else {
                $query->where('is_paid', 0);
            }
        }

        if (request('is_shipped')) {

            $status = request('is_shipped');
            if ($status == 1) {
                $query->where('is_shipped', 1);
            } else {
                $query->where('is_shipped', 0);
            }
        }

        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->orWhere('id', 'like', "%{$value}%");
                    $query->orWhere('code', 'like', "%{$value}%");
                    $query->orWhere('customer_name', 'like', "%{$value}%");
                    $query->orWhere('is_paid', 'like', "%{$value}%");
                    $query->orWhere('date', 'like', "%{$value}%");
                    $query->orWhere('customer_code', 'like', "%{$value}%");
                    $query->orWhere('is_shipped', $value);
                })
            )
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return $payload;
    }

    public function edit($order_id)
    {
        $response['order'] = OrderFacade::find($order_id);
        return Inertia::render('AdminArea/Orders/edit', $response);
    }

    public function update($order_id, Request $request)
    {
        return OrderFacade::update($order_id, $request->all());
    }

    public function getCartItem($order_id)
    {
        $cart_id = Order::where('id', $order_id)->pluck('cart_id');
        $query = CartItem::where('cart_id', $cart_id)->orderBy('id', 'desc')->with('Product');

        if (request('item_name')) {
            $item_name = request('item_name');
            $query->whereHas('product', function ($q) use ($item_name) {
                $q->where('name', 'like', "%{$item_name}%");
            });
        }

        if (request('item_code')) {
            $item_code = request('item_code');
            $query->whereHas('product', function ($q) use ($item_code) {
                $q->where('code', 'like', "%{$item_code}%");
            });
        }

        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->orWhere('id', 'like', "%{$value}%");
                    $query->orWhere('code', 'like', "%{$value}%");
                    $query->orWhere('name', 'like', "%{$value}%");
                })
            )
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return $payload;
    }

    public function paidUpdate($order_id)
    {
        return OrderFacade::paidUpdate($order_id);
    }

    public function shippedUpdate($order_id)
    {
        return OrderFacade::shippedUpdate($order_id);
    }

    public function get($order_id)
    {
        return OrderFacade::get($order_id);
    }

    public function find($customer_id)
    {
        $query = Order::where('customer_id', $customer_id)->orderBy('id', 'desc');

        if (request('code')) {
            $code = request('code');
            $query->where('code', 'like', "%{$code}%");
        }

        if (request('date_from') && request('date_to')) {
            $date_from = request('date_from');
            $date_to = request('date_to');
            $query->whereBetween('created_at', [$date_from, $date_to]);
        }
        
        if (request('is_paid')) {

            $status = request('is_paid');
            if ($status == 1) {
                $query->where('is_paid', 1);
            } else {
                $query->where('is_paid', 0);
            }
        }

        if (request('is_shipped')) {

            $status = request('is_shipped');
            if ($status == 1) {
                $query->where('is_shipped', 1);
            } else {
                $query->where('is_shipped', 0);
            }
        }

        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->orWhere('id', 'like', "%{$value}%");
                    $query->orWhere('code', 'like', "%{$value}%");
                    $query->orWhere('is_paid', 'like', "%{$value}%");
                    $query->orWhere('date', 'like', "%{$value}%");
                    $query->orWhere('is_shipped', $value);
                })
            )
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return $payload;
    }

    public function delete($order_id)
    {
        return OrderFacade::delete($order_id);
    }

    public function store($customer_id, Request $request)
    {
        $customer = CustomerFacade::get($customer_id);
        $request['customer_code'] = $customer->code;
        $request['customer_name'] = $request->first_name . ' ' . $request->last_name;
        $request['customer_email'] = $customer->email;
        $request['total'] = 0;
        $request['customer_id'] = $customer_id;
        $request['customer_address'] = $request->address ;
        $request['customer_contact_number'] = $request->contact_number;
        $request['quantity'] = 0;
        $request['unit_price'] = 0;
        $request['unit_discount'] = 0;
        $request['created_by'] = $customer->first_name;
        $new_cart = CartFacade::store($customer_id, $request->all());
        $request['cart_id'] = $new_cart->id;
        return OrderFacade::store($request->all());
    }
}
