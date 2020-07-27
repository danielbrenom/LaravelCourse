<?php


namespace Modules\Products\Http\Controllers;


use App\Domain\Models\Tables\Product;
use App\Http\Controllers\ApiBaseController;

class ProductBuyerController extends ApiBaseController
{
    public function index(Product $product)
    {
        $buyers = $product->transactions()
            ->with('buyer')
            ->get()
            ->pluck('buyer')
            ->unique('id')
            ->values();
        return $this->showAll($buyers);
    }
}