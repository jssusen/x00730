<?php


namespace app\apis\validate;


class UserInfo extends BaseValidate
{
    protected $rule = [
        "token"     => "require",
    ];

    // 验证提示信息
    protected $message = [
        "token" =>"token不能为空",

    ];

    protected function checkPasswd($value){
        $pslength = strlen($value);
        if($pslength < 6) return false;
    }


}