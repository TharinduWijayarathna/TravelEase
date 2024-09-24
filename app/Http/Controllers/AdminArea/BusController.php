<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\AllProductResource;
use domain\Facades\ImageFacade\ImageFacade;
use domain\Facades\ProductFacade\ProductFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Product;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class BusController extends ParentController
{
    /**
     * Index
     * load admin product section
     *
     * @return void
     */
    public function index()
    {
        return Inertia::render('AdminArea/Product/index');

    }

    /**
     * Store
     * store product data
     *
     * @param CreateProductRequest $request
     *
     * @return void
     */
    public function store(CreateProductRequest $request)
    {
        return ProductFacade::store($request->all());
    }

    /**
     * All
     * retrieve all products
     *
     * @return void
     */
    public function all()
    {
        $query = Product::with('Category', 'ProductImage', 'ProductImage.Image', 'WishList', 'CartItem', 'CartItem.Cart')
                        ->orderBy('products.id', 'desc');


        if(request('code')){
            $code = request('code');
            $query->where('code', 'like', "%{$code}%");
        }

        if(request('product_name')){
            $product_name = request('product_name');
            $query->where('name', 'like', "%{$product_name}%");
        }

        if(request('category_name')){
            $category_name = request('category_name');
            $query->whereHas('Category', function ($q) use ($category_name){
                $q->where('name', 'like', "%{$category_name}%");
            });
        }

        if(request('status')){

            $status = request('status');
            if($status == "1"){
                $query->where('status', 1);
            }else{
                $query->where('status', 0);
            }
        }

        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(
                AllowedFilter::callback('search', function ($query, $value){
                    $query->orWhere('id', 'like', "%{$value}%");
                    $query->orWhere('code', 'like', "%{$value}%");
                    $query->orWhere('name', 'like', "%{$value}%");
                    $query->orWhere('category_name', 'like', "%{$value}%");
                    $query->orWhere('status', $value);
                })
            )
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return $payload;
    }

    /**
     * Edit
     * get the specific data using product_id and load the product edit section
     *
     * @param $product_id
     *
     * @return void
     */
    public function edit($product_id)
    {
        $response['product'] = ProductFacade::edit($product_id);
        return inertia::render('AdminArea/Product/edit', $response);
    }

    /**
     * Get
     * retrive relevent data using product_id
     *
     * @param $product_id
     *
     * @return void
     */
    public function get($product_id)
    {
        return ProductFacade::get($product_id);
    }

    /**
     * Method update
     * update product details using product_id
     *
     * @param UpdateProductRequest $request
     * @param $product_id
     *
     * @return void
     */
    public function update(UpdateProductRequest $request, $product_id,)
    {
        return ProductFacade::update($request->all(),$product_id);
    }

    /**
     * Delete
     * delete specific data using product_id
     *
     * @param $product_id
     *
     * @return void
     */
    public function delete($product_id)
    {
        return ProductFacade::delete($product_id);
    }

}
