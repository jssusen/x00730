<?php


namespace app\apis\controller\v1;
use app\apis\validate\Token;
use app\apis\validate\WorkSave;
use app\apis\model\Member;
use app\apis\model\WorkOrder as WorkOrderModel;
class WorkOrder extends BaseController
{
    protected  $work_order;
    public function __construct()
    {
        parent::_initialize();
        $this->work_order=new WorkOrderModel();
    }
    //提交工单
    public function workSave()
    {
        ((new WorkSave)->goCheck());
         $data =  $this->request->param();
         $user = Member::memberInfo($data,"id,status");
        if (!$user["status"]){
            return $this->error("该账户未登录或者被禁止");
        }else{
            $data["uid"]=$user["data"]["id"];
            $isOk = $this->work_order->createWord($data);
            if ($isOk)
            {
                return $this->success("提交工单成功");
            }
        }
    }
    //所有工单
    public function wordRecord()
    {
        ((new Token)->goCheck());
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status");
        if (!$user["status"]){
            return $this->error("该账户未登录或者被禁止");
        }
        $info = $this->work_order->finUserWork($user["data"]["id"]);
        return $this->success("获取成功",$info);

    }


}