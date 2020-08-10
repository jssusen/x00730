<?php


namespace app\apis\validate;


class Withdraw extends BaseValidate
{

    protected $rule = [
        "token"     =>"require",
        "money"     =>"require|isInt",
        "money_position"=>"require",
        "paypwd"        =>"require"
    ];

    // 验证提示信息
    protected $message = [
        "token.require" =>"token不能为空",
        "money.require"=>"提现额度不能为空",
        "money.isInt"=>"提现额度类型非法",
        "money_position"=>"提现位置不能为空",
        "paypwd.require"=>"支付密码不能为空"
    ];

}