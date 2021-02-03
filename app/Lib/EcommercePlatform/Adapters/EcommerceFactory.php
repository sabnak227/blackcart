<?php

namespace App\Lib\EcommercePlatform\Adapters;

use App\Models\Store;
use Mockery\Exception;

class EcommerceFactory
{
    /**
     * Factory methods to get instance of ecommerce platform adapter based on the store passed in
     *
     * @param Store $store
     * @return EcommerceAdapterContract
     */
    public static function getInstance(Store $store) : EcommerceAdapterContract{
        switch($store->platform){
            case 'shopify':
                return app(Shopify::class);
            case 'woocommerce':
                return app(WooCommerce::class);
            default:
                throw new Exception("not handlled platform");
        }
    }
}
