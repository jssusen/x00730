<?php


namespace app\apis\validate;


class Token extends BaseValidate
{
    protected $rule = [
        "token"     =>"require",
        "paypwd"    =>"require"
    ];

    // 验证提示信息
    protected $message = [
        "token.require" =>"token不能为空",
        "paypwd.require"    =>"支付密码不能为空"
    ];
}