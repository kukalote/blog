<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    /**
     * 报告这个异常。
     *
     * @return void
     */
    public function report()
    {
    }

    /**
     * 将异常渲染至 HTTP 响应值中。
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->view('errors.custom', ['exception' => $this]);
    }
}
