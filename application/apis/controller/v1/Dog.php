<?php


namespace app\apis\controller\v1;
use app\apis\model\Dog as DogModel;
use app\apis\validate\BuyIct;
use app\apis\validate\Token;
use app\apis\model\Member;
use app\apis\model\Apply as ApplyModel;
use app\apis\validate\Apply;
use app\apis\model\History;
use app\apis\model\Robbing;
use app\apis\model\Matched;
use app\apis\model\Match;
use app\apis\validate\AdoptDog;
use app\apis\validate\HireItc;
use think\Db;
use think\Queue;

class Dog extends BaseController
{
    protected  $dog;
    public function __construct()
    {
        parent::_initialize();
        $this->dog =new DogModel();
    }
    //体验机接口
    public function getExperienceMachine(){
        (new Token())->goCheck();
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status");
        if(!$user["status"]) return $this->error("账户被封禁");
        $dog = $this->dog->getExperienceMachine();
        return $this->success("获取成功",$dog);
    }


    public function testUserReId(){
        $data = $this->request->param();
        $user = (new Member())->where(['token' => $data['token']])->find();
        $arr[0] = $user;
        if(!$user["status"]) return $this->error("账户被封禁");
        (new Member())->sortFindTeamUser($arr, 0);
        $temp = 1;
        for($i=0;$i<count($arr);$i++){
           if($arr[$i]->share_group > $i){
               if($i <= 1){
                   echo '3%';
               }else if($i <= 2){
                   echo '2%';
               }else if($i <= 5){
                   echo '1%';
               }
           }
        }
    }

    //租赁接口
    public function getHireItc(){
        (new HireItc())->goCheck();
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status");
        if(!$user["status"]) return $this->error("账户被封禁");
        $dog =$this->dog->getTypeDog($data);
        return $this->success("获取成功",$dog);
    }


    //最近itc接口
    public function recentlyItc(){
        (new Token())->goCheck();
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status");
        if(!$user["status"]) return $this->error("账户被封禁");
        $list = Match::recentlyItc();
        foreach ($list as $k){
           $k["mobile"]=encryptTel($k["mobile"]);
        }
        return $this->success("获取成功",$list);
    }


    //购买矿机
    public function buyIct(){
        (new BuyIct())->goCheck();
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status,integrals,user_name,re_id,re_path,is_valid,is_first,share_group");
        if(!$user["status"]) return $this->error("账户被封禁");
        $iddata = array_filter(array_map('intval', explode(',', $user['data']['re_path']))) ;

        $where = [
            'id' =>[ 'in', $iddata]
        ];
        $userheigher = (new Member())->where($where)->field('id,user_name,token,re_id,re_level')->select();
        $newhigherdata = [];
        $level = [];

        foreach ($userheigher as $k => $v){
            $arr = [
                'id' => $v['id'],
                'level' => $v['re_level'] + 1,
                'user_name' => $v['user_name']
            ];
            $level[$k] = $v['re_level'];
            array_push($newhigherdata,$arr);
        }
        array_multisort($level,SORT_ASC,$newhigherdata);

        $range1 = [3,4,5,6,7];
        $range2 = [8,9,10,11,12,13,14,15];
        $insertMoney = [];
        //设置返利规则
        foreach ($newhigherdata as $k1 => $v1){
            if($v1['level'] == 1){
                //一级 3%
                $array = [
                    'user_id' => $v1['id'],
                    'rebate' => 0.03
                ];
                array_push($insertMoney,$array);
            }else if($v1['level'] == 2){
                // 二级 2%
                $array = [
                    'user_id' => $v1['id'],
                    'rebate' => 0.02
                ];
                array_push($insertMoney,$array);
            }else if(in_array($v1['level'],$range1)){
                //3到7级 1%
                $array = [
                    'user_id' => $v1['id'],
                    'rebate' => 0.01
                ];
                array_push($insertMoney,$array);
            }else if(in_array($v1['level'],$range2)){
                //8到15级 0.5%
                $array = [
                    'user_id' => $v1['id'],
                    'rebate' => 0.005
                ];
                array_push($insertMoney,$array);
            }
        }

        if ($data["money"]>$user["data"]["integrals"])  return $this->error("余额不足");
        $isItc =  Match::findDayItc($user["data"]["id"],$data["dog_id"]);
        if ($isItc) return $this->error("该类型矿机每天只能购买一次");
        if (Match::findExperienceItc($user["data"]["id"],$data["dog_id"])) return $this->error("体验机只能购买一次");
        $data["uid"]=$user["data"]["id"];
//
        Db::startTrans();

        try {
            //处理推广购买分成
            foreach ($insertMoney as $k => $v){
                $momberdetail = Member::get($v['user_id']);
                $share_income = $data['money']*$v['rebate'];
                $updatedata = [
                    'integrals' => $momberdetail['integrals']+$share_income,
                    'share_income' => $momberdetail['share_income'] + $share_income
                ];
                (new Member())->where(['id' => $v['user_id']])->update($updatedata);
                History::create([           //加入日志
                    "uid"=>$v['user_id'],
                    "money"=>$share_income,
                    "type"=>"share_incomes",
                    "remark"=>"直推有效会员奖励,来自{$user['data']['user_name']}的推广购买分成",
                    "option"=>"income"
                ]);
            }

            //处理团队提成很红
            $sortuser = (new Member())->where(['token' => $data['token']])->find();
            $sorteamtarr[0] = $sortuser;
            if(!$user["status"]) return $this->error("账户被封禁");
            (new Member())->sortFindTeamUser($sorteamtarr, 0);
            for($i=0;$i<count($sorteamtarr);$i++){
                if($sorteamtarr[$i]->share_group > $i){
                    //判断级数进行提成分红
                    if($i <= 1){
                        $team_share_income = $data['money']*0.03;
                        $teamshareupdatedata = [
                            'integrals' => $sorteamtarr[$i]->integrals+$team_share_income,
                            'share_income' => $sorteamtarr[$i]->share_income + $team_share_income
                        ];
                        (new Member())->where(['id' => $sorteamtarr[$i]->id])->update($teamshareupdatedata);

                    }else if($i <= 2){
                        $team_share_income = $data['money']*0.02;
                        $teamshareupdatedata = [
                            'integrals' => $sorteamtarr[$i]->integrals+$team_share_income,
                            'share_income' => $sorteamtarr[$i]->share_income + $team_share_income
                        ];
                        (new Member())->where(['id' => $sorteamtarr[$i]->id])->update($teamshareupdatedata);

                    }else if($i <= 5){
                        $team_share_income = $data['money']*0.01;
                        $teamshareupdatedata = [
                            'integrals' => $sorteamtarr[$i]->integrals+$team_share_income,
                            'share_income' => $sorteamtarr[$i]->share_income + $team_share_income
                        ];
                        (new Member())->where(['id' => $sorteamtarr[$i]->id])->update($teamshareupdatedata);

                    }else{
                        $team_share_income = $data['money']*1;
                        $teamshareupdatedata = [
                            'integrals' => $sorteamtarr[$i]->integrals,
                            'share_income' => $momberdetail['share_income']
                        ];
                        (new Member())->where(['id' => $sorteamtarr[$i]->id])->update($teamshareupdatedata);

                    }

                    History::create([           //加入日志
                        "uid"=>$sorteamtarr[$i]->id,
                        "money"=>$team_share_income,
                        "type"=>"share_incomes",
                        "remark"=>"直推有效会员奖励,来自{$user['data']['user_name']}的团队推广购买分成",
                        "option"=>"income"
                    ]);

                }
            }
            Match::createOrder($data); //创建订单
            Member::get($data["uid"])->setDec("integrals",$data["money"]);//减少余额
            (new Member())->where(['id'=>$data['uid']])->update(["is_valid" => 1]);
            Member::countEffectShare($user['data']['re_id']);
            History::createHistory($data);//加入日志
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return $this->error("网络异常,充值失败");
        }

        if ($user["data"]["re_id"]){    //推荐者存在
            $money = setting("recommend_user")["recommend_user"];
            if($user['data']['is_first'] == 0){
                Member::get($user["data"]["re_id"])->setInc("integrals",$money);//奖励余额
                Member::get($user["data"]["re_id"])->setInc("share_income",$money);//推广奖励
                History::create([           //加入日志
                    "uid"=>$user["data"]["re_id"],
                    "money"=>$money,
                    "type"=>"share_incomes",
                    "remark"=>"直推有效会员奖励",
                    "option"=>"income"
                ]);
                (new Member())->where(['id'=>$data['uid']])->update(["is_first" => 1]);//推广奖励，仅一次
            }
        }
        return $this->success('下单成功');

    }



































    //获取产品列表
    public function getDogList()
    {
        (new Token())->goCheck();
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status");
        if(!$user["status"]) return $this->error("账户被封禁");

//        $list =  $this->dog->getDogList($user["data"]["id"]);
//        return $this->success("获取成功",$list);
    }




    //预约
    public function apply(){
        (new Apply())->goCheck();
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status,integrals");
        if(!$user["status"]) return $this->error("账户被封禁");
        $dog = $this->dog->getDogInfo($data["dog_id"],"id,is_sell,sell_s_time,apply_fee,title");
        if (!$dog) return $this->error("产品不存在");
        if(!$dog["is_sell"]) return $this->error("已停售");
        if (time() >= strtotime($dog['sell_s_time'])) return $this->error('预约时间已过');
        $isApply =ApplyModel::isApply($user["data"]["id"],$dog["id"]);
        if ($isApply) return $this->error("今天已预约过");
        if ($user["data"]["integrals"]<$dog["apply_fee"]) return  $this->error('余额不足预约');

        $applyFee = $dog['apply_fee'];
        $capital = 'integrals';

        Db::startTrans();
        try {
            ApplyModel::create([
                'uid' => $user["data"]['id'],
                'dog_id' => $dog['id'],
                'apply_fee' => $dog["apply_fee"],
            ]);
            Member::update([
                'id' => $user["data"]['id'],
                "$capital" => Db::raw("$capital-$applyFee"),
                "effective" => 1,
            ]);
            History::create([
                'uid' => $user["data"]['id'],
                'money' => -$applyFee,
                'type' => $capital,
                'remark' => "预约" . $dog['title'],
                'option' => 'expend',
            ]);
            //todo 加入抢购资格
            $param=["uid"=>$user["data"]["id"],"dog_id"=>$dog["id"]];

            $this->createRobbingQueue($param);
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return  $this->error('网络超时');
        }
        return $this->success("预约成功");
    }

    //抢购
    public function joinRob(){
        (new Apply())->goCheck();
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status,integrals");
        if(!$user["status"]) return $this->error("账户被封禁");
        $dog = $this->dog->getDogInfo($data["dog_id"],"id,is_sell,sell_s_time,sell_e_time,adopt_fee,apply_fee,title");
        if (!$dog) return $this->error("产品不存在");
        if(!$dog["is_sell"]) return $this->error("商品已下架");
        $isApply =ApplyModel::isApply($user["data"]["id"],$dog["id"]);
        if ($isApply==0 && $user["data"]['integrals'] < $dog['adopt_fee'])  return $this->error("余额不足");
        //选定用户优先
//        if (setting("dog_rob_model")["dog_rob_model"]==1){
//
//        }
        $this->createRobbingQueue(["uid"=>$user["data"]["id"],"dog_id"=>$dog["id"]],$type="addJob");

        return $this->success("抢购进行中");


    }



    //查询抢购结果
    public function adopt_dog(){
        ((new AdoptDog))->goCheck();
        $data =  $this->request->param();
        $user = Member::memberInfo($data,"id,status,integrals");
        if(!$user["status"]) return $this->error("账户被封禁");
        if ($data["number"]>=4){
            Robbing::deleteRobbing($user["data"]["id"],$data["dog_id"]);
        }
       $isMatched =  Matched::todayMatched($user["data"]["id"],$data["dog_id"]);
       if ($data["number"]==1){
           return $this->success("系统正在匹配中");
       }
        if ($data["number"]==2){
            return $this->success("请耐心等待哦");
        }
        if ($data["number"]==3){
            return $this->success("加油，快要抢到了");
        }
        if ($isMatched){
          return $this->success("恭喜你抢购成功");
       }else{
           return $this->success("很遗憾，抢购失败!!");
       }




    }




    //抢购资格
    public function createRobbingQueue($data,$type="")
    {

        $onRob =  Robbing::where([
           "uid"=> $data["uid"]
        ])->where(["dog_id"=>$data["dog_id"]])
            ->count();
        if ($onRob == 0) {
            $result = Robbing::create([
                'uid' => $data["uid"],
                'dog_id' => $data["dog_id"],
                'unique' => robDogSalt($data["uid"], $data["dog_id"])
            ]);
        }
        if ($type=="addJob"){
            $this->test($data);
        }

    }


    public function test($data)
    {

        $jobHandlerClassName = 'app\job\RobPet';
        // 2.当前任务归属的队列名称，如果为新队列，会自动创建
        $jobQueueName = "helloJobQueue";
        // 3.当前任务所需的业务数据 . 不能为 resource 类型，其他类型最终将转化为json形式的字符串
        //   ( jobData 为对象时，需要在先在此处手动序列化，否则只存储其public属性的键值对)
        $jobData = $data;
        // 4.将该任务推送到消息队列，等待对应的消费者去执行
        $isPushed = Queue::push($jobHandlerClassName, $jobData, $jobQueueName);
        // database 驱动时，返回值为 1|false  ;   redis 驱动时，返回值为 随机字符串|false
        if ($isPushed !== false) {

        }
    }





}