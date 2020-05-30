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

    public function show($id): JsonResponse
    {
        $buyer = Buyer::has('transactions')->findOrFail($id);
        return $this->showOne($buyer);
    }
}
