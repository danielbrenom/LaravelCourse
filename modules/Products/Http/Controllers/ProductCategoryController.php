<?php


namespace Modules\Products\Http\Controllers;


use App\Domain\Models\Tables\Category;
use App\Domain\Models\Tables\Product;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductCategoryController extends ApiBaseController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index']);
        $this->middleware('auth:api')->except(['index']);
        $this->middleware("scope:manage-product")->except(['index']);
        $this->middleware('can:add-category,product')->only('update');
        $this->middleware('can:delete-category,product')->only('delete');
    }

    public function index(Product $product){
        return $this->showAll($product->categories);
    }

    public function update(Request $request,Product $product, Category $category){
        //attach apenas adiciona
        //sync adiciona e exclui as outras
        //syncWithoutDetaching adiciona sem retirar
        $product->categories()->syncWithoutDetaching([$category->id]);
        return $this->showAll($product->categories);
    }

    public function destroy(Product $product, Category $category){
        if(!$product->categories()->find($category->id)){
            return $this->errorResponse("Product don't have this category", Response::HTTP_NOT_FOUND);
        }
        $product->categories()->detach([$category->id]);
        return $this->showAll($product->categories);
    }
}