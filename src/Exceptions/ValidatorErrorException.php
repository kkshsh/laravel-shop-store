<?php
/**
 * Created by PhpStorm.
 * User: wangzd
 * Date: 2017/3/25
 * Time: 下午4:22
 */

namespace SimpleShop\Store\Exceptions;


class ValidatorErrorException extends ReturnException
{
    public function __construct($message, $errorCode = 0)
    {
        $this->statusCode = 422;
        parent::__construct($message, $errorCode);
    }
}