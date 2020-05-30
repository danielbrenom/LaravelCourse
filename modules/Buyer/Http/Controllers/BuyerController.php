<?php

namespace Modules\Buyer\Http\Controllers;

use App\Domain\Models\Tables\Buyer;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\JsonResponse;

class BuyerController extends ApiBaseController
{
    public function index(): JsonResponse
    {
        $buyers = Buyer::has('transactions')->get();
        return $this->showAll($buyers);
    }

    public function show(Buyer $buyer): JsonResponse
    {
        return $this->showOne($buyer);
    }
}
