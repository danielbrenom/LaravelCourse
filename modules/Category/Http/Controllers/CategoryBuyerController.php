<?php


namespace Modules\Category\Http\Controllers;


use App\Domain\Models\Tables\Category;
use App\Http\Controllers\ApiBaseController;

class CategoryBuyerController extends ApiBaseController
{
    public function index(Category $category)
    {
        $buyers = $category->products()
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