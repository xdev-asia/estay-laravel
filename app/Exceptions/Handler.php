<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
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
    public function render($request, Exception $e)
    {
        if ($this->isHttpException($e)) {
            if($e instanceof NotFoundHttpException){
                return response()->json(['error' => '404 Not Found!'], 404);
            }else if($e instanceof MethodNotAllowedHttpException){
                return response()->json(['error' => 'Method not allowed!'], 405);
            }
        }
        if ($e instanceof \Illuminate\Session\TokenMismatchException) {
            return response()->json(['error' => 'You have been inactive for a while, please go back to the previous page!'], 400);
        }
        if ($e instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Something happened, please contact our support at -> http://booksicms.com/support!'], 400);
        }  
        if($e instanceof \Symfony\Component\Debug\Exception\FatalErrorException) {
            return response()->json(['error' => 'Something happened, please contact our support at -> http://booksicms.com/support!'], 400);
        }
        return parent::render($request, $e);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        return redirect()->guest('login');

    }
}
