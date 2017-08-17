<?php
/**
 * Created by PhpStorm.
 * User: coffeekizoku
 * Date: 2017/3/17
 * Time: 下午2:39
 */

namespace SimpleShop\Store\Exceptions;


class ResourcesNotFoundException extends ReturnException
{
    public function __construct($message, \Throwable $e = null)
    {
        $this->statusCode = 404;
        if (! request()->ajax() && ! request()->isJson() && ! request()->wantsJson()) {
            abort(404, $message);
        }
        parent::__construct($message, 0, $e);
    }
}