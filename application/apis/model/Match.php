<?php


namespace app\apis\model;


use think\Db;

class Match extends BaseModel
{
    protected $name ="match";
    public function initialize(){
        parent::initialize();
    }

    protected $append = [
        'status_text',
        "type_text"
    ];

    public static function findAllOrder(){
        return  Db::name("match")->where("status",0)->select();
    }


    //创建订单
    public static function createOrder($data){
        unset($data["version"]);
        unset($data["token"]);
        if ($data["type"]==0){  //体验机
            $data["return_money_all"]=$data["gains"];
            $data["return_money_day"]=$data["gains"];
            $data["payment_time"]=create_payment_time(1); //明天打款
            $data["order_id"]=createOrderNum();
            unset($data["gains"]);
            self::create($data);
        }
        if ($data["type"]==1){ //天数机
            $data["return_money_all"]=$data["gains"]*$data["period_day"];
            $data["return_money_day"]=$data["gains"];
            $data["order_id"]=createOrderNum();
            $data["payment_time"]=create_payment_time($data["period_day"]); //最后一次打款时间
            $data["every_day_time"]=create_fast_time();//每日更改天数  每日的周期
            unset($data["gains"]);
            self::create($data);
        }
        if ($data["type"]==2){  //周期机
            $data["return_money_all"]=$data["gains"];
            $data["order_id"]=createOrderNum();
            $data["payment_time"]=create_payment_time($data["period_day"]); //最后一次打款时间
            $data["every_day_time"]=create_fast_time();//每天的打款时间
            unset($data["gains"]);
            self::create($data);
        }

    }








    public static function findExperienceItc($uid,$dog_id){
        $itc = self::where("uid",$uid)
            ->where("dog_id",$dog_id)
            ->where("type",0)
            ->count();
        return $itc;
    }


    public static function findDayItc($uid,$dog_id){
        $itc  =  self::where("uid",$uid)
            ->where("dog_id",$dog_id)
            ->whereTime("createtime","today")->select();
        return $itc;
    }



    //写死赠送的矿机
    public static function addItc(){
        $data["dog_name"]="999体验机";
        $data["order_id"]="xx170000";
        $data["period_day"]="999";
        $data["status_text"]="运行中";
        return $data;
    }



















    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getTypeList(){
        return ['0' => "体验", '1' => "天","2"=>"周"];
    }

    public function getStatusList()
    {
        return ['0' => "运行中", '1' => "已完成"];
    }

    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function user(){
        return $this->belongsTo('\app\admin\model\member\Member', 'uid')->alias("m")->bind("mobile");
    }

    public  static function  recentlyItc(){
        $list = self::with("user")
            ->whereTime("createtime","week")
            ->field("id,dog_name,uid,createtime")
            ->select();
        return $list;
    }

    public static function myOrder($uid,$page=0){
      $list =  self::where("uid",$uid)->page($page,5)->select();
      return $list;
    }



}