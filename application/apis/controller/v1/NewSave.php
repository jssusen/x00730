<?php


namespace app\apis\controller\v1;
use app\apis\model\Member;
use app\apis\model\NewInfo;
use app\apis\model\Notice;
use app\apis\validate\NewShow;
use app\apis\validate\NewDetails;

class NewSave extends BaseController
{
    protected  $news;
    public function __construct()
    {
        parent::_initialize();
        $this->news = new  NewInfo();
    }
    //消息
    public function index()
    {
        (new NewShow())->goCheck();
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status");
        if (!$user["status"]) return $this->error("该账户未登录或者被禁止");

        if ($data["type"]=="new"){
            $list =  $this->news->findAll($data["page"]);
            return $this->success("获取成功",$list);
        }
        if ($data["type"]=="user"){
           $list =  Notice::getNotice($user["data"]["id"],$data["page"]);
           return $this->success("获取成功",$list);
        }
    }
    //消息详情
    public function details()
    {
        (new NewDetails())->goCheck();
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status");
        if (!$user["status"]) return $this->error("该账户未登录或者被禁止");
        $info = $this->news->getDetails($data["id"]);
        return $this->success("获取成功",$info);
    }


}