<?php

namespace domain\Services\CartItemService;

use App\Models\CartItem;

class CartItemService
{

    protected $cart_item;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->cart_item = new CartItem();
    }

    /**
     * Store
     * store new data
     *
     * @param int $product_id
     * @param array $data 
     *
     * @return void
     */
    public function store(int $product_id, array $data)
    {
        if(isset($data['quantity'])){
            if ($data['quantity'] > 1) {
                $quantity = $data['quantity'];
            } else {
                $quantity = 1;
            }
        }else{
            $quantity = 1;
        }
        
        $sub_total = $data['unit_price'] * $quantity;
        $total_discount = $quantity * $data['unit_discount'];
        $total = $sub_total - $total_discount;
        return $this->cart_item->create([
            'unit_price' => $data['unit_price'],
            'unit_discount' => $data['unit_discount'],
            'total_discount' => $total_discount,
            'cart_id' => $data['cart_id'],
            'quantity' => $quantity,
            'product_id' => $product_id,
            'sub_total' => $sub_total,
            'total' => $total,
        ]);
    }

    /**
     * Find
     * find cart item according to product_id
     *
     * @param $product_id
     *
     * @return void
     */
    public function find($product_id, $cart_id)
    {
        return $this->cart_item->where('product_id', $product_id)->where('cart_id', $cart_id)->get();
    }

    /**
     * Update
     * update calculations
     *
     * @param int $product_id [explicite description]
     * @param array $data [explicite description]
     *
     * @return void
     */
    public function update(int $product_id, array $data)
    {
        $exist_cart_item = $this->cart_item->where('product_id', $product_id)->get();

        if(isset($data['quantity'])){
            if ($data['quantity'] > 1) {
                $quantity = $data['quantity'];
            } else {
                $quantity = $exist_cart_item[0]->quantity + 1;
            }
        }else{
            $quantity = $exist_cart_item[0]->quantity + 1;
        }
        
        $sub_total = $exist_cart_item[0]->unit_price * $quantity;
        $total_discount = $exist_cart_item[0]->unit_discount * $quantity;
        $total = $sub_total - $total_discount;

        return $exist_cart_item[0]->update([
            'quantity' => $quantity,
            'sub_total' => $sub_total,
            'total_discount' => $total_discount,
            'total' => $total,
        ]);
    }

    /**
     * UpdateQuantity
     * update quantity and calculations
     *
     * @param array $array
     * @param int $cart_item_id 
     *
     * @return void
     */
    public function updateQuantity(array $array, int $cart_item_id)
    {

        $cart = $this->cart_item->find($cart_item_id);
        $new_total_discount = $cart->unit_discount * $array['quantity'];
        $new_sub_total = $cart->unit_price * $array['quantity'];
        $new_total = $new_sub_total - $new_total_discount;

        return $cart->update([
            'quantity' => $array['quantity'],
            'sub_total' => $new_sub_total,
            'total_discount' => $new_total_discount,
            'total' => $new_total,
        ]);
    }
    /**
     * All
     * get all recodes according to the cart_id
     * 
     * @param $cart_id $cart_id [explicite description]
     *
     * @return void
     */
    public function all($cart_id)
    {
        return $this->cart_item->where('cart_id', $cart_id)
            ->with('Product', 'Product.ProductImage.Image', 'Cart')
            ->get();
    }

    /**
     * GetCartItems
     * get cart items according to the cart_id
     *
     * @param $cart_id 
     *
     * @return void
     */
    public function getCartItems($cart_id)
    {
        return $this->cart_item->where('cart_id', $cart_id)->get();
    }

    /**
     * FindCart
     * find cart according to cart_id
     *
     * @param $cart_id 
     *
     * @return void
     */
    public function findCart($cart_id)
    {
        return $this->cart_item->find($cart_id);
    }

    /**
     * Get
     * get all data according to the cart id
     *
     * @param $cart_id 
     *
     * @return void
     */
    public function get($cart_id)
    {
        $cart_items = $this->cart_item->where('cart_id', $cart_id)->get();
        return $cart_items;
    }

    /**
     * Count
     * get the count of items of in the cart of specific user
     *
     * @param $user_id 
     *
     * @return void
     */
    public function count($cart_id)
    {
        $cartItems = $this->cart_item->where('cart_id', $cart_id)->get();

        $total = 0;

        if($cartItems){
            foreach($cartItems as $cartItem){
                $total += $cartItem->quantity;
            }
        }
        return $total;
    }

    /**
     * DeleteItem
     * delete cart items one by one
     *
     * @param $cart_item_id 
     *
     * @return void
     */
    public function deleteItem($cart_item_id)
    {
        return $this->cart_item->destroy($cart_item_id);
    }

    /**
     * Delete
     * delete all items according to cart item
     *
     * @param int $cart_id 
     *
     * @return void
     */
    public function delete(int $cart_id)
    {
        return $this->cart_item->where('cart_id', $cart_id)->delete();
    }
}