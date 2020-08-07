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
        $user = Member::memberInfo($data,"id,status,integrals,re_id,is_valid");
        if(!$user["status"]) return $this->error("账户被封禁");
        if ($data["money"]>$user["data"]["integrals"])  return $this->error("余额不足");
        $isItc =  Match::findDayItc($user["data"]["id"],$data["dog_id"]);
        if ($isItc) return $this->error("该类型矿机每天只能购买一次");
        if (Match::findExperienceItc($user["data"]["id"],$data["dog_id"])) return $this->error("体验机只能购买一次");
        $data["uid"]=$user["data"]["id"];
        Match::createOrder($data); //创建订单
        Member::get($data["uid"])->setDec("integrals",$data["money"]);//减少余额
        History::createHistory($data);//加入日志
        if ($user["data"]["re_id"]){    //推荐者存在
            $money = setting("recommend_user")["recommend_user"];
            Member::get($user["data"]["re_id"])->setInc("integrals",$money);//奖励余额
            Member::get($user["data"]["re_id"])->setInc("share_income",$money);//推广奖励
            History::create([           //加入日志
                "uid"=>$user["data"]["re_id"],
                "money"=>$money,
                "type"=>"share_incomes",
                "remark"=>"直推有效会员奖励",
                "option"=>"income"
            ]);
        }

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