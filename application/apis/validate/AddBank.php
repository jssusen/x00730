<?php


namespace app\apis\validate;


class AddBank extends BaseValidate
{
    protected $rule = [
        "token"     =>"require",
        "bank_name"=>"require",
        "bank_num"=>"require",
        "mobile"=>"require|isMobile",
        "bank_real_name"=>"require"
    ];

    // 验证提示信息
    protected $message = [
        "token.require"  =>"token不能为空",
        "bank_name.require"  =>"银行卡类型不能为空",
        "bank_num.require"  =>"银行卡号不能为空",
        "mobile.require"  =>"开户手机号不能为空",
        "mobile.isMobile"  =>"开户手机类型不正确",
        "bank_real_name.require"=>"开户人姓名不能为空"
    ];
}