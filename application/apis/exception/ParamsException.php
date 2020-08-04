<?php
namespace app\apis\exception;
use app\apis\exception\BaseException;

class ParamsException extends BaseException
{

    public $code = 400;
    public $errorCode = 10000;
    public $msg = "invalid parameters";
}