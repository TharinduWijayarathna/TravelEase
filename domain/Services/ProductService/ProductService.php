<?php

namespace domain\Services\ProductService;

use App\Models\Product;

class ProductService
{

    protected $product;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * Store
     * store product data into database
     *
     * FEATURED IS REPRESENT AS 1 AND STANDARD IS 0
     * @param $data
     *
     * @return void
     */
    public function store(array $data)
    {
        if(!isset($data['status'])){
            $data['status'] = false;
        }

        if(!isset($data['featured'])){
            $data['featured'] = false;
        }

        $count = $this->product->count();
        $code = 'PN' . sprintf('%05d', $count + 1);
        $check = $this->product->where('code', $code)->first();

        while($check){
            $count ++;
            $code = 'PN' . sprintf('%05d', $count);
            $check = $this->product->where('code', $code)->first();
        }

        $data['code'] = $code;

        
        return $this->product->create($data);
    }

    public function find($product_id)
    {
        return $this->product->find($product_id);
    }

    /**
     * All
     * retrieve all data from Category, ProductImage, ProductImage, Image models
     *
     * @return void
     */
    public function all()
    {
        return $this->product
            ->with('Category', 'ProductImage', 'ProductImage.Image', 'WishList', 'CartItem', 'CartItem.Cart')
            ->get();
    }

    /**
     * Edit
     * find the specific data to edit prodcut details using product_id
     *
     * @param $product_id
     *
     * @return void
     */
    public function edit(int $product_id)
    {
        return $this->product->find($product_id);
    }

    /**
     * Get 
     * retrieve specifica data using product_id
     *
     * @param $product_id
     *
     * @return void
     */
    public function get(int $product_id)
    {
        return $this->product->with('Category', 'ProductImage', 'ProductImage.Image')->find($product_id);
    }

    /**
     * Update
     * update existing product details using product_id
     *
     * @param $product_id 
     * @param $data 
     *
     * @return void
     */
    public function update(array $data, int $product_id)
    {
        
        $product = $this->product->find($product_id);
        return $product->update($data);
    }

    /**
     * Delete
     * delete specific data using product_id
     *
     * @param $product_id $id [explicite description]
     *
     * @return void
     */
    public function delete(int $product_id)
    {
        return $this->product->destroy($product_id);
    }

    /**
     * Filter
     * filter and return specific products for public end 
     *
     * @param array $data 
     *
     * @return void
     */
    public function filter(array $data)
    {
        $query = $this->product->query();

        if (isset ($data['min_price']) && $data['min_price'] !== '') {
            $query->where('price', '>=', $data['min_price']);
        }

        if (isset ($data['max_price']) && $data['max_price'] !== '') {
            $query->where('price', '<=', $data['max_price']);
        }

        if (isset ($data['availability']) && $data['availability'] == 'on_stock') {
            $query->where('quantity', '>=', 1);
        }

        if (isset ($data['selected_category']) && !empty ($data['selected_category'])) {
            $query->whereIn('category_id', $data['selected_category']);
        }

        $products = $query->with('Category', 'ProductImage', 'ProductImage.Image')->get();

        return $products;
    }

    /**
     * Search
     * search product according to the data['name']
     *
     * @param array $data
     *
     * @return void
     */
    public function search(array $data)
    {
        $product_name = $data['name'];

        if (isset ($product_name)) {
            $filteredProduct = $this->product
                ->where('name', 'like', "%$product_name%")
                ->with('Category', 'ProductImage', 'ProductImage.Image')
                ->get();
        } else {
            return $this->product
                ->with('Category', 'ProductImage', 'ProductImage.Image')
                ->get();
        }

        return $filteredProduct;
    }
    
    /**
     * AdminFilter
     * filter product using product_name, category_name and status
     *
     * @param array $data
     *
     * @return void
     */

}
