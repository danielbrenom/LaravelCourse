<?php


namespace Modules\Category\Http\Controllers;

use App\Domain\Models\Tables\Category;
use App\Http\Controllers\ApiBaseController;

class CategoryTransactionController extends ApiBaseController
{
    public function index(Category $category)
    {
        $transactions = $category->products()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->unique('id')
            ->values();
        return $this->showAll($transactions);
    }
}