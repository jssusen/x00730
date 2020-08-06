<?php


namespace app\apis\model;


class History extends BaseModel
{
    protected $name ="history";
    public function initialize(){
        parent::initialize();
    }

    public static function findMoneyLogByUserId($uid){
        return  self::where("uid",$uid)->field('money,type,remark,updatetime,option')->paginate();
    }

    public static function findMoneyLog($uid){
       return  self::where("uid",$uid)->where("type","integrals")->select();
    }

    //推广收益
    public static function findExtension($uid){
        return  self::where("uid",$uid)->where("type","share_incomes")->select();
    }


}