<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
Route::post('apis/:version/business','apis/:version.business/index');
Route::post('apis/:version/upload','apis/:version.upload/uploadImg');//上传
Route::post('apis/:version/register','apis/:version.member/register');//注册
Route::get('apis/:version/authentication','apis/:version.member/authentication');//实名认证
Route::post('apis/:version/login','apis/:version.member/login');//登陆
Route::get('apis/:version/work_save','apis/:version.WorkOrder/workSave');//工单提交
Route::get('apis/:version/word_record','apis/:version.WorkOrder/wordRecord');//工单列表
Route::get('apis/:version/new','apis/:version.NewSave/index');//新闻
Route::get('apis/:version/details','apis/:version.NewSave/details');//新闻详情
Route::get('apis/:version/user_info','apis/:version.member/getUserInfo');//用户信息
Route::get('apis/:version/recommend','apis/:version.member/recommend');//用户推广二维码

Route::get('apis/:version/transfer','apis/:version.member/transfer');//转账
Route::get('apis/:version/money_log','apis/:version.member/moneyLog');//羽化币
Route::get('apis/:version/my_apply','apis/:version.member/myApply');//我的预约

Route::get('apis/:version/share_line','apis/:version.MyTeam/shareLine');//我的团队
Route::post('apis/:version/check/pw','apis/:version.MyTeam/checkPasswd');//我的团队



Route::post('apis/:version/invest','apis/:version.member/invest');//充值接口
Route::get('apis/:version/invest_view','apis/:version.member/investView');//充值页面接口
Route::get('apis/:version/extension','apis/:version.member/extension');//推广收益
Route::get('apis/:version/dog','apis/:version.dog/getDogList');//产品
Route::get('apis/:version/recently_itc','apis/:version.dog/recentlyItc');//最近租的矿机接口
Route::get('apis/:version/get_experience_machine','apis/:version.dog/getExperienceMachine');//体验机
Route::get('apis/:version/get_hire_itc','apis/:version.dog/getHireItc');//租矿机
Route::get('apis/:version/my_dog','apis/:version.member/myDog');//我的矿机


Route::get('apis/:version/project/rule','apis/:version.Home/projectRule');//首页项目介绍

Route::get('apis/:version/money/log','apis/:version.MyTeam/getUserInOutMoney');//我的收支明细

Route::get('apis/:version/recharge/log','apis/:version.MyTeam/rechargeUserMoney');//我的充值明细

Route::get('apis/:version/my/info','apis/:version.MyTeam/userInfoByToken');//我的页面信息

Route::get('apis/:version/my/cash','apis/:version.MyTeam/getCashByToken');//我的提现记录


Route::post('apis/:version/buy_ict','apis/:version.dog/buyIct');//购买矿机

Route::get('apis/:version/bank','apis/:version.member/bank');//银行卡列表
Route::get('apis/:version/support_type','apis/:version.member/supportType');//账户类型

Route::get('apis/:version/save_money','apis/:version.TimeEvent/saveUserMoney');//定时器用户每日发送
Route::get('apis/:version/save_itc_money','apis/:version.TimeEvent/itcIncome');//定时器矿机每分查询





//Route::get('apis/:version/apply','apis/:version.dog/apply');//开始预约
//Route::get('apis/:version/joinRob','apis/:version.dog/joinRob');//抢购
//Route::get('apis/:version/adopt_dog','apis/:version.dog/adopt_dog');//抢购结果





return [
    //别名配置,别名只能是映射到控制器且访问时必须加上请求的方法
    '__alias__'   => [
    ],
    //变量规则
    '__pattern__' => [
    ],
//        域名绑定到模块
//        '__domain__'  => [
//            'admin' => 'admin',
//            'api'   => 'api',
//        ],
];
