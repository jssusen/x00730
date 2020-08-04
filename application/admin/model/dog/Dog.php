<?php

namespace app\admin\model\dog;

use think\Model;


class Dog extends Model
{

    

    

    // 表名
    protected $name = 'dog';
    
    // 自动写入时间戳字段
//    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'is_sell_text',
        'sell_s_time_text',
        'sell_e_time_text',
        'rob_status_text',
        'start_time_text',
        'end_time_text'
    ];



    
    public function getIsSellList()
    {
        return ['0' => __('Is_sell 0'), '1' => __('Is_sell 1')];
    }

    public function getRobStatusList()
    {
        return ['0' => __('Rob_status 0'), '1' => __('Rob_status 1')];
    }

    public function getTypeList()
    {
        return ['0' => "体验机", '1' =>"每日收益","2"=>"到期收益" ];
    }


    public function getIsSellTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['is_sell']) ? $data['is_sell'] : '');
        $list = $this->getIsSellList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getSellSTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['sell_s_time']) ? $data['sell_s_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getSellETimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['sell_e_time']) ? $data['sell_e_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getRobStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['rob_status']) ? $data['rob_status'] : '');
        $list = $this->getRobStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStartTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['start_time']) ? $data['start_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getEndTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['end_time']) ? $data['end_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setSellSTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setSellETimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setStartTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setEndTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
