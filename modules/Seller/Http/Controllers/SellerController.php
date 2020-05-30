<?php

namespace Modules\Seller\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $seller = Seller::has('products')->get();
        return response()->json(['data' => $seller], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $seller = Seller::has('products')->findOrFail($id);
        return response()->json(['data' => $seller], Response::HTTP_OK);
    }
}
