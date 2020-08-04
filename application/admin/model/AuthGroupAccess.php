<?php

namespace app\admin\model;

use think\Model;

class AuthGroupAccess extends Model
{
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
}
