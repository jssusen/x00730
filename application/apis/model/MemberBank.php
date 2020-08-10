<?php


namespace app\apis\model;


class MemberBank extends BaseModel
{
    public function initialize(){
        parent::initialize();
    }

    public static function addBank($data){

      return  self::create([
            "bank_name"=>$data["bank_name"],
            "bank_num"=>$data["bank_num"],
            "uid"   =>$data["uid"],
            "mobile"=>$data["mobile"],
            "bank_real_name"=>$data["bank_real_name"]
        ]);
    }



}