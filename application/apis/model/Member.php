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
        $finalUrl = $request->domain()."/x00730/public".$value;
        return $finalUrl;
    }

    public  static function findAllUser(){

       return Db::name("member")->where("status",1)->select();
    }

    public function checkShareLevel($rid){
        $res = self::where(['id' => $rid])->find();
        if($res){
            switch($res['share_group']){
                case 1:return '初级推广大使';break;
                case 2:return '中级推广大使';break;
                case 3:return '高级推广大使';break;
                default:break;
            }
        }
    }

    /**
     * 用户下单成功之后，去进行直推上级的级别认定
     * @param $reid
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function countEffectShare($reid){
        $res =  self::where([
            're_id' => $reid,
            'is_valid' => 1
        ])->select();
        if($res){
            $effectmember = count($res);
            switch ($effectmember){
                case 5: self::where(['id' => $reid])->setInc('share_group',1);break;
                case 10: self::where(['id' => $reid])->setInc('share_group',2);break;
                case 20: self::where(['id' => $reid])->setInc('share_group',3);break;
                default:break;
            }

        }
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