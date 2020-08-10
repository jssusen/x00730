<?php


namespace app\apis\validate;


class CheckPasswd extends BaseValidate
{
    protected $rule = [
        "token"     =>"require",
        "r_passwd"  =>"require",
        "n_passwd"  =>"require",
        "n_passwd_two"=>"require",
        "type"      =>"require"
    ];

    // 验证提示信息
    protected $message = [
        "token.require"  =>"token不能为空",
        "r_passwd.require"  =>"原密码不能为空",
        "n_passwd.require"  =>"新密码不能为空",
        "type.require"      =>"修改密码类型不能为空",
        "n_passwd_two.require"=>"第二次修改的密码不能为空"
    ];
}