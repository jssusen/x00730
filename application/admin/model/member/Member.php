<?php

namespace app\admin\model\member;

use think\Model;


class Member extends Model
{

    

    

    // 表名
    protected $name = 'member';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'sex_text',
        'login_time_text',
        'status_text',
        'error_login_time_text',
        'online_time_text',
        'robber_text'
    ];

    public function memberGroup()
    {
        return $this->belongsTo('\app\admin\model\member\MemberGroup', 'member_group_id')->alias("g")->field("g.id,g.title");
    }

    public function User()
    {
        return $this->belongsTo('\app\admin\model\member\Member', 're_id')->alias("m")->field("m.id,m.mobile,user_name");
    }




    public function getSexList()
    {
        return ['0' => __('Sex 0'), '1' => __('Sex 1'), '2' => __('Sex 2')];
    }

    public function getStatusList()
    {
        return ['0' => __('Status 0'), '1' => __('Status 1')];
    }

    public function getRobberList()
    {
        return ['0' => __('Robber 0'), '1' => __('Robber 1')];
    }
    public function getTypeList()
    {
        return ['integrals' => "羽化币", 'share_income' =>"推广收益" ];
    }


    public function getSexTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['sex']) ? $data['sex'] : '');
        $list = $this->getSexList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getLoginTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['login_time']) ? $data['login_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getErrorLoginTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['error_login_time']) ? $data['error_login_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getOnlineTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['online_time']) ? $data['online_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getRobberTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['robber']) ? $data['robber'] : '');
        $list = $this->getRobberList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setLoginTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setErrorLoginTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setOnlineTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
