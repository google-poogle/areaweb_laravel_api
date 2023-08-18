<?php

namespace App\Exceptions;

use App\Exceptions\User\InvalidUserCredentialsException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->renderable(function (
            InvalidUserCredentialsException $e
        ) {
            return responseFailed($e->getMessage(), 401);
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return responseFailed(
                getModelNotFoundMessage($e->getModel()), 404
            );
        }

        $this->renderable(function (NotFoundHttpException $e) {
            return responseFailed($e->getMessage(), 404);
        });

        return parent::render($request, $e);
    }
}
