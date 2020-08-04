<?php


namespace app\apis\model;

use think\Request;
use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';

    protected function getCreateTimeAttr($value){
        $date = date("Y-m-d H:i:s",$value);
        return $date;
    }
    protected function getUpdateTimeAttr($value){
        $date = date("Y-m-d H:i:s",$value);
        return $date;
    }



}