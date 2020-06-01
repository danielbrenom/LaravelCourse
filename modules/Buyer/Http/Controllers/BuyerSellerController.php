<?php


namespace Modules\Buyer\Http\Controllers;

use App\Domain\Models\Tables\Buyer;
use App\Http\Controllers\ApiBaseController;

class BuyerSellerController extends ApiBaseController
{
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()
            ->with('products.seller')
            ->get()
            ->pluck('products.seller')
            ->unique('id')
            ->values();
        return $this->showAll($sellers);
    }
}