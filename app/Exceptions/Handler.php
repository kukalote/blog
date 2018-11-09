<?php

namespace App\Exceptions;

use App\Entity\Result;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
//        \Illuminate\Auth\AuthenticationException::class,
//        \Illuminate\Auth\Access\AuthorizationException::class,
//        \Symfony\Component\HttpKernel\Exception\HttpException::class,
//        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
//        \Illuminate\Session\TokenMismatchException::class,
//        \Illuminate\Validation\ValidationException::class,
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
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $result = new Result();
        if ($exception instanceof CustomException) {
            return response()->view('errors.custom', $request, 503);
//            return $exception->render($request);
        }
        if ($exception instanceof CustomJsonException) {
            return $exception->render($request, $exception);
        }

        if ($exception instanceof ModelExtraException) {
            return $exception->render($request, $exception);
        }

        // 参数验证处理
        if ($exception instanceof ValidationException) {
            $errors = $exception->errors();
            while (1) {
                if (!is_string($errors)) {
                    $errors = current($errors);
                }
                break;
            }
            $error = implode($errors);
            $result->setMsg($error);
            return response()->json($result->toArray());
//            return response()->view('errors.custom', $request, 503);
//            return $exception->errors();
        }

        return parent::render($request, $exception);
    }
}
