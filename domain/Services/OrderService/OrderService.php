<?php

namespace domain\Services\OrderService;

use App\Models\Order;

class OrderService
{

    protected $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function store($data)
    {
        if (isset($data['customer_code'])) {
            $customer_code = $data['customer_code'];
            $customer_name = $data['customer_name'];
            $customer_email = $data['customer_email'];
            $cart_id = $data['cart_id'];
            $customer_id = $data['id'];
            $total = 0;
        } else {
            $customer_code = $data->customer['code'];
            $customer_name = $data->customer_name;
            $customer_email = $data->customer_email;
            $total =  $data->total;
            $cart_id =  $data->id;
            $customer_id =  $data->customer_id;
        }

        $count = $this->order->count();
        $code = 'OD' . sprintf('%05d', $count + 1);
        $check = $this->order->where('code', $code)->first();

        while ($check) {
            $count++;
            $code = 'OD' . sprintf('%05d', $count);
            $check = $this->order->where('code', $code)->first();
        }

        return $this->order->create([
            'code' => $code,
            'customer_code' => $customer_code,
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'total' => $total,
            'cart_id' => $cart_id,
            'customer_id' => $customer_id,
        ]);
    }

    public function check(int $cart_id)
    {
        return $this->order->where('cart_id', $cart_id)->first();
    }

    public function find($order_id)
    {
        return $this->order->find($order_id);
    }

    public function paidUpdate(int $order_id)
    {
        $order = $this->order->find($order_id);
        if ($order->is_paid == 1) {
            $is_paid = 0;
        } else {
            $is_paid = 1;
        }


        return $order->update([
            'is_paid' => $is_paid,
        ]);
    }

    public function shippedUpdate(int $order_id)
    {
        $if_paid = $order = $this->order->where('is_paid', 1)->where('id', $order_id)->first();

        if ($if_paid) {

            $order = $this->order->find($order_id);

            if ($order->is_shipped == 1) {
                $is_shipped = 0;
            } else {
                $is_shipped = 1;
            }

            return $order->update([
                'is_shipped' => $is_shipped,
            ]);
        }
    }

    public function get(int $order_id)
    {
        return $this->order->where('id', $order_id)->first();
    }

    public function delete(int $order_id)
    {
        return $this->order->destroy($order_id);
    }
    public function updateTotal($updated_cart, int $order_id)
    {
        $selected_order = $this->order->find($order_id);
        return $selected_order->update(['total' => $updated_cart->total]);
    }

    public function update(int $order_id, array $data)
    {
        $selected_order = $this->order->find($order_id);
        return $selected_order->update($data);
    }
}