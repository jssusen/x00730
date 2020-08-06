<?php


namespace app\apis\model;


class Withdrawal extends \think\Model
{
    public function getCash($uid){
        return self::where(['uid' => $uid])->field('money,procedures_money,really_money,remark,money_position,is_pay,updatetime')->paginate();
    }

}