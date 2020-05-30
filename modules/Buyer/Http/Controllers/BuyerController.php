<?php

namespace Modules\Buyer\Http\Controllers;

use App\Domain\Models\Tables\Buyer;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BuyerController extends Controller
{
    public function index(): JsonResponse
    {
        $buyers = Buyer::has('transactions')->get();
        return response()->json(['data' => $buyers], Response::HTTP_OK);
    }

    public function show($id): JsonResponse
    {
        $buyer = Buyer::has('transactions')->findOrFail($id);
        return response()->json(['data' => $buyer], Response::HTTP_OK);
    }
}
