<?php


namespace Modules\Seller\Http\Controllers;


use App\Domain\Models\Tables\Seller;
use App\Http\Controllers\ApiBaseController;

class SellerTransactions extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("scope:read-general")->only(['index']);
        $this->middleware('can:view,seller')->only('index');
    }
    public function index(Seller $seller)
    {
        $transactions = $seller->products()
            ->whereHas("transactions")
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();
        return $this->showAll($transactions);
    }
}