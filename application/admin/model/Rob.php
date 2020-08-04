<?php

namespace app\admin\model;

use think\Model;


class Rob extends Model
{

    

    

    // 表名
    protected $name = 'match';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'match_time_text',
        'status_text',
        'order_type_text',
        'match_status_text',
        'is_lock_text',
        'finish_time_text',
        'plan_time_text'
    ];

    public function member()
    {
        return $this->belongsTo('\app\admin\model\member\Member', 'uid',"id")->alias("m")->field("m.id,m.user_name");
    }


    public function dog()
    {
        return $this->belongsTo('\app\admin\model\dog\Dog', 'dog_id',"id")->alias("d")->field("d.id,d.title");
    }





    public function getStatusList()
    {
        return ['0' => __('Status 0'), '1' => __('Status 1')];
    }

    public function getOrderTypeList()
    {
        return ['0' => __('Order_type 0'), '1' => __('Order_type 1')];
    }

    public function getMatchStatusList()
    {
        return ['0' => __('Match_status 0'), '1' => __('Match_status 1'), '2' => __('Match_status 2')];
    }

    public function getIsLockList()
    {
        return ['0' => __('Is_lock 0'), '1' => __('Is_lock 1')];
    }


    public function getMatchTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['match_time']) ? $data['match_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getOrderTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['order_type']) ? $data['order_type'] : '');
        $list = $this->getOrderTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getMatchStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['match_status']) ? $data['match_status'] : '');
        $list = $this->getMatchStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getIsLockTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['is_lock']) ? $data['is_lock'] : '');
        $list = $this->getIsLockList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getFinishTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['finish_time']) ? $data['finish_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getPlanTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['plan_time']) ? $data['plan_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setMatchTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setFinishTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setPlanTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
