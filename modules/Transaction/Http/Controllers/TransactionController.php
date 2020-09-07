<?php

namespace Modules\Transaction\Http\Controllers;

use App\Domain\Models\Tables\Transaction;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\JsonResponse;

class TransactionController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("scope:read-general")->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->showAll(Transaction::all());
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function show(Transaction $transaction): JsonResponse
    {
        return $this->showOne($transaction);
    }
}
