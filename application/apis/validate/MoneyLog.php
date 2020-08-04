<?php


namespace app\apis\validate;


class MoneyLog extends  BaseValidate
{
    protected $rule = [
        'token'		=>	'require',
    ];

    // 验证提示信息
    protected $message = [
        "token.require"  =>"token不能为空",
    ];
}