<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\CartFacade\CartFacade;
use domain\Facades\CartItemFacade\CartItemFacade;
use domain\Facades\OrderFacade\OrderFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Cart
     * load cart section
     * 
     *
     * @return void
     */
    public function cart()
    {
        return Inertia::render('PublicArea/Cart/index');
    }

    /**
     * Get
     * get the cart according to customer id 
     *
     * @param $customer_id
     *
     * @return void
     */
    public function get($customer_id)
    {
        $response['cart'] = CartFacade::find($customer_id);
        return $response;
    }

    /**
     * Delete
     * delete cart item using cart_id
     *
     * @param $cart_id 
     *
     * @return void
     */
    public function delete($cart_id)
    {
        return CartFacade::delete($cart_id);
    }

    /**
     * Update
     * update cart using cart_id
     *
     * @param $cart_id
     *
     * @return void
     */
    public function update($cart_id)
    {
        $cart_items = CartItemFacade::getCartItems($cart_id);
        return CartFacade::update($cart_items, $cart_id);
    }
    
    /**
     * CheckOut
     *
     * @param $cart_id 
     *
     * @return void
     */
    public function checkOut($cart_id)
    {   
        $is_checkOut = OrderFacade::check($cart_id);
        if(!isset($is_checkOut)){
            $data = CartFacade::get($cart_id);
            OrderFacade::store($data);
            return CartFacade::checkOut($cart_id);
        }
    }
}
