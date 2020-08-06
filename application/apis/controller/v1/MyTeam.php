<?php


namespace app\apis\controller\v1;

use app\apis\model\History;
use app\apis\model\Invest;
use app\apis\model\Member as MemberModel;
use app\apis\model\MemberGroup;
use app\apis\model\Withdrawal;
use app\apis\validate\ShareLine;
use app\apis\validate\Token;
use app\apis\validate\UserInfo;
use think\Request;

class MyTeam extends BaseController
{
    protected  $member;
    protected  $history;
    protected  $invest;
    protected  $membergroup;
    protected  $withdrawal;
    public function __construct()
    {
        parent::_initialize();
        $this->member =new MemberModel();
        $this->history = new History();
        $this->invest = new Invest();
        $this->membergroup = new MemberGroup();
        $this->withdrawal = new Withdrawal();
    }


    /**
     * 提现记录
     * @param Request $request
     */
    public function getCashByToken(Request $request){
        (new Token())->goCheck();
        $postdata = $request->get();
        $user = $this->member->userInfo($postdata,"id,status");
        if (!$user["status"]) return $this->error("该账户已被禁止");
        $res = $this->withdrawal->getCash($user['data']['id']);
        if(!$res) return $this->error('获取失败');
        return $this->success('获取成功',$res);
    }

    /**
     * 我的页面信息
     * @param Request $request
     */
    public function userInfoByToken(Request $request){
        (new Token())->goCheck();
        $postdata = $request->get();
        $user = $this->member->userInfo($postdata,"id,status,realname,itc_income,share_income,integrals,member_group_id");
        if (!$user["status"]) return $this->error("该账户已被禁止");
        $group = $this->membergroup->getTitle($user['data']['member_group_id']);
        if(!$group) return $this->error("获取用户会员失败");
        $user['data']['member_group_id'] = $group;
        return $this->success('获取成功',$user);
    }


    /**
     * 个人充值记录
     * @param Request $request
     */
    public function rechargeUserMoney(Request $request){
        (new Token())->goCheck();
        $postdata = $request->get();
        $user = $this->member->userInfo($postdata,"id,status");
        if (!$user["status"]) return $this->error("该账户已被禁止");
        $res = $this->invest->getUserRechargeMoney($user['data']['id']);
        if(!$res) return $this->error("获取失败");
        return $this->success("获取成功",$res);
    }


    /**
     * 个人收支明细
     * @param Request $request
     * @return \think\response\Json|void
     * @throws \app\apis\exception\ParamsException
     */
    public function getUserInOutMoney(Request $request){
        (new Token())->goCheck();
        $postdata = $request->get();
        $user = $this->member->userInfo($postdata,"id,status");
        if (!$user["status"]) return $this->error("该账户已被禁止");
        $res = $this->history->findMoneyLogByUserId($user['data']['id']);
        if(!$res) return $this->error("获取失败");
        return $this->success("获取成功",$res);
    }

    /**
     * 修改密码
     */
    public function checkPasswd(Request $request){
        (new UserInfo())->goCheck();
        $postdata = $request->post();
        $user = $this->member->userInfo($postdata,"id,status,re_level,share_income,password");
        if (!$user["status"]) return $this->error("该账户已被禁止");
        if(saltPassword($postdata['r_passwd']) != $user['data']['password']) return $this->error("原密码不正确");
        if(saltPassword($postdata['n_passwd']) == $user['data']['password']) return $this->error("修改的密码不能和原始密码一样");
        if($postdata['n_passwd_two'] != $postdata['n_passwd'] ) return $this->error("新密码两次不一样");

        $updateres = $this->member->where([
            'token'=>$postdata['token'],
            'update' => time()])
            ->update(['password'=>saltPassword($postdata['n_passwd'])]);
        if(!$updateres) return $this->error("修改密码失败");
        return $this->success("修改密码成功");
    }



    /**
     * 获取我的团队信息
     * @return \think\response\Json|void
     * @throws \app\apis\exception\ParamsException
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function shareLine(){
        (new ShareLine())->goCheck();
        $data =  $this->request->param();
        $user = $this->member->userInfo($data,"id,status,re_level,share_income");
        if (!$user["status"]) return $this->error("该账户已被禁止");
        $where['re_path']=array('like',"%,{$user['data']['id']},%");

        if($data['level'] == 37){
            $level = [3,4,5,6,7];
            $new_list = [];
            foreach ($level as $k => $v){
                $list = MemberModel::where(["status"=>1])
                    ->where(["re_level"=>$user["data"]['re_level']+$v])
                    ->where($where)
                    ->field('id,avatarimage,mobile,re_id,user_name,createtime,realname')
                    ->order('id desc')
                    ->select();
                foreach ($list as $k1 => $v1){
                    array_push($new_list,$v1);
                }
            }
            $list = $new_list;
            $recommendNumber = count($list);
        }else if($data['level'] == 815){
            $level = [8,9,10,11,12,13,14,15];
            $new_list = [];
            foreach ($level as $k => $v){
                $list = MemberModel::where(["status"=>1])
                    ->where(["re_level"=>$user["data"]['re_level']+$v])
                    ->where($where)
                    ->field('id,avatarimage,mobile,re_id,user_name,createtime,realname')
                    ->order('id desc')
                    ->select();
                foreach ($list as $k1 => $v1){
                    array_push($new_list,$v1);
                }
            }
            $list = $new_list;
            $recommendNumber = count($list);
        }else if($data['level'] < 3){
            $list = MemberModel::where(["status"=>1])
                ->where(["re_level"=>$user["data"]['re_level']+$data["level"]])
                ->where($where)
                ->field('id,avatarimage,mobile,re_id,user_name,createtime,realname')
                ->order('id desc')
                ->select();

            $recommendNumber = MemberModel::where(['re_id'=>$user['data']['id']])->count();
        }

        $teamNumber = MemberModel::where($where)->count();
        $all_data["list"]=$list;
        $all_data["recommendNumber"]=$recommendNumber;
        $all_data["teamNumber"]=$teamNumber;
        $all_data["share_income"]=$user["data"]["share_income"];
        return $this->success("获取成功",$all_data);
    }

}