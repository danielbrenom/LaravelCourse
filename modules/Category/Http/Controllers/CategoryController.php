<?php

namespace Modules\Category\Http\Controllers;

use App\Domain\Models\Tables\Category;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->showAll(Category::all());
    }


    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required',
            'description' => 'required'
        ];
        $this->validate($request, $rules);
        $category = new Category();
        $category->fill($request->all())->save();
        return $this->showOne($category, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return $this->showOne($category);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $rules = ['name', 'description'];
        $category->fill($request->only($rules));
        if ($category->isClean()) {
            return $this->errorResponse(trans('messages.model.no_update'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $category->save();
        return $this->showOne($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category);
    }
}
