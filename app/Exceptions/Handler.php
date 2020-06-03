<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        switch (true) {
            case $exception instanceof ValidationException:
                return $this->convertValidationExceptionToResponse($exception, $request);
                break;
            case $exception instanceof ModelNotFoundException:
                $modelName = strtolower(class_basename($exception->getModel()));
                return $this->errorResponse(trans('messages.model.not_found', ['model' => $modelName]), Response::HTTP_NOT_FOUND);
                break;
            case $exception instanceof AuthenticationException:
                return $this->unauthenticated($request, $exception);
                break;
            case $exception instanceof AuthorizationException:
                return $this->errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
                break;
            case $exception instanceof NotFoundHttpException:
                return $this->errorResponse(trans('messages.http.404'), Response::HTTP_NOT_FOUND);
                break;
            case $exception instanceof MethodNotAllowedHttpException:
                return $this->errorResponse(trans('messages.http.405'), Response::HTTP_METHOD_NOT_ALLOWED);
                break;
            case $exception instanceof HttpException:
                return $this->errorResponse($exception->getMessage(), $exception->getCode());
                break;
            case $exception instanceof QueryException:
                if ($exception->errorInfo[1]) {
                    return $this->errorResponse(trans('messages.query.' . $exception->errorInfo[1]), Response::HTTP_CONFLICT);
                }
                break;
        }
        return config('app.debug') === true ?
            parent::render($request, $exception) :
            $this->errorResponse(trans('messages.http.' . Response::HTTP_INTERNAL_SERVER_ERROR),
                Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request): JsonResponse
    {
        $errors = $e->validator->errors()->getMessages();
        return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse(trans('auth.unauthenticated'), Response::HTTP_UNAUTHORIZED);
    }
}
