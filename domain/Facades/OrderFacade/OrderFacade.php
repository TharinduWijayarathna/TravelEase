<?php

namespace domain\Facades\OrderFacade;
use domain\Services\OrderService\OrderService;
use Illuminate\Support\Facades\Facade;

class OrderFacade extends Facade{
        
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    public static function getFacadeAccessor(){
        return OrderService::class;
    }
}