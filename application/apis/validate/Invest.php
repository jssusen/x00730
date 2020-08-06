<?php


namespace app\apis\validate;


class Invest extends BaseValidate
{
    protected $rule = [
        'token'		=>	'require',
        "collectionimage"=>'require',
        "money" =>'require|isInt'
    ];

    // 验证提示信息
    protected $message = [
        "token.require"  =>"token不能为空",
        "collectionimage.require"=>"凭证不能为空",
        "money.require"=>"充值金额不能为空",
        "money.isInt"=>"充值金额类型不合法"
    ];
}