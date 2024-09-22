<?php

namespace domain\Facades\CartFacade;
use domain\Services\CartService\CartService;
use Illuminate\Support\Facades\Facade;

class CartFacade extends Facade{
        
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    public static function getFacadeAccessor(){
        return CartService::class;
    }
}