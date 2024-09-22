<?php

namespace domain\Services\ProductImageService;

use App\Models\ProductImage;

class ProductImageService
{

    protected $productImage;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->productImage = new ProductImage();
    }
    
    /**
     * Find
     * retieve specific image using product_id
     *
     * @param $product_id 
     *
     * @return void
     */
    public function find(int $product_id)
    {
        $productImage = $this->productImage->where("product_id", $product_id)->first();
        if ($productImage) {
            return $productImage;
        } else {
            return 0;
        }
    }
    
    /**
     * Store
     * store product image data into database
     *
     * @param $data
     *
     * @return void
     */
    public function store($data)
    {
        return $this->productImage
            ->create($data);
    }
    
    /**
     * All
     * retrieve all data from ProductImage with Product and Image models
     *
     * @param $product_id 
     *
     * @return void
     */
    public function all(int $product_id)
    {
        $product = $this->productImage
            ->where('product_id', $product_id)
            ->with('Product', 'Image')
            ->orderBy('status', 'desc')
            ->get();
        return $product;
    }
    
    /**
     * Delete
     * delete spedific data using image_id
     *
     * @param $image_id
     *
     * @return void
     */
    public function delete(int $product_image_id)
    {
        $product = $this->productImage
            ->where('id', $product_image_id)
            ->first();
        return $product->delete();
    }
    
    /**
     * UpdatePrimaryImage
     * update primary image usig request_id and product_id
     *
     * @param $request_id 
     * @param $product_id 
     *
     * @return void
     */
    public function updatePrimaryImage(int $request_id,int $product_id)
    {
        $requested_primary_image = $this->productImage
            ->where('id', $request_id)->first();
        $current_primary_image = $this->productImage
            ->where('product_id', $product_id)
            ->where('status', 1)
            ->first();
        $current_primary_image->update(['status' => 0]);
        $requested_primary_image->update(['status' => 1]);
    }
}