<?php

namespace domain\Facades\CartItemFacade;
use domain\Services\CartItemService\CartItemService;
use Illuminate\Support\Facades\Facade;

class CartItemFacade extends Facade{
        
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    public static function getFacadeAccessor(){
        return CartItemService::class;
    }
}