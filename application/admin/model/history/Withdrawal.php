<?php

namespace app\admin\model\history;

use think\Model;


class Withdrawal extends Model
{

    

    

    // 表名
    protected $name = 'withdrawal';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = true;

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'type_text'
    ];

    public function member()
    {
        return $this->belongsTo('\app\admin\model\member\Member', 'uid',"id")->alias("m")->field("m.id,m.user_name");
    }


    public function getTypeList()
    {
        return ['0' => __('Type 0'), '1' => __('Type 1')];
    }

    public function getIsPayList()
    {
        return ['0' => __('Is_pay 0'), '1' => __('Is_pay 1'),'2' => __('Is_pay 2')];
    }

    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
