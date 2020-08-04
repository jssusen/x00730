<?php


namespace app\apis\validate;


class RegisterSave extends BaseValidate
{
    protected $rule = [
        'mobile'		=>	'require|isMobile',
        "password"      =>  "require|max:16",
        "paypwd"        =>  "require|max:7",
        "realname"      =>  "require|max:7",
        "share_code"    =>  "require",
        "user_name"     =>  "require|max:10"
    ];

    // 验证提示信息
    protected $message = [
        "mobile.require"  =>"手机号码不能为空",
        "mobile.isMobile"  =>"手机号码格式不正确",
        "password.require"=>"密码不能为空",
        "password.max"      =>"密码过长",
        "paypwd.require"  =>"支付密码不能为空",
        "paypwd.max"  =>"支付密码长度过长",
        "share_code.require"  =>"邀请码为空",
        "user_name.require" =>"用户名不能为空",
        "user_name.max" =>"用户名过长",
        "realname.max" =>"真实姓名过长",
        "realname.require" =>"真实姓名不能为空"
    ];
}