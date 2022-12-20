<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;



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
        // $this->renderable(function (NotFoundHttpException $e, $request) {
        //     // dd($request);
        //     // dd($request->is('api/*'));

        //     if ($request->is('api/*')) {
        //         return response()->json([
        //             'message' => 'Record not found.'
        //         ], 404);
        //     }return response()->json([
        //         'message' => 'Record not found.'
        //     ], 404);

        // });

        $this->renderable(function (ModelNotFoundException $e, $request) {
            // dd($request);
            // dd($request->is('api/*'));

            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);
            }
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            // dd($request);
            // dd($request->is('api/*'));

            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Method Not Allowed.'
                ], 405);
            }
            return response()->json([
                'message' => 'Method Not Allowed.'
            ], 405);
        });

        // $this->renderable(function (Throwable $e, $request) {
        //     // dd(get_class($e));
        //     // dd($e->getMessage());
        //     // dd($request->is('api/*'));

        //     if ($request->is('api/*')) {
        //         return response()->json([
        //             'message' => 'Something went wrong'
        //         ], 500);
        //     }
        //     return response()->json([
        //         'message' => 'Something went wrong'
        //     ], 500);
        // });


    }
}
