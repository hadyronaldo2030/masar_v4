<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }



//     public function render($request, Throwable $exception)
// {
//     if ($exception instanceof HttpException) {
//         $statusCode = $exception->getStatusCode();

//         // switch ($statusCode) {
//         //     case 404:
//         //         return response()->view('errors.404', [], 404);
//         //     case 403:
//         //         return response()->view('errors.403', [], 403);
//         //     case 500:
//         //         return response()->view('errors.500', [], 500);
//         //     default:
//         //         return $this->renderHttpException($exception);
//         // }
//         if ($statusCode === 404) {
//             return response()->view('errors.404', [], 404);
//         } elseif ($statusCode === 403) {
//             return response()->view('errors.403', [], 403);
//         } elseif ($statusCode === 500) {
//             return response()->view('errors.500', [], 500);
//         }
//     }

//     return parent::render($request, $exception);
// }


}
