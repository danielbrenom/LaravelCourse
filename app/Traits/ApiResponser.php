<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

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
        $collection = $collection->map(function ($element) {
            return $this->transformData($element, $element->transformer);
        });
        return $this->successResponse(['data' => $collection], $code);
    }

    protected function showOne(Model $model, $code = Response::HTTP_OK): JsonResponse
    {
        return $this->successResponse(['data' =>
            $this->transformData($model, $model->transformer)
        ], $code);
    }

    protected function showMessage($message, $code = Response::HTTP_OK): JsonResponse
    {
        return $this->successResponse(['data' => $message], $code);
    }

    protected function transformData($data, $transformer): array
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray()['data'];
    }
}
