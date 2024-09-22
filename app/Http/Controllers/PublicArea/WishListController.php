<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use domain\Facades\ProductFacade\ProductFacade;
use domain\Facades\ProductImageFacade\ProductImageFacade;
use domain\Facades\WishListFacade\WishListFacade;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WishListController extends Controller
{    
    /**
     * Index
     * load the wishlist page 
     *
     * @return void
     */
    public function index()
    {
        return Inertia::render('PublicArea/Wishlist/index');
    }
    
    /**
     * Add
     * add new wish list item 
     *
     * @param $customer_id 
     * @param $product_id 
     *
     * @return void
     */
    public function add($customer_id, $product_id)
    {
        $exist_wish_list = WishListFacade::find($customer_id, $product_id);

        $user = Auth::user();
        $data['customer_name'] = $user->first_name . ' ' . $user->last_name;
        $data['customer_address'] = $user->address;
        $data['customer_email'] = $user->email;
        $data['customer_contact_number'] = $user->contact_number;

        if(count($exist_wish_list) == 0){
            $product= ProductFacade::get($product_id);
            $product_image= ProductImageFacade::find($product_id);
            return WishListFacade::store($customer_id, $product_id, $product, $product_image, $data);
        }else{
            return WishListFacade::update($customer_id, $product_id);
        }
    }
    
    /**
     * Remove
     * quick remove wishlist item from user selections 
     *
     * @param $customer_id
     * @param $product_id
     *
     * @return void
     */
    public function remove($customer_id, $product_id)
    {
        return WishListFacade::remove($customer_id, $product_id);
    }
    
    /**
     * All
     * retrieve all the wish list items according to the customer_id
     *
     * @param $customer_id 
     *
     * @return void
     */
    public function all($customer_id)
    {
        return WishListFacade::all($customer_id);
    }
    
    /**
     * Delete
     * delete specific wish list item according to the wishList_id
     *
     * @param $wishList_id
     *
     * @return void
     */
    public function delete($wishList_id)
    {
        return WishListFacade::delete($wishList_id);
    }

    public function check($customer_id)
    {
        return WishListFacade::check($customer_id);
    }
}
