<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Config;
use think\Db;

/**
 * 控制台
 *
 * @icon fa fa-dashboard
 * @remark 用于展示当前系统中的统计数据、统计报表及重要实时数据
 */
class Dashboard extends Backend
{

    /**
     * 查看
     */
    public function index()
    {
        $seventtime = \fast\Date::unixtime('day', -7);
        $paylist = $createlist = [];
        for ($i = 0; $i < 7; $i++)
        {
            $day = date("Y-m-d", $seventtime + ($i * 86400));
            $createlist[$day] = mt_rand(20, 200);
            $paylist[$day] = mt_rand(1, mt_rand(1, $createlist[$day]));
        }
        $hooks = config('addons.hooks');
        $uploadmode = isset($hooks['upload_config_init']) && $hooks['upload_config_init'] ? implode(',', $hooks['upload_config_init']) : 'local';
        $addonComposerCfg = ROOT_PATH . '/vendor/karsonzhang/fastadmin-addons/composer.json';
        Config::parse($addonComposerCfg, "json", "composer");
        $config = Config::get("composer");
        $addonVersion = isset($config['version']) ? $config['version'] : __('Unknown');

        $totaluser =Db::name("member")->count();
        $totalviews =Db::name("member")->where("is_valid",1)->count();
        $totalorder =Db::name("match")->count();
        $totalorderamount =Db::name("match")->sum("money");

        $todayusersignup =Db::name("member")->whereTime("createtime","today")->count();
        $todayuserlogin = Db::name("member")->whereTime("createtime","month")->count();

        $sevendnu =Db::name("member")->whereTime("createtime","week")->count();

        $sevendau =Db::name("match")->whereTime("createtime","month")->count();

        $todayorder =Db::name("match")->whereTime("createtime","today")->count();
        $unsettleorder =Db::name("match")->whereTime("createtime","week")->count();
        $this->view->assign([
            'totaluser'        => $totaluser,
            'totalviews'       => $totalviews,
            'totalorder'       => $totalorder,
            'totalorderamount' => $totalorderamount,
            'todayuserlogin'   => $todayuserlogin,
            'todayusersignup'  => $todayusersignup,
            'todayorder'       => $todayorder,
            'unsettleorder'    => $unsettleorder,
            'sevendnu'         => $sevendnu,
            'sevendau'         => $sevendau,
            'paylist'          => $paylist,
            'createlist'       => $createlist,
            'addonversion'       => $addonVersion,
            'uploadmode'       => $uploadmode
        ]);

        return $this->view->fetch();
    }

}
