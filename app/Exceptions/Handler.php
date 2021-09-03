<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /** @inheritDoc */
    protected $dontReport = [
        //
    ];

    /** @inheritDoc */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * @inheritDoc
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * @inheritDoc
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
