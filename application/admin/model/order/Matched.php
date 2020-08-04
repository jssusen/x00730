<?php

namespace app\admin\model\order;

use think\Model;


class Matched extends Model
{

    

    

    // 表名
    protected $name = 'matched';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'pay_time_text',
        'receipt_time_text',
        'status_text',
        'complaint_time_text',
        'end_grow_time_text',
        'bonus_time_text'
    ];


    public function user(){
        return $this->belongsTo('\app\admin\model\member\Member', 'uid')->alias("m")->field("m.id,m.user_name");
    }

    public function users(){
        return $this->belongsTo('\app\admin\model\member\Member', 'bid')->alias("m")->field("m.id,m.user_name");
    }

    public function dog(){
        return $this->belongsTo('\app\admin\model\dog\Dog', 'dog_id')->alias("d")->field("d.id,d.title");
    }



    
    public function getStatusList()
    {
        return ['0' => __('Status 0'), '1' => __('Status 1')];
    }


    public function getPayTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['pay_time']) ? $data['pay_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getReceiptTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['receipt_time']) ? $data['receipt_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getComplaintTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['complaint_time']) ? $data['complaint_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getEndGrowTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['end_grow_time']) ? $data['end_grow_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getBonusTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['bonus_time']) ? $data['bonus_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setPayTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setReceiptTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setComplaintTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setEndGrowTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setBonusTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
