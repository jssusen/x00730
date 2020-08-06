<?php


namespace app\apis\model;


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

    public static function myOrder($uid){
      $list =  self::where("uid",$uid)->select();
      return $list;
    }



}