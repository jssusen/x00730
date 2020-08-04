<?php


namespace app\apis\model;


class Match extends BaseModel
{
    protected $name ="match";
    public function initialize(){
        parent::initialize();
    }

    public static function findRollOutOrder($dogId,$field="*"){
        return self::where(
            [
                "status"=>0,
                "is_lock"=>0,
                "match_status"=>0,
                "order_type"=>1,
                "dog_id"  =>$dogId
            ]
        )->field($field)->lock()->find();
    }

}