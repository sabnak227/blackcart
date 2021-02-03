<?php

namespace App\Lib\EcommercePlatform;

class Price
{
    /* @var array $prices */
    protected $prices = [];

    public function setPrice($price, $currency = 'USD') {
        $currency = strtoupper($currency);
        $this->prices[$currency] = $price;
    }

    public function get() {
        $result = [];
        foreach($this->prices as $currency => $price) {
            $result[] = [
                'currency' => $currency,
                'price' => (float) $price,
            ];
        }
        return $result;
    }
}
