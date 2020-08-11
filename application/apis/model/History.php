<?php


namespace app\apis\model;


class History extends BaseModel
{


    protected $name ="history";
    public function initialize(){
        parent::initialize();
    }

    protected function getCreateTimeAttr($value){
        $date = date("Y-m-d H:i:s",$value);
        return $date;
    }
    protected function getUpdateTimeAttr($value){
        $date = date("Y-m-d H:i:s",$value);
        return $date;
    }





    public static function findMoneyLogByUserId($uid){
        return  self::where("uid",$uid)->field('money,type,remark,updatetime,option,createtime')->paginate();
    }

    public static function findMoneyLog($uid){
       return  self::where("uid",$uid)->where("type","integrals")->select();
    }

    public static function createHistory($data){
        self::create([
            "uid"=>$data["uid"],
            "money"=>"-${data["money"]}",
            "remark"=>"购买矿机${data["dog_name"]}",
            "type"=>"integrals",
            "option"=>"expend"
        ]);
    }



    //推广收益
    public static function findExtension($uid){
        return  self::where("uid",$uid)->where("type","share_incomes")->select();
    }


}