<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImage\CreateProductImageRequest;
use domain\Facades\ImageFacade\ImageFacade;
use domain\Facades\ProductImageFacade\ProductImageFacade;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{    
    
    /**
     * Store
     * store the product image
     *
     * @param CreateProductImageRequest $request
     *
     * @return void
     */
    public function store(CreateProductImageRequest $request)
    {
        $product_id = $request->input('product_id');
        
        $ifExist = ProductImageFacade::find($product_id);
        
        if ($ifExist) {
            $status = 0;
            $image = ImageFacade::store($request->file("image"));
            $request->merge(['image_id' => $image->id, 'status' => $status]);
            return ProductImageFacade::store($request->all());
        } else {
            $status = 1;
            $image = ImageFacade::store($request->file("image"));
            $request->merge(['image_id' => $image->id, 'status' => $status]);
            return ProductImageFacade::store($request->all());
        }
    }
    
    /**
     * All
     * get all the product images using product_id
     *
     * @param $product_id
     *
     * @return void
     */
    public function all($product_id)
    {
        $response['product_image'] = ProductImageFacade::all($product_id);
        return $response;
    }
    
    /**
     * Delete
     * delete specific product image using product_image_id 
     *
     * @param $product_image_id 
     *
     * @return void
     */
    public function delete($product_image_id)
    {
        return ProductImageFacade::delete($product_image_id);
    }
    
    /**
     * Primary
     * change primary image using request_id and product_id
     *
     * @param $request_id
     * @param $product_id
     *
     * @return void
     */
    public function primary($request_id, $product_id)
    {
        ProductImageFacade::updatePrimaryImage($request_id, $product_id);
    }
}
