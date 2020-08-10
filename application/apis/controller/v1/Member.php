<?php


namespace app\apis\controller\v1;
use app\apis\validate\RegisterSave;
use app\apis\validate\AuthenticationSave;
use app\apis\validate\Invest;
use app\apis\validate\LoginSave;
use app\apis\validate\UserInfo;
use app\apis\model\History;
use app\apis\model\Member as MemberModel;
use app\apis\model\MemberGroup;
use app\apis\model\Apply;
use app\apis\model\Invest as InvestModel;
use app\apis\validate\MoneyLog;
use app\apis\validate\ShareLine;
use app\apis\validate\Transfer;
use app\apis\model\Match;
use think\Db;
use think\Loader;
use app\apis\validate\Token;
use think\Request;

Loader::import('PhpQrcode.phpqrcode',EXTEND_PATH,'.php');

class Member extends BaseController
{

    protected  $member;
    public function __construct()
    {
        parent::_initialize();
        $this->member =new MemberModel();
    }

    //获取用户信息
    public function getUserInfo(){
        (new UserInfo())->goCheck();
         $data =  $this->request->param();
         $user = MemberModel::memberInfo($data,"id,mobile,avatarimage,status,member_group_id,share_income,integrals,share_code,itc_income,user_name");
         if(!$user["status"]) return $this->error("账户被封禁");
         $user["data"]["member_group_name"]=MemberGroup::getTitle($user["data"]["member_group_id"]);
         return $this->success("获取成功",$user["data"]);
    }

    //充值接口
    public function invest(){
        (new Invest())->goCheck();
        $data =  $this->request->param();
        $newData = cleanUrl($data);
        $user = MemberModel::memberInfo($newData,"id,status,share_income,paypwd");
        if(!$user["status"]) return $this->error("账户被封禁");
        if (saltPassword($data["paypwd"])!==$user["data"]["paypwd"])  return $this->error("支付密码不正确");
        $newData["uid"]=$user["data"]["id"];
        $investScope = setting("invest_scope")["invest_scope"];
        $invest = explode("|",$investScope);
        if ($newData["money"]<=$invest[0]) return $this->error("充值金额不能少于最低金额");
        if ($newData["money"]>$invest[1]) return $this->error("充值金额不能大于最高金额");
        Db::startTrans();
        try {
            InvestModel::createInvest($newData);
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return $this->error("网络异常,充值失败");
        }
        return $this->success("充值成功请等待审核");





    }

    //充值页面接口
    public function investView(){
        (new Token())->goCheck();
        $data =  $this->request->param();
        $user = MemberModel::memberInfo($data,"id,status,share_income");
        if(!$user["status"]) return $this->error("账户被封禁");
        $investScope = setting("invest_scope")["invest_scope"];
        $money    = setting("money_list")["money_list"];
        $moneyList =explode("|",$money);
        $invest = explode("|",$investScope);
        $systemAccount = setting("system_account")["system_account"];
        $account = explode("|",$systemAccount);
        $arr=["pay_type"=>$account["0"],"pay_num"=>$account["1"],"pay"=>$account["2"]];
        $view["invest"]=$invest;
        $view["account"]=$arr;
        $view["money_list"]=$moneyList;
        return $this->success("获取成功",$view);

    }

    //我的矿机接口
    public function myDog(){
        (new Token())->goCheck();
        $data =  $this->request->param();
        $user = MemberModel::memberInfo($data,"id,status");
        if(!$user["status"]) return $this->error("账户被封禁");
        $list =Match::myOrder($user["data"]["id"],$data["page"]);
        $all_list["list"]=$list;
        $all_list["itc"]=Match::addItc();
        return $this->success("获取成功",$all_list);
    }

    //银行卡列表
    public function bank(){
        (new Token())->goCheck();
        $data =  $this->request->param();
        $user = MemberModel::memberInfo($data,"id,status");
        if(!$user["status"]) return $this->error("账户被封禁");
        $list = Db::name("support_bank")->select();
        return $this->success("获取成功",$list);
    }





    //账户的类型




//    //团队信息
//    public function shareLine(){
//        (new ShareLine())->goCheck();
//        $data =  $this->request->param();
//        $user = $this->member->userInfo($data,"id,status,re_level,share_income");
//        if (!$user["status"]) return $this->error("该账户已被禁止");
//
//        $where['re_path']=array('like',"%,{$user['data']['id']},%");
//
//        $list = MemberModel::where(["status"=>1])
//            ->where(["re_level"=>$user["data"]['re_level']+$data["level"]])
//            ->where($where)
//            ->field('id,avatarimage,mobile,re_id,user_name,createtime,realname')
//            ->order('id desc')
//            ->select();
//
//        $recommendNumber = MemberModel::where(['re_id'=>$user['data']['id']])->count();
//        $teamNumber = MemberModel::where($where)->count();
//        $all_data["list"]=$list;
//        $all_data["recommendNumber"]=$recommendNumber;
//        $all_data["teamNumber"]=$teamNumber;
//        $all_data["share_income"]=$user["data"]["share_income"];
//        return $this->success("获取成功",$all_data);
//    }

    //转账
    public function transfer(){
        (new Transfer())->goCheck();
        $data =  $this->request->param();
        $user = $this->member->userInfo($data,"id,status,integrals,paypwd,user_name");
        if (!$user["status"]) return $this->error("此账户已被禁止");
        $friend = $this->member->findUserMobile($data["mobile"],"id,user_name,re_path,token");
        if (!$friend) return $this->error("会员不存在");
        if(!in_array($user["data"]['id'],explode(',',$friend['re_path'])))return $this->error('只能转给团队下线');
        if ($user["data"]["paypwd"]!=saltPassword($data["paypwd"])) return $this->error("支付密码不正确");
        if ($user["data"]["integrals"]<$data["money"]) return $this->error("余额不足");

        $capital = 'integrals';
        $money =$data["money"];

        Db::startTrans();
        try {
            MemberModel::update([
                'id' =>$user["data"]['id'],
                "$capital" => Db::raw("$capital-$money"),
            ]);
            History::create([
                'uid' => $user["data"]['id'],
                'money' => -$money,
                'type' => $capital,
                'remark' => "转账给用户".$friend['user_name'],
                'option' => 'expend',
                'source' => 'transfer',
            ]);
            MemberModel::update([
                'id' =>$friend['id'],
                "$capital" => Db::raw("$capital+$money"),
            ]);
            History::create([
                'uid' => $friend['id'],
                'money' => +$money,
                'type' => $capital,
                'remark' => "接收到转账".$user["data"]["user_name"],
                'option' => 'income',
                'source' => 'transfer',
            ]);

            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
           return $this->error("网络异常,转账失败");
        }
        return $this->success("转账成功");
    }

    //登陆
    public function login(){
        (new LoginSave())->goCheck();
         $data =  $this->request->param();
         $user =  $this->member->findUserMobile($data["mobile"],"id,mobile,password,status,token");
        if (!$user) return $this->error("该手机号码未注册");
        if(saltPassword($data["password"])!==$user["password"]){return $this->error("密码不正确");}
        if(!$user["status"]){
//            Db::name("member")->where("id",$user["id"])->update(["token"=>""]);
            return $this->error("账户被封禁");
        }
        $isOk =  $this->member->updataUserLoginTime($user["id"]);
        return $this->success("登陆成功",["token"=>$user["token"]]);
    }


    //注册
    public function register()
    {
        (new  RegisterSave())->goCheck();
         if (!setting("website_open")["website_open"]) return $this->error("暂时不开放注册");
         $data =  $this->request->param();
         $isUser = $this->member->findUserMobile($data["mobile"],"mobile");
         if($isUser) return $this->error("该手机号已注册");
         $isShare_code =$this->member->findUserShare_code($data["share_code"],"id,status,re_level,re_path");
         if (!$isShare_code) return $this->error("邀请码不正确");
         if ($isShare_code["status"]!=1) return $this->error("该邀请码用户被封禁");
         if ($data["password"]!==$data["password_tow"]) return $this->error("两次输入密码不相同");
         if ($data["paypwd"]!==$data["paypwd_tow"]) return $this->error("两次输入支付密码不相同");
         $data["re_id"]=$isShare_code["id"];
         $data["re_level"]=$isShare_code["re_level"]+1;
         $data['re_path'] = $isShare_code['re_path'] . $isShare_code['id'] . ',';
         $token = $this->member->createrUser($data);
         if ($token){
             return $this->success("注册成功",$token);
         }
    }



    //我的预约
    public function myApply(){
        (new Token())->goCheck();
        $data =  $this->request->param();
        $user = $this->member->userInfo($data,"id,status");
        if (!$user["status"]) return $this->error("该账户已被禁止");
        $list =  Apply::finApply($user["data"]["id"]);
        return $this->success("获取成功",$list);
    }


    //实名认证
    public function authentication(){
        (new  AuthenticationSave())->goCheck();
        $data =  $this->request->param();
        $newData =cleanUrl($data);
        $user = $this->member->userInfo($newData,"id,idcard,status");
        if (!$user["status"]){
            return $this->error("该账户已被禁止");
        }
        if ($user["data"]["idcard"]){return $this->error("用户已绑定身份证");};
        if ($this->member->idcardCount($newData["idcard"])){return  $this->error("该身份证只能认证3次");};

        $integrals_num =15;
        $capital = 'integrals';
        $isOk = $this->member->get($user["data"]["id"])->save([
            "realname"=>$newData["realname"],
            "idcard"=>$newData["idcard"],
            "collectionimage"=>$newData["collectionimage"],
            "$capital"=>Db::raw("$capital+$integrals_num"),
        ]);
        if ($isOk){
            return $this->success("实名成功");
        }


    }

    //金钱明细
    public function moneyLog(){
        (new MoneyLog())->goCheck();
        $data =  $this->request->param();
        $user = MemberModel::memberInfo($data,"id,status");
        if(!$user["status"]) return $this->error("账户被封禁");
        $list = History::findMoneyLog($user["data"]["id"]);
        return $this->success("获取成功",$list);
    }
    //推广收益
    public function extension(){
        (new Token())->goCheck();
        $data =  $this->request->param();
        $user = $this->member->userInfo($data,"id,status");
        if (!$user["status"]) return $this->error("该账户已被禁止");
        $list =History::findExtension($user["data"]["id"]);
        return $this->success("获取成功",$list);
    }




    //二维码
    public function createQRcode($savePath, $qrData = 'PHP QR Code :)', $qrLevel = 'L', $qrSize = 4, $savePrefix = 'qrcode')
    {
        if (!isset($savePath)) return '';
        //设置生成png图片的路径
        $PNG_TEMP_DIR = $savePath;

        //检测并创建生成文件夹
        if (!file_exists($PNG_TEMP_DIR)) {
            mkdir($PNG_TEMP_DIR);
        }
        $filename = $PNG_TEMP_DIR . 'test.png';

        $errorCorrectionLevel = 'L';
        if (isset($qrLevel) && in_array($qrLevel, ['L', 'M', 'Q', 'H'])) {
            $errorCorrectionLevel = $qrLevel;
        }
        $matrixPointSize = 4;
        if (isset($qrSize)) {
            $matrixPointSize = min(max((int)$qrSize, 1), 10);
        }
        if (isset($qrData)) {
            if (trim($qrData) == '') {
                die('data cannot be empty!');
            }
            //生成文件名 文件路径+图片名字前缀+md5(名称)+.png
            $filename = $PNG_TEMP_DIR . $savePrefix . md5($qrData . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
            //开始生成

            \QRcode::png($qrData, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        } else {
            \QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        }
        if (file_exists($PNG_TEMP_DIR . basename($filename)))
            return basename($filename);
        else
            return FALSE;
    }

    //用户推广二维码
    public function recommend(){
        (new  Token())->goCheck();
        $data =  $this->request->param();
        $user = $this->member->userInfo($data,"id,status,share_code");
        if (!$user["status"]){
            return $this->error("该账户已被禁止");
        }
        $savePath = APP_PATH . '/qrcode/';
        $webPath = '/qrcode/';
//        $qrData = '192.168.1.7/#/pages/auth/register?type=0&id='.$user["data"]["id"];
        $qrData = 'www.baidu.com';
        $qrLevel = 'H';
        $qrSize = '8';
        $savePrefix = 'NickBai'.$user["data"]["id"];
        if($filename = $this->createQRcode($savePath, $qrData, $qrLevel, $qrSize,$savePrefix)){
            $url = $this->request->domain()."/newinfo/public/qrcode/".$filename;
            $user["data"]["img"]=$url;
            return $this->success("获取成功",$user);
        }

    }


}