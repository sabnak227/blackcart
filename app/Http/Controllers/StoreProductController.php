<?php

namespace App\Http\Controllers;

use App\Lib\EcommercePlatform\Adapters\EcommerceFactory;
use App\Models\Store;

class StoreProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Store $store
     * @return \Illuminate\Http\Response
     */
    public function index(Store $store)
    {
        $instance = EcommerceFactory::getInstance($store);
        return $instance->listProducts();
    }
}
