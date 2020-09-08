<?php


namespace Modules\Seller\Http\Controllers;


use App\Domain\Models\Tables\Seller;
use App\Http\Controllers\ApiBaseController;

class SellerBuyerController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(Seller $seller)
    {
        $this->allowAdminAction();
        $buyers = $seller->products()
            ->whereHas('transactions')
            ->with('transactions.buyer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values();
        return $this->showAll($buyers);
    }

}