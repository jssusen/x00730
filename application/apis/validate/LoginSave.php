<?php


namespace app\apis\validate;


class LoginSave extends BaseValidate
{
    protected $rule = [
        'mobile'		=>	'require|isMobile',
        "password"      =>"require|max:16",

    ];

    // 验证提示信息
    protected $message = [
        "mobile.require"  =>"手机号码不能为空",
        "mobile.isMobile"  =>"手机号码格式不正确",
        "password.require"=>"密码不能为空",
    ];
}