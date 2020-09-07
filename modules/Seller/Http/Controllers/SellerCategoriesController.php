<?php


namespace Modules\Seller\Http\Controllers;


use App\Domain\Models\Tables\Seller;
use App\Http\Controllers\ApiBaseController;

class SellerCategoriesController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("scope:read-general")->only(['index']);
    }
    public function index(Seller $seller)
    {
        $categories = $seller->products()
            ->whereHas('categories')
            ->with('categories')
            ->get()
            ->pluck('categories')
            ->collapse()
            ->unique('id')
            ->values();
        return $this->showAll($categories);
    }
}