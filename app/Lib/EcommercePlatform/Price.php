<?php

namespace App\Lib\EcommercePlatform;

/**
 * @OA\Schema(
 *     title="Price",
 *     description="Product Price",
 *     type="object",
 *     @OA\Property(property="currency", title="currency", description="Price currency", example="USD", type="string"),
 *     @OA\Property(property="price", title="price",description="Price",example="1.99", type="float")
 * )
 */
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
