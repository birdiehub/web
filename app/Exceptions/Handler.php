<?php

namespace App\Exceptions;

use App\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function render($request, Throwable $e): JsonResponse
    {
        // General
        if ($e instanceof \App\Exceptions\Custom\GeneralException) {
            return Response::error($e->getMessage(), 409);
        }
        elseif ($e instanceof \InvalidArgumentException) {
            return Response::error($e->getMessage(), 400);
        }
        elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return Response::error($e->getMessage(), 400);
        }
        // Authentication
        elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
            return Response::error($e->getMessage(), 401);
        }
        // Authorization: Roles and Permissions
        elseif ($e instanceof \Spatie\Permission\Exceptions\UnauthorizedException || $e instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return Response::error($e->getMessage(), 403);
        }
        elseif ($e instanceof \Illuminate\Validation\ValidationException) {
            return Response::error($e->errors(), 400);
        }
        elseif ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return Response::error($e->getMessage(), 404);
        }
        elseif ($e instanceof \App\Exceptions\Custom\NotYetImplementedException) {
            return Response::error($e->getMessage(), 501);
        }

        if (config('app.debug')) {
            return Response::error([
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace()
            ], 500);
        }

        // Handle all other exceptions with a general response
        return Response::error("Internal Server Error", 500);
    }

    public function register(): void
    {
        $this->reportable(function (Throwable $e): void {
            //
        });
    }
}
