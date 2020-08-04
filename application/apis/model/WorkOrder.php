<?php


namespace app\apis\model;
use think\Request;

class WorkOrder extends  BaseModel
{
    private   $request;
    protected $name ="work_order";
    public function initialize(){
        parent::initialize();
        $this->request=Request::instance();
    }

    public  function createWord($data){
       $isOk = self::create([
            "uid"=>$data["uid"],
            "content"=>$data["content"],
        ]);
       if ($isOk){
           return true;
       }else{
           return false;
       }
    }

    public  function finUserWork($uid){
       return $this->where("uid",$uid)->select();
    }

}