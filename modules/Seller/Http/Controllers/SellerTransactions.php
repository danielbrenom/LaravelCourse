<?php


namespace Modules\Seller\Http\Controllers;


use App\Domain\Models\Tables\Seller;
use App\Http\Controllers\ApiBaseController;

class SellerTransactions extends ApiBaseController
{
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