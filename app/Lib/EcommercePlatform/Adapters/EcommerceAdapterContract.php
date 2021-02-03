<?php


namespace App\Lib\EcommercePlatform\Adapters;


interface EcommerceAdapterContract
{
    /**
     * Parse product information from ecommerce platforms
     *
     * @return array
     */
    public function listProducts() : array;
}
