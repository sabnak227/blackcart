<?php

namespace App\Lib\EcommercePlatform;

/**
 * @OA\Schema(
 *     title="Option",
 *     description="Product options",
 *     type="object",
 *     @OA\Property(property="name", title="Option name", description="option name", example="Color", type="string"),
 *     @OA\Property(property="value", title="Option value", description="option value", type="array", @OA\Items(
 *          type="string",
 *          example={"red", "yellow"},
 *     )),
 * )
 */
class Option
{
    /* @var array $option */
    protected $option = [];

    public function setOption($key, $value) {
        if(!key_exists($key, $this->option)) {
            $this->option[$key] = [];
        }

        // use array keys to store values in order
        // to make sure there are no duplications
        $this->option[$key][$value] = true;
    }

    public function get() {
        $result = [];
        foreach($this->option as $key => $values) {
            $result[] = [
                'name' => $key,
                'values' => array_keys($values)
            ];
        }
        return $result;
    }
}
