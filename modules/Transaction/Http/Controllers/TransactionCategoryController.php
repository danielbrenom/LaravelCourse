<?php


namespace Modules\Transaction\Http\Controllers;

use App\Domain\Models\Tables\Transaction;
use App\Http\Controllers\ApiBaseController;

class TransactionCategoryController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index']);
        $this->middleware("scope:read-general")->only(['index']);
    }

    public function index(Transaction $transaction){
        return $this->showAll($transaction->products->categories);
    }
}