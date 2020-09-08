<?php


namespace Modules\Products\Http\Controllers;


use App\Domain\Models\Tables\Product;
use App\Http\Controllers\ApiBaseController;

class ProductTransactionController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("scope:read-general")->only(['index']);
    }
    public function index(Product $product)
    {
        $this->allowAdminAction();
        return $this->showAll($product->transactions);
    }
}