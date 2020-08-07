<?php


namespace app\apis\validate;


class BuyIct extends BaseValidate
{
    protected $rule = [
        'token'		=>	'require',
        "type"      =>  "require|isItcType",
        "dog_id"    =>"require|isInt",
        "dog_name"      =>  "require",
        "money"      =>  "require|isInt",
        "period_day"      =>  "require|isInt",
        "gains"   =>  "require",
    ];

    // 验证提示信息
    protected $message = [
        "token.require"  =>"token不能为空",
        "type.require"   =>"矿机类型不能为空",
        "type.isItcType" =>"矿机类型非法",
        "dog_id.require"=>"矿机Id不能为空",
        "dog_id.isInt"=>"矿机Id非法",
        "dog_name.require"=>"矿机名称不能为空",
        "money.require"      =>  "价格不能为空",
        "period_day.require" =>"周期不能为空",
        "period_day.isInt" =>"周期类型非法",
        "gains"     =>"收益不能为空"
    ];
}