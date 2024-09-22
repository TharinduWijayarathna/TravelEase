<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartItem\CreateCartItem;
use domain\Facades\CartFacade\CartFacade;
use domain\Facades\CartItemFacade\CartItemFacade;
use domain\Facades\OrderFacade\OrderFacade;
use domain\Facades\ProductFacade\ProductFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function store(CreateCartItem $request)
    { 
        $product_id = $request->id;
        $product = ProductFacade::get($product_id);
        $request['unit_price'] = $request->price;
        $request['unit_discount'] = $product->discount_price;

        $updated_quantity = $product->quantity - $request->quantity;
        $product->update([
            'quantity' => $updated_quantity
        ]);
        $user = Auth::user();
        $request['customer_name'] = $user->first_name . ' ' . $user->last_name;
        $request['customer_address'] = $user->address;
        $request['customer_email'] = $user->email;
        $request['customer_contact_number'] = $user->contact_number;
        $request['created_by'] = $user->first_name . ' ' . $user->last_name;
        CartItemFacade::store($product_id, $request->all());

        $cart_items = CartItemFacade::getCartItems($request->cart_id);
        $updated_cart = CartFacade::updateClosedCarts($cart_items, $request->cart_id);
        return OrderFacade::updateTotal($updated_cart, $request->order_id);
    }
}
