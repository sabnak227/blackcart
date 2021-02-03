<?php
namespace App\Lib\EcommercePlatform\Adapters;

use App\Lib\EcommercePlatform\MockedSdk\ShopifySdk;
use App\Lib\EcommercePlatform\Option;
use App\Lib\EcommercePlatform\Price;
use App\Lib\EcommercePlatform\Product;

class Shopify implements EcommerceAdapterContract
{
    protected $sdk;

    public function __construct(ShopifySdk $sdk) {
        $this->sdk = $sdk;
    }

    /**
     * @inheritDoc
     */
    public function listProducts(): array
    {
        $response = $this->sdk->listProducts();
        $results = [];
        foreach($response['products'] as $item) {
            $product = new Product();
            $product->setId($item['id']);
            $product->setName($item['title']);
            $price = new Price();
            $option = new Option();
            // getting cheapest price from variants
            $variants = $item['variants'];
            if(count($variants) > 0) {
                $initial = array_shift($variants);
                $cheapest = array_reduce($variants, function($i, $j) {
                    return $i['price'] < $j['price'] ? $i : $j;
                }, $initial);
                foreach($cheapest['presentment_prices'] as $p) {
                    $price->setPrice($p['price']['amount'], $p['price']['currency_code']);
                }
                $product->setPrice($price);

                // getting inventory of the variant with most inventory
                $mostInventory = array_reduce($variants, function($i, $j) {
                    return $i['inventory_quantity'] > $j['inventory_quantity'] ? $i : $j;
                }, $initial);
                $product->setInventory($mostInventory['inventory_quantity']);

                foreach($item['options'] as $attribute) {
                    foreach($attribute['values'] as $i) {
                        $option->setOption($attribute['name'], $i);
                    }
                }
                $product->setOption($option);

                // getting the first variant's weight
                $product->setWeight($item['variants'][0]['weight']);
            } else {
                $product->setPrice($price);
                $product->setOption($option);
                $product->setWeight(0);
            }

            $results[] = $product->get();
        }
        return $results;
    }
}
