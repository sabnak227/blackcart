<?php

namespace App\Lib\EcommercePlatform;

/**
 * @OA\Schema(
 *     title="Product",
 *     description="Product info",
 *     type="object",
 * )
 */
class Product
{
    /**
     * @OA\Property(
     *      title="id",
     *      description="product id",
     *      example="1"
     * )
     *
     * @var int
     */
    protected $id;

    /**
     * @OA\Property(
     *      title="name",
     *      description="product name",
     *      example="product"
     * )
     *
     * @var string
     */
    protected $name;

    /**
     * @OA\Property(
     *      property="price",
     *      description="product price in different currencies",
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/Price")
     * )
     *
     * @var Price
     */
    protected $price;


    /**
     * @OA\Property(
     *      title="inventory",
     *      description="product inventory, when inventory >= 0, product in stock with quantity,
     *                   else stock is not being tracked",
     *      example="10"
     * )
     *
     * @var int
     */
    protected $inventory;

    /**
     * @OA\Property(
     *      property="option",
     *      description="product options",
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/Option")
     * )
     *
     * @var Option
     */
    protected $option;

    /**
     * @OA\Property(
     *      title="weight",
     *      description="product weight",
     *      example="100"
     * )
     *
     * @var int
     */
    protected $weight;


    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setPrice(Price $price) {
        $this->price = $price;
        return $this;
    }

    public function setInventory($inventory) {
        $this->inventory = $inventory;
        return $this;
    }

    public function setOption(Option $option) {
        $this->option = $option;
        return $this;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
        return $this;
    }

    public function get() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price->get(),
            'inventory' => $this->inventory,
            'option' => $this->option->get(),
            'weight' => $this->weight,
        ];
    }
}
