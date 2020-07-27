<?php


namespace Modules\Products\Http\Controllers;


use App\Domain\Models\Tables\Product;
use App\Http\Controllers\ApiBaseController;

class ProductTransactionController extends ApiBaseController
{
    public function index(Product $product)
    {
        return $this->showAll($product->transactions);
    }
}