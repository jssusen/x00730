<?php

namespace app\admin\model\dog;

use think\Model;


class Apply extends Model
{

    

    

    // 表名
    protected $name = 'apply';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'status_text'
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


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
