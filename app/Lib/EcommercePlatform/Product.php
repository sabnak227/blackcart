<?php

namespace App\Lib\EcommercePlatform;

class Product
{
    /* @var int $id */
    protected $id;

    /* @var string $name */
    protected $name;

    /* @var Price $price */
    protected $price;

    /* @var int $inventory
     * $inventory >= 0 -> in stock with quantity
     * $inventory < 0 -> stock is not being tracked
     */
    protected $inventory;

    /* @var Option $option */
    protected $option;

    /* @var int $weight */
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
