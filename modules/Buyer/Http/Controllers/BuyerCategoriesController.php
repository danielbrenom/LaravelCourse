<?php


namespace Modules\Buyer\Http\Controllers;

use App\Domain\Models\Tables\Buyer;
use App\Http\Controllers\ApiBaseController;

class BuyerCategoriesController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("scope:read-general")->only(['index']);
        $this->middleware("can:view,buyer")->only(['index']);

    }

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