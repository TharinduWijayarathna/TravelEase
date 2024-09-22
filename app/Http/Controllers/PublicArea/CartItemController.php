<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartItem\CreateCartItem;
use App\Http\Requests\CartItem\UpdateCartItemQuantity;
use domain\Facades\CartFacade\CartFacade;
use domain\Facades\CartItemFacade\CartItemFacade;
use domain\Facades\ProductFacade\ProductFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    /**
     * Store
     * store first cart item whether it has one cart,if is not create cart and store first cart item
     *
     * @param $customer_id
     * @param $product_id
     * @param Request $request
     *
     * @return void
     */
    public function store($customer_id, $product_id, CreateCartItem $request)
    {
        $product = ProductFacade::get($product_id);
        $request['unit_price'] = $product->price;
        $request['unit_discount'] = $product->discount_price;

        $user = Auth::user();
        $request['customer_name'] = $user->first_name . ' ' . $user->last_name;
        $request['customer_address'] = $user->address;
        $request['customer_email'] = $user->email;
        $request['customer_contact_number'] = $user->contact_number;

        $check_exist_cart = CartFacade::find($customer_id);

        if (sizeof($check_exist_cart) === 0) {
            $cart = CartFacade::store($customer_id, $request->all());
            $request['cart_id'] = $cart->id;
            return CartItemFacade::store($product_id, $request->all());
        } else {
            $cart_id = $check_exist_cart[0]->id ;
            $exist_cart_item = CartItemFacade::find($product_id, $cart_id);

            if (sizeOf($exist_cart_item) === 0) {
                $request['cart_id'] = $check_exist_cart[0]->id;
                return CartItemFacade::store($product_id, $request->all());
            } else {
                return CartItemFacade::update($product_id, $request->all());
            }
        }
    }

    /**
     * Get
     * get the cart_id according to the customer id in cart and get the cart item
     *
     * @param $customer_id
     *
     * @return void
     */
    public function get($customer_id)
    {
        $check_exist_cart = CartFacade::find($customer_id);
        if (sizeof($check_exist_cart) === 0) {
            return 'no items';
        } else {
            $cart_id = $check_exist_cart[0]->id;
            $response['cart_item'] = CartItemFacade::all($cart_id);
            return $response;
        }
    }

    /**
     * UpdateQuantity
     * update the quantity of cart item
     *
     * @param Request $request
     * @param $cart_item_id
     *
     * @return void
     */
    public function updateQuantity(UpdateCartItemQuantity $request, $cart_item_id)
    {
        CartItemFacade::updateQuantity($request->all(), $cart_item_id);
        $cart_item = CartItemFacade::findCart($cart_item_id);
        $cart_id = $cart_item->cart_id;
        $cart_items = CartItemFacade::getCartItems($cart_id);
        return CartFacade::update($cart_items, $cart_id);
    }

    /**
     * DeleteAll
     * delete all cart items according to cart_id
     *
     * @param $cart_id
     *
     * @return void
     */
    public function deleteAll($cart_id)
    {
        return CartItemFacade::delete($cart_id);
    }

    /**
     * DeleteItem
     * delete selected cart item
     *
     * @param $cart_item_id
     *
     * @return void
     */
    public function deleteItem($cart_item_id)
    {
        return CartItemFacade::deleteItem($cart_item_id);
    }

    /**
     * Count
     * count the cart item that not purchased by customer
     *
     * @param $customer_id
     *
     * @return void
     */
    public function count($customer_id)
    {
        $cart = CartFacade::find($customer_id);
        if (isset($cart[0])) {
            $cart_id = $cart[0]->id;
            return CartItemFacade::count($cart_id);
        }else{
            return 0;
        }
    }

    /**
     * Fnd
     * find the product according to the product_id and customer_id
     *
     * @param $product_id
     * @param $customer_id
     *
     * @return void
     */
    public function find($product_id, $customer_id)
    {
        $cart = CartFacade::find($customer_id);
        if (sizeof($cart) === 0) {
            return response()->json(['message' => 'cart not found', 'status' => '404']);
        } else {
            $cart_id = $cart[0]->id ;
            $cart_item = CartItemFacade::find($product_id, $cart_id);
            if (sizeof($cart_item) === 0) {
                return response()->json(['message' => 'cart item found', 'status' => '404']);
            } else {
                return response()->json(['message' => 'cart item found', 'status' => '200', 'data' => $cart_item]);
                return $cart_item;
            }
        }
    }
}
