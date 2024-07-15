<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Contracts\Container\BindingResolutionException;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Handle 404 errors
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('admin.pages.exceptions.404', [], 404);
        }

        // Handle 403 errors
        if ($exception instanceof HttpException && $exception->getStatusCode() === 403) {
            return response()->view('admin.pages.exceptions.403', [], 403);
        }
        if ($exception instanceof BindingResolutionException) {
            // Customize the message or any additional data as needed
            return response()->view('admin.pages.exceptions.403', [], 500);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }

        return redirect()->guest(route('welcome'));
    }
}
