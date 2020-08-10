<?php


namespace app\apis\validate;


class SetDefault extends BaseValidate
{
    protected $rule = [
        "token"     => "require",
        "id"        =>"require"
    ];

    // 验证提示信息
    protected $message = [
        "token.require" =>"token不能为空",
        "id.require"    =>"银行卡id不能为空"
    ];
}