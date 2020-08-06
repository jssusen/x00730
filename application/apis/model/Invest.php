<?php


namespace app\apis\model;


class Invest extends BaseModel
{
    public function initialize(){
        parent::initialize();
    }

    public static function createInvest($data)
    {
        self::create([
            "uid"=>$data["uid"],
            "collectionimage"=>$data["collectionimage"],
            "money"=>$data["money"]
        ]);
    }


}