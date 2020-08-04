<?php


namespace app\apis\validate;


class NewShow extends BaseValidate
{
    protected $rule = [
        "token"     =>"require",
        'type'		=>	'require',
    ];

    // 验证提示信息
    protected $message = [
        "token" =>"token不能为空",
        "type.require"  =>"类型不能为空",
    ];

}