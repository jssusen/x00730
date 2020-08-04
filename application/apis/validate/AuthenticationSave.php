<?php


namespace app\apis\validate;


class AuthenticationSave extends  BaseValidate
{
    protected $rule = [
        'token'		=>	'require',
        "realname"  => "require",
        "idcard"    =>"require|is_idcard",
        "collectionimage"=>"require"
    ];

    // 验证提示信息
    protected $message = [
        "mobile.require"  =>"token不能为空",
        "realname.require"  =>"真实姓名不能为空",
        "idcard.require"  =>"身份证不能为空",
        "idcard.is_idcard"=>"身份证格式不正确",
        "collectionimage.require"=>"收款图不能为空",
    ];
}