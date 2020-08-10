<?php


namespace app\apis\validate;


class AddBank extends BaseValidate
{
    protected $rule = [
        "token"     =>"require",
        "bank_name"=>"require",
        "bank_num"=>"require",
        "bank_real_name"=>"require",
        "paypwd"=>"require"
    ];

    // 验证提示信息
    protected $message = [
        "token.require"  =>"token不能为空",
        "bank_name.require"  =>"银行卡类型不能为空",
        "bank_num.require"  =>"银行卡号不能为空",
        "bank_real_name.require"=>"开户人姓名不能为空",
        "paypwd.require"=>"支付密码不能为空"
    ];
}