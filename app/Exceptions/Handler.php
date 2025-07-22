<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {

            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'error' => 'Resource not found.'
                ], 404);
            }

            if ($exception instanceof ValidationException) {
                return response()->json([
                    'error' => 'Validation failed.',
                    'messages' => $exception->errors()
                ], 422);
            }

            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }

        return parent::render($request, $exception);
    }
}