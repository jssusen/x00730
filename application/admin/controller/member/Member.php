<?php

namespace app\admin\controller\member;

use app\common\controller\Backend;
use think\Db;
use think\Loader;
use app\admin\model\order\Match;
use think\Request;
Loader::import('PhpQrcode.phpqrcode',EXTEND_PATH,'.php');

/**
 * 会员管理
 *
 * @icon fa fa-circle-o
 */
class Member extends Backend
{
    
    /**
     * Member模型对象
     * @var \app\admin\model\member\Member
     */
    protected $model = null;
//    protected $relationSearch = true;
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\member\Member;
        $this->view->assign("sexList", $this->model->getSexList());
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->view->assign("robberList", $this->model->getRobberList());
        $this->view->assign("typeList", $this->model->getTypeList());
    }

    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->with(["memberGroup"])
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->with(["memberGroup"])
                ->with(["User"])
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }



    public function add()
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $params["token"]=createrToken();
                $params["login_ip"]=Request::instance()->ip();
                $params["share_code"]= create_invite_code();
                $params["password"]=saltPassword($params["password"]);
                $params["paypwd"]=saltPassword($params["paypwd"]);
                $params["paypwd"]=saltPassword($params["paypwd"]);
                $params["start_time"]=create_fast_time();
                $params["re_path"]=",";
                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $this->model->allowField(true)->save($params);
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }


    //充值
    public function recharge($ids = null){
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        if ($this->request->isPost()){
            $params = $this->request->post("row/a");

            Db::startTrans();
            try{
                if ($params["money"]>0){
                    Db::name("member")->where("id",$params["id"])->setInc($params["type"],$params["money"]);
                }
                if ($params["money"]<0){
                    $money = abs($params["money"]);
                    Db::name("member")->where("id",$params["id"])->setDec($params["type"],$money);
                }
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $this->error(__('充值错误格式'));
            }

            $this->success('充值成功',null,1);
        }

       $this->view->assign("row", $row);
        return $this->view->fetch();
    }

    //创建出场订单
   public function create($ids = null){
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        if ($this->request->isPost()){
            $params = $this->request->post("row/a");
            if (!$row)return errorAjax('会员不存在');
            if ($row['status'] != 1)return  $this->error('会员已被禁用');
            if ($params["money"]<=0)return  $this->error('金额不可小于0');
            if ($params["num"]<=0)return    $this->error('数量不可小于0');
            if ($params["num"]>20)return    $this->error('数量不可大于20');
//            return  dump($params);
            $allData=[];
            Db::startTrans();
            try{
                for ($i=0;$i<$params["num"];$i++){
                    $data =[];
                    $data["order_id"]=chr(mt_rand(65,90)).date('YmdHis').mt_rand(1,99).mt_rand(1,99).chr(mt_rand(65,90)).$i;
                    $data["uid"]=$row["id"];
                    $data["order_type"]=1;
                    $data["money"]=$params["money"];
                    $data["unmatched"] = $params["money"];
                    $data["source"] ="system";
                    $data['dog_id'] = $params["dog_id"];
                    array_push($allData,$data);
                }
                $match =new  Match();
                $match->saveAll($allData);
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $this->error(__('出错'));
            }
            $this->success('成功',null,1);
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();

    }





    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */



}
