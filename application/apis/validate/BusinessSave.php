<?php


namespace app\apis\validate;


class BusinessSave extends BaseValidate
{
    protected $rule = [
        'name'		=>	'require',
        "headimage"     =>  "require",
        'propagate'		=>	'require',
        'licenseimage'		=>	'require',
        'identity_type'		=>	'require',
        'business_name'		=>	'require',
        'code'		=>	'require',
        'identityimages'		=>	'require',
        'phone'		=>	'require|isMobile',
        "type"  =>"require"

    ];

    // 验证提示信息
    protected $message = [
        "name.require"  =>"名字为空",
        "headimage.require" =>"头像图片为空",
        "propagate.require"=>"商家标语为空",
        "licenseimage.require"=>"营业执照为空",
        "identity_type.require"=>"证件类型为空",
        "business_name.require"=>"企业名称为空",
        "code.require"=>"信用代码为空",
        "identityimages.require"=>"证件图片为空",
        "phone.require"=>"商家联系方式为空",
        "phone.isMobile"=>"手机号码格式不正确",
        "type.require"=>"行业类为空"

    ];
}