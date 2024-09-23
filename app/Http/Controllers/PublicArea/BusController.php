<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\FilterProductRequest;
use App\Http\Requests\Product\SearchProductRequest;
use App\Models\Product;
use domain\Facades\ProductFacade\ProductFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BusController extends Controller
{
    /**
     * index
     * load the single product page
     *
     * @return void
     */
    public function index()
    {
        return Inertia::render('PublicArea/Buses/index');
    }

    /**
     * SingleProduct
     * get the selected product using product_id
     *
     * @param $product_id
     *
     * @return void
     */
    public function singleProduct($product_id)
    {
        $response['product'] = ProductFacade::get($product_id);
        return Inertia::render('PublicArea/Buses/singleProduct', $response);
    }

    /**
     * All
     * get the all products
     *
     * @return void
     */
    public function all()
    {
        // $response['product'] = ProductFacade::all();
        // return $response;

        $query = Product::with('Category', 'ProductImage', 'ProductImage.Image', 'WishList', 'CartItem', 'CartItem.Cart')
                        ->orderBy('products.id', 'desc');

        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(
                AllowedFilter::callback('search', function ($query, $value){
                    $query->orWhere('id', 'like', "%{$value}%");
                })
            )
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return $payload;
    }

    /**
     * Get
     * Get specific product using product_id
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
     * Filter
     * filter the item according to customer request
     *
     * @param FilterProductRequest $request
     *
     * @return void
     */
    public function filter(FilterProductRequest $request)
    {
        // $response['filtered_product'] = ProductFacade::filter($request->all());

        $query = Product::with('Category', 'ProductImage', 'ProductImage.Image')
        ->orderBy('products.id', 'desc');

        $availability = $request->input('params.filterForm.availability');
        $min_price = $request->input('params.filterForm.min_price');
        $max_price = $request->input('params.filterForm.max_price');
        $selected_category = $request->input('params.filterForm.selected_category');

        if (isset ($min_price) && $min_price !== '') {
            $query->where('price', '>=', $min_price);
        }

        if (isset ($max_price) && $max_price !== '') {
            $query->where('price', '<=', $max_price);
        }

        if (isset ($availability) && $availability == 'on_stock') {
            $query->where('quantity', '>=', 1);
        }

        if (isset ($selected_category) && !empty ($selected_category)) {
            $query->whereIn('category_id', $selected_category);
        }

        $payload = QueryBuilder::for($query)
            ->allowedSorts(['id', 'name'])
            ->allowedFilters(
                AllowedFilter::callback('search', function ($query, $value){
                    $query->orWhere('id', 'like', "%{$value}%");
                })
            )
            ->paginate(request('per_page', config('basic.pagination_per_page')));
        return $payload;

    }

    /**
     * Search
     * search and get item according to customer request
     *
     * @param SearchProductRequest $request
     *
     * @return void
     */
    public function search(SearchProductRequest $request)
    {
        $response['searched_product'] = ProductFacade::search($request->all());
        return $response;
    }
}
