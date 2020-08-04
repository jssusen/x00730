<?php


namespace app\apis\validate;


class Apply extends BaseValidate
{
    protected $rule = [
        "token"     =>"require",
        "dog_id"    =>"require|isInt",
    ];

    // 验证提示信息
    protected $message = [
        "token.require"  =>"token不能为空",
        "dog_id.require" =>"产品id不能为空",
        "dog_id.isInt" =>"产品id类型不正确"
    ];
}