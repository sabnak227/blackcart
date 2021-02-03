<?php

namespace App\Lib\EcommercePlatform;

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
                'option' => $key,
                'values' => array_keys($values)
            ];
        }
        return $result;
    }
}
