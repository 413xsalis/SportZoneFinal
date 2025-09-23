<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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
     * Manejo de errores personalizados
     */
    public function render($request, Throwable $exception)
    {
        // Si no está autenticado → al login
        if ($exception instanceof AuthenticationException) {
            return redirect()->route('login');
        }

        // Si la ruta no existe (404) → al login
        if ($exception instanceof NotFoundHttpException) {
            return redirect()->route('login');
        }

        // Si no tiene permisos (403/401) → al login
        if ($exception instanceof HttpException && in_array($exception->getStatusCode(), [401, 403])) {
            return redirect()->route('login');
        }

        return parent::render($request, $exception);
    }
}
