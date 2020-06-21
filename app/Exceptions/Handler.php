<?php

namespace App\Exceptions;

use Exception;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            if ($exception instanceof HttpException) {
                $code  = $exception->getStatusCode();
                $message = Response::$statusTexts[$code];

                return $this->errorResponse($message, $code);
            }

            if ($exception instanceof ModelNotFoundException) {
                $model = __(strtolower(class_basename($exception->getModel())));

                return $this->errorResponse(
                    __("No existe ninguna instancia de {$model} con la identificación dada"),
                    Response::HTTP_NOT_FOUND
                );
            }

            if ($exception instanceof AuthorizationException) {
                return $this->errorResponse(
                    $exception->getMessage(),
                    Response::HTTP_FORBIDDEN
                );
            }

            if ($exception instanceof AuthenticationException) {
                return $this->errorResponse(
                    $exception->getMessage(),
                    Response::HTTP_UNAUTHORIZED
                );
            }

            if ($exception instanceof ValidationException) {
                $errors = $exception->validator->errors()->getMessages();

                return $this->errorResponse(
                    $errors,
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            if (env('APP_DEBUG', true)) {
                return parent::render($request, $exception);
            }

            return $this->errorResponse(
                __('Error inesperado. Intenta más tarde'),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        if ($exception instanceof QueryException){
            if ($exception->errorInfo[1] == 1451){
                return back()->with('error', __('No puedes eliminar este recurso, porque está relacionado con otro.'));
            }
        }

        return parent::render($request, $exception);
    }
}
