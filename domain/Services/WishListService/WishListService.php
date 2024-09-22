<?php

namespace domain\Services\WishListService;

use App\Models\WishList;

class WishListService
{

    protected $wish_list;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->wish_list = new WishList();
    }
    
    /**
     * Store
     * store new wish list item to the user list using customer_id, product_id, product, product_image
     *
     * @param $customer_id 
     * @param $product_id
     * @param $product 
     * @param $product_image
     *
     * @return void
     */
    public function store($customer_id, $product_id, $product, $product_image, $data)
    {
        // return $data;

        return $this->wish_list->create([
            'product_name' => $product['name'],
            'status' => 1,
            'product_quantity' => $product['quantity'],
            'product_price' => $product['price'],
            'product_discount' => $product['discount_price'],
            'product_description' => $product['description'],
            'product_image_id' => $product_image['id'],
            'product_id' => $product_id,
            'customer_id' => $customer_id,
            'customer_name' => $data['customer_name'],
            'customer_address' => $data['customer_address'],
            'customer_email' => $data['customer_email'],
            'customer_contact_number' => $data['customer_contact_number'],
        ]);
    }
    
    /**
     * Update
     * update wish list item status as 1 using customer_id and product_id
     *
     * @param $customer_id 
     * @param $product_id 
     *
     * @return void
     */
    public function update($customer_id, $product_id)
    {
        $exist_wish_product = $this->wish_list->where('product_id', $product_id)
            ->where('customer_id', $customer_id)
            ->where('status', 0)
            ->first();

        if ($exist_wish_product) {
            return $exist_wish_product->update([
                'status' => 1
            ]);
        }
    }
    
    /**
     * Remove
     * remove wishlist item using customer_id and product_id
     *
     * @param $customer_id
     * @param $product_id
     *
     * @return void
     */
    public function remove($customer_id, $product_id)
    {
        $exist_wish_list = $this->wish_list->where('product_id', $product_id)->where('customer_id', $customer_id)->first();
        return $exist_wish_list->update([
            'status' => 0,
        ]);
    }
    
    /**
     * Find
     * find specific wishlist item using customer_id and product_id
     *
     * @param $customer_id
     * @param $product_id
     *
     * @return void
     */
    public function find($customer_id, $product_id)
    {
        return $if_exist = $this->wish_list->where('product_id', $product_id)->where('customer_id', $customer_id)->where('status', 0)->get();
    }
    
    /**
     * All
     * retrieve all wishList item with the product image 
     *
     * @param $customer_id
     *
     * @return void
     */
    public function all($customer_id)
    {
        return $this->wish_list->where('customer_id', $customer_id)->with('ProductImage')->get();
    }
    
    /**
     * Delete
     * delete specific wishlist item from database
     *
     * @param $wishList_id
     *
     * @return void
     */
    public function delete($wishList_id)
    {
        return $this->wish_list->destroy($wishList_id);
    }

    public function check($customer_id)
    {
        return $this->wish_list->where('customer_id', $customer_id)->get();
    }

}