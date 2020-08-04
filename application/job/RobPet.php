<?php

namespace app\job;
use app\apis\model\Apply;
use think\Db;
use think\Exception;
use think\queue\Job;
use app\apis\model\Dog;
use  app\apis\model\Match;
use app\apis\model\Member;
use app\apis\model\Robbing;
use app\apis\model\History;
use app\apis\model\Matched;

class RobPet
{
    public function fire(Job $job, $data){
        //....这里执行具体的任务
        $isJobDone = $this->send($data);
        if ($isJobDone) {
            //成功删除任务
            print("开始删除");
            $job->delete();
            print("成功删除");

        } else {
            //任务轮询4次后删除
            if ($job->attempts() > 3) {
                print("轮询了吗");
                // 第1种处理方式：重新发布任务,该任务延迟10秒后再执行
                //$job->release(10);
                // 第2种处理方式：原任务的基础上1分钟执行一次并增加尝试次数
                //$job->failed();
                // 第3种处理方式：删除任务
                $job->delete();

            }
        }

    }


    private function send($data){
       $dogInfo =  Dog::get($data["dog_id"])->find();
       if ($dogInfo){
           Db::startTrans();
           try {
           $selling =  Match::findRollOutOrder($dogInfo["id"]);//查询是否有挂卖?
           if ($selling) {
                   $robbing = $this->robbingPower($selling["uid"],$dogInfo["id"]);//随机查询抢购队列？
                   $apply = Apply::findApply($robbing["uid"],$dogInfo["id"]);  //检查是否预约？
                   if ($apply){
                       $adopt_fee = 0;   //如果预约改预约状态
                       Apply::update([
                           'id' => $apply['id'],
                           'status' => 1,
                       ]);
                   }else{
                       $adopt_fee = $dogInfo['adopt_fee'] ?: 0;
                   }
                   if ($adopt_fee>0){       //没有预约直接扣除领养费
                       Member::where('id', $robbing['uid'])->update([
                           'integrals' => db::raw('integrals-' . $adopt_fee),
                       ]);
                       History::create([            //写入日志
                           'uid' => $robbing['uid'],
                           'money' => -$adopt_fee,
                           'type' => 'integrals',
                           'remark' => '抢购' . $dogInfo['title'],
                           'option' => 'expend',
                       ]);
                   }
                   //创建预约成功订单
                   $order_id = chr(mt_rand(65, 90)) . date('YmdHis') . mt_rand(1, 999) . mt_rand(1, 999);
                   Match::create([
                       'order_id' => $order_id,
                       'uid' => $robbing['uid'],
                       'money' => $selling['unmatched'],
                       'order_type' => 0,
                       'match_status' => 2,
                       'dog_id' => $dogInfo['id'],
                   ]);
                   //修改转让订单状态
                   Match::update([
                       'id' => $selling['id'],
                       'match_status' => 2,
                       'unmatched' => 0,
                   ]);

                   //创建匹配的订单
                   $matchOrderId = chr(mt_rand(65, 90)) . date('YmdHis') . mt_rand(1, 999) . mt_rand(1, 999);

                   Matched::create([
                       'order_id' => $matchOrderId,
                       'in_order_id' => $order_id,
                       'out_order_id' => $selling['order_id'],
                       'uid' => $robbing['uid'],
                       'bid' => $selling['uid'],
                       'money' => $selling['unmatched'],
                       'dog_id' => $dogInfo['id'],
                       'grow_day' => $dogInfo['grow_day'],
                       'gains' => $dogInfo['gains'],
                       'wia' => $dogInfo['wia'],
                       'doge' => $dogInfo['doge'],
                   ]);
               Db::commit();
           }
           }catch (\Exception $e){
               Db::rollback();
           }


       }

    }

    //获取一条随机抢购队列
    private function robbingPower($uid,$dog_id){
        $wheres=[];
        if (setting("dog_rob_model")){    //会员优先抢购模式
          $user =  Db::name("member")->where([
                "status"=>1,
                "robber"=>1
            ])->field("id")->select();

          $user_id=[];
          foreach ($user as $k=>$v)
          {
              if ($v["id"]==$uid){
                  continue;
              }
              array_push($user_id,$v["id"]);
          }

          $wheres["uid"]=["in",$user_id];
        }

        $robber = Robbing::where("uid","neq",$uid)
            ->where("dog_id",$dog_id)
            ->where($wheres)
            ->orderRaw('rand()')->lock(true)->find();
        return $robber;
    }



}