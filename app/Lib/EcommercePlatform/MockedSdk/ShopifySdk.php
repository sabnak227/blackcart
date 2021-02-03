<?php
namespace App\Lib\EcommercePlatform\MockedSdk;

use Illuminate\Support\Facades\Storage;

class ShopifySdk
{
    /**
     * load products from mocked shopify api
     *
     * load data from shopify product list endpoint:
     *      /admin/api/2020-10/products.json
     * src:
     *      https://shopify.dev/docs/admin-api/rest/reference/products/product#index-2020-10
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function listProducts() {
        $json = Storage::disk('local')->get('shopify.json');
        return json_decode($json, true);
    }
}
