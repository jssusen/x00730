<?php


namespace app\apis\model;
use think\Db;
use think\Request;
class Member extends  BaseModel
{

    protected $name ="member";
    public function initialize(){
        parent::initialize();
    }

    protected function getAvatarImageAttr($value){
        $request = Request::instance();
        $finalUrl = $request->domain()."/newinfo/public".$value;
        return $finalUrl;
    }

    public  static function findAllUser(){

       return Db::name("member")->where("status",1)->select();
    }


    public function createrUser($data){
       foreach ($data as $k=>$v)
       {
           if ($k=="paypwd"||$k=="password")
           {
               $data[$k]=saltPassword($v);
           }
           $data["token"]=createrToken();
           $data["start_time"]=create_fast_time();
           $data["login_ip"]=Request::instance()->ip();
           $data["share_code"]= create_invite_code();
           $data["member_group_id"]=MemberGroup::min("id");
           $data["avatarimage"]="/avatar/avatar.jpg";
           unset($data["version"]);
           unset($data["password_tow"]);
           unset($data["paypwd_tow"]);
       }
       $user = self::create($data);
       return $user->token;
    }

    public  function findUserMobile($mobile,$field="*")
    {
      return $this->where("mobile",$mobile)->field($field)->find();
//        return Db::name("member")->where("mobile",$mobile)->field($field)->find();
    }

    public function findUserShare_code($share_code,$field="*")
    {
        return $this->where("share_code",$share_code)->field($field)->find();
    }

    public function idcardCount($idcard){
        $user = self::where("idcard",$idcard)->count();
        if ($user>3){
            return true;
        }else{
            return false;
        }
    }

    public function updataUserLoginTime($id){
       $isOk = $this->get($id)->save([
            "login_time"=>time(),
            "login_ip" =>Request::instance()->ip()
        ]);
       return $isOk;
    }

    public  static function memberInfo($param,$field="*"){
        if (!$param['token']) return ['status' => 0, 'msg' => '请登录', 'data' => []];
//        $user_info =  Db::name("member")->where("token",$param["token"])->field($field)->find();
        $user_info =  self::where("token",$param["token"])->field($field)->find();
        if ($user_info){
            if ($user_info['status'] != 1) {

                return ['status' => 0, 'msg' => '账号已被锁定', 'data' => []];
            }
            return ['status' => 1, 'msg' => '加载成功', 'data' => $user_info];
        }else{
            return ['status' => 0, 'msg' => 'token不存在或者未登录', 'data' => []];
        };
    }

    public function userInfo($param,$field="*"){
        if (!$param['token']) return ['status' => 0, 'msg' => '请登录', 'data' => []];
        $user_info =  self::where("token",$param["token"])->field($field)->find();
        if ($user_info){
            if ($user_info['status'] != 1) {
//                \app\apis\model\Member::where('id', $user_info['id'])->update(['token' => '']);
                return ['status' => 0, 'msg' => '账号已被锁定', 'data' => []];
            }
            return ['status' => 1, 'msg' => '加载成功', 'data' => $user_info];
        }else{
            return ['status' => 0, 'msg' => 'token不存在或者未登录', 'data' => []];
        };
    }




}