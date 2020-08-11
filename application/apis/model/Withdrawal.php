<?php


namespace app\apis\model;


class Withdrawal extends \think\Model
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



    public function getCash($uid){
        return self::where(['uid' => $uid])->field('money,createtime,procedures_money,really_money,remark,money_position,is_pay,updatetime')->paginate();
    }

    public static function finDayWithrawal($uid)
    {
        return self::where("uid",$uid)->whereTime("createtime","today")->count();
    }

    public static function createDrawal($data)
    {
        return self::create([
            "uid"=>$data["uid"],
            "money"=>$data["money"],
            "really_money"=>$data["money"],
            "money_position"=>$data["money_position"]
        ]);
    }


}