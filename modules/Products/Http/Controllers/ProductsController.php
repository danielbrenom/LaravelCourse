<?php

namespace Modules\Products\Http\Controllers;

use App\Domain\Models\Tables\Product;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\JsonResponse;

class ProductsController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index', show]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->showAll(Product::all());
    }


    public function show(Product $product): JsonResponse
    {
        return $this->showOne($product);
    }
}
