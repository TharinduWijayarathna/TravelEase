<?php

namespace domain\Facades\WishListFacade;

use domain\Services\WishListService\WishListService;
use Illuminate\Support\Facades\Facade;

class WishListFacade extends Facade{
    
    /**
     * GetFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return WishListService::class;
    }
}