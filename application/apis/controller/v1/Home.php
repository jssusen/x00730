<?php


namespace app\apis\controller\v1;


use app\apis\model\Member as MemberModel;
use app\apis\model\Setting;
use app\apis\validate\Token;
use think\Request;

class Home extends BaseController
{
    protected $setting;
    public function __construct()
    {
        parent::_initialize();
        $this->setting =new Setting();
    }

    public function projectRule(Request $request){
        (new Token())->goCheck();
        $rule = $this->setting->getProjectRule();
        if(!$rule) return $this->error('获取失败');
        return $this->success('获取成功',$rule['value']);
    }

}