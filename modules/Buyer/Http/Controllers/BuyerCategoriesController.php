<?php


namespace Modules\Buyer\Http\Controllers;

use App\Domain\Models\Tables\Buyer;
use App\Http\Controllers\ApiBaseController;

class BuyerCategoriesController extends ApiBaseController
{
    public function index(Buyer $buyer)
    {
        $products = $buyer
            ->transactions()
            ->with('products.categories')
            ->get()
            ->pluck('products.categories')
            ->collapse()
            ->unique('id')
            ->values();
        return $this->showAll($products);
    }
}