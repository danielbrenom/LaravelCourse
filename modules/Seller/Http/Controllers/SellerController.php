<?php

namespace Modules\Seller\Http\Controllers;

use App\Domain\Models\Tables\Seller;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\JsonResponse;

class SellerController extends ApiBaseController
{

    public function index(): JsonResponse
    {
        $seller = Seller::has('products')->get();
        return $this->showAll($seller);
    }

    public function show($id): JsonResponse
    {
        $seller = Seller::has('products')->findOrFail($id);
        return $this->showOne($seller);
    }
}
