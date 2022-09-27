<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Перехват исключения при ошибки валидации( не правильный email или пароль ).
     *
     * @parent /Illuminate/Foundation/Exceptions/Handler.php
     * @throws /Illuminate/Validation/ValidationException.php
     */
    public function render($request, Throwable $e) {
        if ( $e instanceof ValidationException )
            return $this->invalidJson( $request, $e );

        if ( $e instanceof AuthenticationException )
            return response( false, 301 );

        return parent::render( $request, $e );
    }
}
