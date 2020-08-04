<?php


namespace app\apis\validate;


class Transfer extends BaseValidate
{
    protected $rule = [
        "token"     =>"require",
        "money"     =>"require|isInt",
        "mobile"          =>"require|isMobile",
        "paypwd"       =>"require"
    ];

    // 验证提示信息
    protected $message = [
        "token.require" =>"token不能为空",
        "money.require" =>"转账金额不能为空",
        "money.isInt" =>"转账金额格式不正确",
        "paypwd.require" =>"转账密码不能为空",
         "mobile.require" =>"转账手机号不能为空",
        "mobile.isMobile" =>"手机号格式不正确"
    ];
}