<?php


namespace app\apis\model;
use app\apis\model\Apply;
use app\apis\model\Match;
use think\Request;
class Dog extends BaseModel
{
    protected $name ="dog";
    public function initialize(){
        parent::initialize();
    }

    protected function getImageAttr($value){
        $request = Request::instance();
        $finalUrl = $request->domain()."/newinfo/public".$value;
        return $finalUrl;
    }


    public function getDogList($uid)
    {
       $list =  $this->where("is_sell",1)->order('id asc')->select();
        $wait_refresh_second = 0;
       if ($list){
          $rod =  setting("dog_rob_model")["dog_rob_model"];  //0 是系统随机 1 是会员优先
          foreach ($list as $k=>$v)
          {
              $list[$k]['dog_button_status'] = 'apply';  //todo 预约状态
              $isApply = Apply::where(["uid"=>$uid])
                  ->where(["dog_id"=>$v['id']])
                  ->whereTime("createtime","d")
                  ->count();

              if ( $isApply >0 )$list[$k]['dog_button_status'] = 'have_apply';  //todo 已预约状态

              $sell_s_time = strtotime($v['sell_s_time']);    //抢购开始时间
              $sell_e_time = strtotime($v['sell_e_time']);    //抢购结束时间
              //抢购前2分钟开始倒计时
              //假设领养时间14:50  两分钟 14:48
              //刚进去14:48  判断在48和50区间
              $time = time();
              $countdown_start = $sell_s_time - 120;

              if ( $time >= $countdown_start && $time < $sell_s_time){
                  $v['d'] = floor(($sell_s_time-$time)/86400);
                  $v['h'] = floor(($sell_s_time-$time)%86400/3600);
                  $v['m'] = floor(($sell_s_time-$time)%86400/60)%60;
                  $v['s'] = floor(($sell_s_time-$time)%86400%60);
                  $v['dog_button_status'] = 'countdown';  //todo 倒计时状态
              }

              if ( $time < $countdown_start ){
                  $surplus_time = $countdown_start - $time;   //48-20剩下的时间     28
                  if ( $wait_refresh_second == 0 )$wait_refresh_second = $surplus_time;
                  if ( $wait_refresh_second > $surplus_time )$wait_refresh_second = $surplus_time;
              }


              //今天是否存在已领养
              $todayAdopt =Match::where("uid",$uid)
                  ->where('order_type',0)
                  ->where("dog_id",$v["id"])
                  ->whereTime("createtime","today")
                  ->count()?:0;

              if ( $todayAdopt>0 ){
                  $list[$k]['dog_button_status'] = 'have_adopt';  //todo 已领养状态
              }

              if ( $time >= $sell_s_time && $time < $sell_e_time ){
                  $list[$k]['dog_button_status'] = 'adopt';   //todo 抢购、领养状态
              }
              if ( $time >= $sell_e_time )$list[$k]['dog_button_status'] = 'breed'; //todo 繁殖中状态


          }


       }
       return ["list"=>$list,"wait_refresh_second"=>$wait_refresh_second];
    }



    public  function getDogInfo($id,$field="*"){
        return $this->where("id",$id)->field($field)->find();
    }

}