<?php
namespace App\Lib\EcommercePlatform\Adapters;

use App\Lib\EcommercePlatform\MockedSdk\WooCommerceSdk;
use App\Lib\EcommercePlatform\Option;
use App\Lib\EcommercePlatform\Price;
use App\Lib\EcommercePlatform\Product;

class WooCommerce implements EcommerceAdapterContract
{
    protected $sdk;

    public function __construct(WooCommerceSdk $sdk) {
        $this->sdk = $sdk;
    }

    /**
     * @inheritDoc
     */
    public function listProducts(): array
    {
        $response = $this->sdk->listProducts();
        $results = [];
        foreach($response as $item) {
            $product = new Product();
            $product->setId($item['id']);
            $product->setName($item['name']);
            $price = new Price();
            // woocommerce product price can be empty
            $price->setPrice($item['price'] != '' ? $item['price'] : 0);
            $product->setPrice($price);
            $stockLevel = $item['manage_stock'] ? $item['stock_quantity'] : -1;
            $product->setInventory($stockLevel);

            $option = new Option();
            if($item['type'] == 'variable') {
                foreach($item['attributes'] as $attribute) {
                    if(!$attribute['visible']) {
                        continue;
                    }
                    foreach($attribute['options'] as $i) {
                        $option->setOption($attribute['name'], $i);
                    }
                }
            }
            $product->setOption($option);

            $product->setWeight($item['weight'] != '' ? $item['weight'] : 0);
            $results[] = $product->get();
        }
        return $results;
    }
}
