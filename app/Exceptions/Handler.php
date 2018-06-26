<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Http\Formatter;

class Handler extends ExceptionHandler
{
    use Formatter;
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
            return $this->reponseErrorJSON('そのIDは存在しません。');
        }elseif ($e instanceof \Illuminate\Database\QueryException) {
            return $this->reponseErrorJSON('データの作成/更新に失敗しました。入力した値の長さ・型を確認してください。');
        }elseif ($e instanceof \Illuminate\Validation\ValidationException) {
            return parent::render($request, $e);
        }elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
            return parent::render($request, $e);
        }else{
            return $this->reponseErrorJSON('内部エラーが発生しました。');
        }
    }
}
