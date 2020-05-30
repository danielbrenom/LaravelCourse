<?php

namespace Modules\Seller\Http\Controllers;

use App\Domain\Models\Tables\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SellerController extends Controller
{

    public function index(): JsonResponse
    {
        $seller = Seller::has('products')->get();
        return response()->json(['data' => $seller], Response::HTTP_OK);
    }

    public function show($id): JsonResponse
    {
        $seller = Seller::has('products')->findOrFail($id);
        return response()->json(['data' => $seller], Response::HTTP_OK);
    }
}
