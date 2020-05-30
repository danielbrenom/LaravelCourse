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

    public function show(Seller $seller): JsonResponse
    {
        return $this->showOne($seller);
    }
}
