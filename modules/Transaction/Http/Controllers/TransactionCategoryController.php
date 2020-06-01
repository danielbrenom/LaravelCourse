<?php


namespace Modules\Transaction\Http\Controllers;

use App\Domain\Models\Tables\Transaction;
use App\Http\Controllers\ApiBaseController;

class TransactionCategoryController extends ApiBaseController
{
    public function index(Transaction $transaction){
        return $this->showAll($transaction->products->categories);
    }
}