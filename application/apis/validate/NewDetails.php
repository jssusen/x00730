<?php


namespace app\apis\validate;


class NewDetails extends BaseValidate
{
    protected $rule = [
        "token"     =>"require",
        'id'		=>	'require',
    ];

    // 验证提示信息
    protected $message = [
        "token" =>"token不能为空",
        "id.require"  =>"id不能为空",
    ];
}