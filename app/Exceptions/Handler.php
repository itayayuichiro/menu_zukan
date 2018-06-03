<?php

namespace App\Exceptions;

use App\Formatter;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        \Log::ERROR('ERROR LOG', ['action' => \Route::getCurrentRoute()->getActionName(), 'error' => $exception]);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        //IDがなかった場合のエラー
        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
//            return Formatter::responseJSON(array('result' => 'error', 'message' => 'ID not found'));    
            //Formatter::sample(array('result' => 'error', 'message' => 'ID not found'));
            return Formatter::responseJSON(array('result' => 'error', 'message' => 'ID not found'));
        }
        //DB保存の際のエラー
        if ($e instanceof \Illuminate\Database\QueryException) return Formatter::responseJSON(array('result' => 'error', 'message' => $e));

        // if ($this->isHttpException($e)) {
        //     if ($e->getStatusCode() == 403) {
        //         return response()->view('errors.403');
        //     }
        //     // 404
        //     if ($e->getStatusCode() == 404) {
        //         return response("sss");
        //     }
        // }
        return parent::render($request, $e);
        // return print_r(($this);

//         // 500
//         return response('ss');
        // }
    }
}
