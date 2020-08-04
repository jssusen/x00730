<?php


namespace app\apis\validate;


class AdoptDog extends BaseValidate
{
    protected $rule = [
        "token"     =>"require",
        "dog_id"    =>"require|isInt",
        "number"    =>"require|isInt"
    ];

    // 验证提示信息
    protected $message = [
        "token.require"  =>"token不能为空",
        "dog_id.require" =>"产品id不能为空",
        "dog_id.isInt" =>"产品id类型不正确",
        "number.require" =>"轮询不能为空",
        "number.isInt" =>"轮询次数类型不正确"
    ];
}