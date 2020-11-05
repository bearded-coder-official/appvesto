<?php

namespace App\Exceptions;

use Exception;
use App\Support\ApiErrorHandlerFacade;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        if($request->is('api/*')) {
            if ($exception instanceof ModelNotFoundException) {
                $error = $exception->getModel();
                $model = explode("\\",$error)[3];
                if($model == 'Event'){
                    return ApiErrorHandlerFacade::error('EVENT_ERRORS', 'EVENT_NOT_FOUND');
                }
            }

            if($exception instanceof TransformerException) {
                return ApiErrorHandlerFacade::error('TRANSFORMER_ERRORS', $exception->getMessage());
            }

        }

        return parent::render($request, $exception);
    }
}
