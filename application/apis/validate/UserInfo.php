<?php


namespace app\apis\validate;


class UserInfo extends BaseValidate
{
    protected $rule = [
        "token"     => "require",
        "r_passwd"  => "require",
        "n_passwd" => "require",
        "n_passwd_two" => "require"

    ];

    // 验证提示信息
    protected $message = [
        "token" =>"token不能为空",
        "r_passwd" => "原密码不能为空",
        "n_passwd" => "新密码不能为空",
//        "n_passwd_two" => "新密码第二次不能为空"
    ];

    protected function checkPasswd($value){
        $pslength = strlen($value);
        if($pslength < 6) return false;
    }


}