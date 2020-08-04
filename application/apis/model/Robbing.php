<?php


namespace app\apis\model;


class Robbing extends BaseModel
{
    protected $name ="robbing";
    public function initialize(){
        parent::initialize();
    }


    public  static function deleteRobbing($uid=0,$dog_id=0)
    {
         self::where([
                "uid"=>$uid,
                "dog_id"=>$dog_id
            ])->delete();
    }


}