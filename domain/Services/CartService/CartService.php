<?php

namespace domain\Services\CartService;

use App\Models\Cart;

class CartService
{

    protected $cart;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->cart = new Cart();
    }

    /**
     * Find
     * find the cart that equal with passed customer id and status 0 
     *
     * @param int $customer_id 
     *
     * @return void
     */
    public function find(int $customer_id)
    {
        return $this->cart->where('customer_id', $customer_id)->where('status', 0)->get();
    }

    /**
     * Get
     * get cart according to cart_id and status equal to 0
     *
     * @param $cart_id
     *
     * @return void
     */
    public function get(int $cart_id)
    {
        return $this->cart->where('id', $cart_id)->where('status', 0)->with('Customer')->first();
    }

    /**
     * Store
     * store new data with customer_id 
     *
     * @param int $customer_id
     * @param array $data 
     *
     * @return void
     */
    public function store(int $customer_id, array $data)
    {
        if (isset($data['quantity'])) {
            if ($data['quantity'] > 1) {
                $quantity = $data['quantity'];
            } else {
                $quantity = 1;
            }
        } else {
            $quantity = 1;
        }

        $status = 0;
        $sub_total = $data['unit_price'] * $quantity;
        $total = $sub_total - $data['unit_discount'];

        return $this->cart->create([
            'customer_id' => $customer_id,
            'status' => $status,
            'created_by' => $data['created_by'],
            'quantity' => $quantity,
            'sub_total' => $sub_total,
            'total' => $total,
            'customer_name' => $data['customer_name'],
            'customer_address' => $data['customer_address'],
            'customer_email' => $data['customer_email'],
            'customer_contact_number' => $data['customer_contact_number'],
        ]);
    }

    /**
     * Update
     * update calculated values
     *
     * @param $data $data 
     * @param $cart_id $cart_id 
     *
     * @return void
     */
    public function update($data, $cart_id)
    {
        $cart = $this->cart->where('status', 0)->where('id', $cart_id)->get();

        $sub_total = 0;
        $quantity = 0;

        foreach ($data as $key => $value) {
            $sub_total = $sub_total + $value->total;
            $quantity = $quantity + $value->quantity;
        }

        // main $discount not define yet, until assume total as sub_total
        // $total = $sub_total - $discount; 
        return $cart[0]->update([
            'total' => $sub_total,
            'sub_total' => $sub_total,
            'quantity' => $quantity,
        ]);
    }

    public function updateClosedCarts($data, $cart_id)
    {
        $cart = $this->cart->where('id', $cart_id)->get();

        $sub_total = 0;
        $quantity = 0;

        foreach ($data as $key => $value) {
            $sub_total = $sub_total + $value->total;
            $quantity = $quantity + $value->quantity;
        }

        $cart[0]->update([
            'total' => $sub_total,
            'sub_total' => $sub_total,
            'quantity' => $quantity,
        ]);

        return $this->cart->find($cart_id);
    }

    /**
     * Delete
     * delete selected cart item
     *
     * @param $cart_id
     *
     * @return void
     */
    public function delete(int $cart_id)
    {
        return $this->cart->destroy($cart_id);
    }

    public function checkOut(int $cart_id)
    {
        $cart = $this->cart->find($cart_id);

        $data['status'] = 1;
        return$cart->update($data);
    }

}