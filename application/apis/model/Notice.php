<?php


namespace app\apis\model;


class Notice extends BaseModel
{
    public static function getNotice($uid,$page=0,$listRows=10){
       return self::where("uid",$uid)
            ->order("createtime DESC")
            ->page($page,$listRows)
            ->select();
    }

    public static function getNoticeDetails($uid){

    }
}