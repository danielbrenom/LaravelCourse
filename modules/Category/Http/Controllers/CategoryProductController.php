<?php


namespace Modules\Category\Http\Controllers;

use App\Domain\Models\Tables\Category;
use App\Http\Controllers\ApiBaseController;

class CategoryProductController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index']);
    }

    public function index(Category $category){
        return $this->showAll($category->products);
    }
}