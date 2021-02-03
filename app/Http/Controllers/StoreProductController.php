<?php

namespace App\Http\Controllers;

use App\Lib\EcommercePlatform\Adapters\EcommerceFactory;
use App\Models\Store;

class StoreProductController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     *
     * @param Store $store
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *      path="/api/stores/{store_id}/products",
     *      operationId="getStoreProducts",
     *      tags={"Stores"},
     *      summary="Get list of store products",
     *      description="Returns list of store products",
     *      @OA\Parameter(
     *          description="Store id",
     *          in="path",
     *          name="store_id",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found",
     *      ),
     *     )
     */
    public function index(Store $store)
    {
        $instance = EcommerceFactory::getInstance($store);
        return response()->json($instance->listProducts());
    }
}
