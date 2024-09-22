<?php

namespace domain\Facades\ProductImageFacade;

use domain\Services\ProductImageService\ProductImageService;
use Illuminate\Support\Facades\Facade;

/**
 * ProductImage Facade
 * php version 8.2.15
 *
 * @category Facade
 * @author   CyberElysium <contact@cyberelysium.com>
 * @license  https://cyberelysium.com Config
 * @link     https://cyberelysium.com
 * */

class ProductImageFacade extends Facade
{
    
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return ProductImageService::class;
    }
}