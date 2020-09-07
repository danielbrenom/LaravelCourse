<?php


namespace Modules\Category\Http\Controllers;

use App\Domain\Models\Tables\Category;
use App\Http\Controllers\ApiBaseController;

class CategorySellerController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("scope:read-general")->only(['index']);
    }
    public function index(Category $category)
    {
        $sellers = $category
            ->products()
            ->with('seller')
            ->get()
            ->pluck('seller')
            ->unique('id')
            ->values();
        return $this->showAll($sellers);
    }
}