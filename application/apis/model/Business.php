<?php

namespace app\apis\model;


use think\Db;
use think\Request;

class Business extends BaseModel
{
    private   $request;
    protected $name ="business";
    public function __construct(){
        $this->request=Request::instance();
    }

    public function createBusiness()
    {
       $data =  $this->request->param();
       $newData =cleanDomin($data);
       $isTrue =  $this->allowField(true)->save($newData);
       return $isTrue;
    }

}