<?php


namespace app\apis\validate;


class RegisterSave extends BaseValidate
{
    protected $rule = [
        "user_name"     =>  "require|max:10",
        'mobile'		=>	'require|isMobile',
        "password"      =>  "require|max:16|min:6",
        "password_tow"  =>  "require|max:16|min:6",
        "paypwd"        =>  "require|max:6|min:6",
        "paypwd_tow"    =>  "require|max:6|min:6",
        "share_code"    =>  "require",

    ];

    // 验证提示信息
    protected $message = [
        "mobile.require"  =>"手机号码不能为空",
        "mobile.isMobile"  =>"手机号码格式不正确",
        "password_tow.require"=>"第二次输入密码不能为空",
        "password_tow.max"=>"第二次输入密码过长",
        "password_tow.min"=>"第二次输入密码最低6位",
        "password.require"=>"密码不能为空",
        "password.max"      =>"密码过长",
        "password.min"      =>"密码最低6位",
        "paypwd.require"  =>"支付密码不能为空",
        "paypwd.max"  =>"支付密码长度过长",
        "paypwd.min"  =>"支付密码只能是6位",
        "paypwd_tow.require"  =>"第二次支付密码不能为空",
        "paypwd_tow.max"  =>"第二次支付密码长度过长",
        "paypwd_tow.min"  =>"第二次支付密码只能是6位",
        "share_code.require"  =>"邀请码为空",
        "user_name.require" =>"用户名不能为空",
        "user_name.max" =>"用户名过长",
    ];
}