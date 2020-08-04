<?php


namespace app\apis\validate;


class WorkSave extends BaseValidate
{
    protected $rule = [
        "token"         =>"require",
        'content'		=>	'require',
    ];

    // 验证提示信息
    protected $message = [
        "token.require"         =>"token不存在",
        "content.require"  =>"内容不能为空",
    ];

}