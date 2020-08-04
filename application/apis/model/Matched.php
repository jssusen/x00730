<?php


namespace app\apis\model;


class Matched extends BaseModel
{
    protected $name ="matched";
    public function initialize(){
        parent::initialize();
    }

    public static function todayMatched($uid=0,$dog_id=0){
      return   self::where([
            "uid"=>$uid,
            "dog_id"=>$dog_id
        ])->whereTime("createtime","today")->count();
    }



}