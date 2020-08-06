<?php


namespace app\apis\model;


class Setting extends \think\Model
{

    Public function getProjectRule(){
        $res = $this->where([
            'key' => 'rule_value'
        ])->find();
        if($res){
            return $res;
        }
    }

}