<?php


namespace app\apis\controller\v1;
use app\apis\model\Member;
use think\Db;
use app\apis\model\History;
use app\apis\model\Match;
class TimeEvent extends BaseController
{
    public function __construct()
    {
        parent::_initialize();
    }

    //实时查询给用户发送金额 每分钟查询一次
    public function saveUserMoney(){

          $moeny =  setting("money_save")["money_save"];
          $userList =Member::findAllUser();
          $now_time = date("H:i");
          foreach ($userList as $k){
               if ($k["start_time"]==$now_time)
               {
                  Db::name("member")
                      ->where("id",$k["id"])
                      ->setInc("integrals",$moeny);
                   Db::name("member")
                       ->where("id",$k["id"])
                       ->setInc("day",1);
                  History::create([
                      "uid"=>$k["id"],
                      "money"=>$moeny,
                      "type"=>"integrals",
                      "remark"=>"用户注册每日赠送收益",
                      "option"=>"income"
                  ]);
               }
          }
    }

    //矿机收益
    public function itcIncome(){
        $orderList = Match::findAllOrder();
        foreach ($orderList as $k)
        {
//           如果是体验机  不参加分红
            if ($k["type"]==0){
                if ($k["payment_time"]==date("Y-m-d H:i"))
                {
                    Db::name("match")
                        ->where("id",$k["id"])
                        ->update(["move_day"=>1, "return_money"=>$k["return_money_all"],"status"=>1]); //加天数改状态
                    Db::name("member")->where("id",$k["uid"])
                        ->inc("integrals",$k["return_money_all"])
                        ->inc("itc_income",$k["return_money_all"])
                        ->update(); //用户钱
                    History::create([
                        "uid"=>$k["uid"],
                        "money"=>$k["return_money_all"],
                        "type"=>"itc_income",
                        "remark"=>"矿机{$k["dog_name"]}收益",
                        "option"=>"income"      //写日志
                    ]);
                }
            }
            //如果是每日机
            if ($k["type"]==1){
                //在最后一天之前改天数
                if ($k["every_day_time"]==date("H:i")&&$k["period_day"]>($k["move_day"]+1)){
                    Db::name("match")
                        ->where("id",$k["id"])
                        ->inc("move_day",1)
                        ->inc("return_money",$k["return_money_day"])
                        ->update();
                    Db::name("member")->where("id",$k["uid"])
                        ->inc("integrals",$k["return_money_day"])
                        ->inc("itc_income",$k["return_money_day"])
                        ->update(); //加用户钱
                    History::create([
                        "uid"=>$k["uid"],
                        "money"=>$k["return_money_day"],
                        "type"=>"itc_income",
                        "remark"=>"矿机{$k["dog_name"]}收益",
                        "option"=>"income"      //写日志
                    ]);
                }
                //在最后一天改状态
                if($k["payment_time"]==date("Y-m-d H:i")) {
                    Db::name("match")
                        ->where("id",$k["id"])
                        ->inc("move_day",1)
                        ->inc("return_money",$k["return_money_day"])
                        ->update(["status"=>1]);

                    Db::name("member")->where("id",$k["uid"])
                        ->inc("integrals",$k["return_money_day"])
                        ->inc("itc_income",$k["return_money_day"])
                        ->update(); //加用户钱

                    History::create([
                        "uid"=>$k["uid"],
                        "money"=>$k["return_money_day"],
                        "type"=>"itc_income",
                        "remark"=>"矿机{$k["dog_name"]}收益",
                        "option"=>"income"      //写日志
                    ]);



                }

            }

            //如果是到期机
            if ($k["type"]==2){
                //在最后一天之前改天数
                if ($k["every_day_time"]==date("H:i")&&$k["period_day"]>($k["move_day"]+1)){
                    Db::name("match")
                        ->where("id",$k["id"])
                        ->inc("move_day",1)
                        ->update();
                }
                //在最后一天改状态
                if ($k["payment_time"]==date("Y-m-d H:i")){

                    Db::name("match")
                        ->where("id",$k["id"])
                        ->inc("move_day",1)
                        ->inc("return_money",$k["return_money_all"])
                        ->update(["status"=>1]);

                    Db::name("member")->where("id",$k["uid"])
                        ->inc("integrals",$k["return_money_all"])
                        ->inc("itc_income",$k["return_money_all"])
                        ->update(); //加用户钱

                    History::create([
                        "uid"=>$k["uid"],
                        "money"=>$k["return_money_all"],
                        "type"=>"itc_income",
                        "remark"=>"矿机{$k["dog_name"]}收益",
                        "option"=>"income"      //写日志
                    ]);


                }


            }

















        }
    }



}