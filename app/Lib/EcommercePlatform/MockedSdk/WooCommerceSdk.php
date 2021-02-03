<?php
namespace App\Lib\EcommercePlatform\MockedSdk;

use Illuminate\Support\Facades\Storage;

class WooCommerceSdk
{
    /**
     * load products from mocked woocommerce api
     *
     * load data from woocommerce product list endpoint:
     *      /wp-json/wc/v3/products
     * src:
     *      https://woocommerce.github.io/woocommerce-rest-api-docs/#list-all-products
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function listProducts() {
        $json = Storage::disk('local')->get('woocommerce.json');
        return json_decode($json, true);
    }
}
