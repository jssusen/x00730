<?php


namespace app\apis\model;
use think\Request;

class MemberBank extends BaseModel
{
    public function initialize(){
        parent::initialize();
    }

    protected function getBankImageAttr($value){
        $request = Request::instance();
        $finalUrl = $request->domain()."/x00730/public".$value;
        return $finalUrl;
    }

    public static function addBank($data){

        $arr=["工商银行","光大银行","广发银行","桂林银行","华夏银行","建设银行","交通银行","柳州银行",
            "民生银行","农业银行","浦发银行","邮政银行","招商银行","中国银行","中信银行"];
        foreach ($arr as $k)
        {
           if ($data["bank_name"]==$k)
           {
               $bank_name=$k;
           }
        };
      self::where("is_default",1)->update(["is_default"=>0]);
      return  self::create([
            "bank_name"=>$data["bank_name"],
            "bank_num"=>$data["bank_num"],
            "uid"   =>$data["uid"],
            "bank_image"=>'/bank/'.$bank_name.'.png',
            "bank_real_name"=>$data["bank_real_name"],
            "is_default"=>1
        ]);
    }


    public static function setDefault($data){
       self::where("is_default",1)->update(["is_default"=>0]);
       self::where("uid",$data["uid"])->where("id",$data["id"])->update(["is_default"=>1]);
    }


}