<?php


namespace app\apis\model;


use think\Request;

class NewInfo extends BaseModel
{
    protected $table="fa_news";
    protected $name ="news";
    public function _initialize(){
        parent::_initialize();
    }


    public function findAll($page=1,$listRows=10)
    {
       $data =  $this->where("status",1)
           ->order("sort DESC")
           ->page($page,$listRows)
           ->select();
       return $data;
    }

    public function getDetails($uid)
    {
        return $this->where("id",$uid)->where("status",1)->find();
    }

}