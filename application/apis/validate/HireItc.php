<?php


namespace app\apis\validate;


class HireItc extends BaseValidate
{
    protected $rule = [
        'token'		=>	'require',
        "type"      =>  "require|isType"

    ];

    // 验证提示信息
    protected $message = [
        "token.require"  =>"手机号码不能为空",
        "type.require"  =>"类型不能为空",
        "type.isType"  =>"类型非法",
    ];
}