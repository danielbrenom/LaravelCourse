<?php


namespace Modules\Transaction\Http\Controllers;

use App\Domain\Models\Tables\Transaction;
use App\Http\Controllers\ApiBaseController;

class TransactionSellerController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("scope:read-general")->only(['index']);
        $this->middleware('can:view,transaction')->only('index');
    }
    public function index(Transaction $transaction){
        return $this->showOne($transaction->products->seller);
    }
}