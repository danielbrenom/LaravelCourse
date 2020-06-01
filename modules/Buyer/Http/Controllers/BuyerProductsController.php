<?php


namespace Modules\Buyer\Http\Controllers;

use App\Domain\Models\Tables\Buyer;
use App\Http\Controllers\ApiBaseController;

class BuyerProductsController extends ApiBaseController
{
    public function index(Buyer $buyer){
        $products = $buyer
            ->transactions()
            ->with('products')
            ->get()
            ->pluck('products');
        return $this->showAll($products);
    }
}