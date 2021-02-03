<?php

namespace App\Providers;

use App\Lib\EcommercePlatform\Adapters\Shopify;
use App\Lib\EcommercePlatform\Adapters\WooCommerce;
use App\Lib\EcommercePlatform\Adapters\WooCommerceSdk;
use App\Lib\EcommercePlatform\MockedSdk\ShopifySdk;
use Illuminate\Support\ServiceProvider;

class EcommerceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Shopify::class, function ($app) {
            $sdk = new ShopifySdk();
            return new Shopify($sdk);
        });

        $this->app->singleton(WooCommerce::class, function ($app) {
            $sdk = new WooCommerceSdk();
            return new WooCommerce($sdk);
        });
    }
}
