<?php

namespace app\admin\model\proclamation;

use think\Model;


class WorkOrder extends Model
{

    

    

    // 表名
    protected $name = 'work_order';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'status_text'
    ];


    public function memberName()
    {
        return $this->belongsTo('\app\admin\model\member\Member', 'uid')->alias("m")->field("m.mobile,m.id,m.user_name");
    }
    
    public function getStatusList()
    {
        return ['0' => __('Status 0'), '1' => __('Status 1')];
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
