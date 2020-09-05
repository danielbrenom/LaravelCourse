<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

trait ApiResponser
{
    private function successResponse($data, $code): JsonResponse
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code): JsonResponse
    {
        return response()->json(['error' => $message], $code);
    }

    protected function showAll(Collection $collection, $code = Response::HTTP_OK): JsonResponse
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }
        $collection = $this->filterData($collection, $collection->first()->transformer);
        $collection = $this->sortData($collection, $collection->first()->transformer);
        $collection = $collection->map(function ($element) {
            return $this->transformData($element, $element->transformer);
        });
        $collection = $this->cacheResponse($collection);
        return $this->successResponse(['data' => $this->paginate($collection)], $code);
    }

    protected function showOne(Model $model, $code = Response::HTTP_OK): JsonResponse
    {
        return $this->successResponse(['data' =>
            $this->transformData($model, $model->transformer)
        ], $code);
    }

    protected function filterData(Collection $collectionm, $transformer): Collection
    {
        foreach (request()->query() as $query => $value) {
            $attribute = $transformer::originalAttributes($query);
            if (isset($attribute, $value)) {
                $collectionm = $collectionm->where($attribute, $value)->values();
            }
        }
        return $collectionm;
    }

    protected function sortData(Collection $collection, $transformer): Collection
    {
        if (request()->has('sort')) {
            $sort = $transformer::originalAttributes(request()->sort);
            $collection = $collection->sortBy->{$sort};
        }
        return $collection;
    }

    protected function showMessage($message, $code = Response::HTTP_OK): JsonResponse
    {
        return $this->successResponse(['data' => $message], $code);
    }

    protected function paginate(Collection $collection): LengthAwarePaginator
    {
        Validator::validate(request()->all(), [
            'per_page' => 'integer|min:2|max:50'
        ]);
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = data_get(request()->all(), 'per_page', 15);
        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();
        $paginator = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);
        $paginator->appends(request()->all());
        return $paginator;
    }

    protected function transformData($data, $transformer): array
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray()['data'];
    }

    protected function cacheResponse($data)
    {
        $url = request()->url();
        $query = request()->query();
        ksort($query);
        $queryString = http_build_query($query);
        return Cache::remember("{$url}?{$queryString}", 30, static function () use ($data) {
            return $data;
        });
    }
}
