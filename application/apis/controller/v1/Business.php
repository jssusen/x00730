<?php

namespace app\apis\controller\v1;

use think\Request;
use app\apis\model\Business as BusinessModel;
use app\apis\validate\BusinessSave;
use app\admin\model\Admin;
class Business extends  BaseController

{
    protected  $business;
    public function __construct()
    {
        parent::_initialize();
        $this->business =new BusinessModel();
    }
    //商家审核接口
    public function index()
    {
        ((new BusinessSave)->goCheck());
         $isTrue =  $this->business->createBusiness();
         if ($isTrue){
            return $this->success("创建成功");
         }

    }

}