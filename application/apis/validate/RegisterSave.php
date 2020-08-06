<?php


namespace app\apis\validate;


class RegisterSave extends BaseValidate
{
    protected $rule = [
        "user_name"     =>  "require|max:10",
        'mobile'		=>	'require|isMobile',
        "password"      =>  "require|max:16",
        "password_tow"  =>  "require|max:16",
        "paypwd"        =>  "require|max:7",
        "paypwd_tow"    =>  "require|max:7",
        "share_code"    =>  "require",

    ];

    // 验证提示信息
    protected $message = [
        "mobile.require"  =>"手机号码不能为空",
        "mobile.isMobile"  =>"手机号码格式不正确",
        "password_tow.require"=>"第二次输入密码不能为空",
        "password_tow.max"=>"第二次输入密码过长",
        "password.require"=>"密码不能为空",
        "password.max"      =>"密码过长",
        "paypwd.require"  =>"支付密码不能为空",
        "paypwd.max"  =>"支付密码长度过长",
        "paypwd_tow.require"  =>"第二次支付密码不能为空",
        "paypwd_tow.max"  =>"第二次支付密码长度过长",
        "share_code.require"  =>"邀请码为空",
        "user_name.require" =>"用户名不能为空",
        "user_name.max" =>"用户名过长",
    ];
}