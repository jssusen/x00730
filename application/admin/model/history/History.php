<?php

namespace app\admin\model\history;

use think\Model;


class History extends Model
{

    

    

    // 表名
    protected $name = 'history';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];

    public function member(){
        return $this->belongsTo('\app\admin\model\member\Member', 'uid')->alias("m")->field("m.id,m.user_name");
    }
    







}
