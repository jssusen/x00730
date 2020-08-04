<?php


namespace app\apis\validate;


class ShareLine extends BaseValidate
{
    protected $rule = [
        "token"     =>"require",
        "level"    =>"require|isLevel"
    ];

    // 验证提示信息
    protected $message = [
        "token" =>"token不能为空",
        "level.require" =>"level不能为空",
        "level.isLevel" =>"level类型不正确"
    ];
}