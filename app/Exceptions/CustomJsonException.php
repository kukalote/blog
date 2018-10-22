<?php

namespace App\Exceptions;

use App\Entity\Result;
use Exception;

class CustomJsonException extends Exception
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
    public function render($request, Exception $exception)
    {
        $result = new Result($exception->getCode(), $exception->getMessage());
        return response()->json($result->toArray());
    }
}
