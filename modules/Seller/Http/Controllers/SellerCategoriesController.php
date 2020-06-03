<?php


namespace Modules\Seller\Http\Controllers;


use App\Domain\Models\Tables\Seller;
use App\Http\Controllers\ApiBaseController;

class SellerCategoriesController extends ApiBaseController
{
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