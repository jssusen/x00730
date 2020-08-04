<?php


namespace app\apis\model;


class Apply extends BaseModel
{
    protected $name ="apply";
    public function initialize(){
        parent::initialize();
    }

    protected $append = [
        'status_text',
    ];

    public static function finApply ($uid)
    {
       return  self::with("dog")->where("uid",$uid)->select();
    }

    public static function  isApply($uid=0,$dog_id=0)
    {
        return self::where("uid",$uid)
            ->where("dog_id",$dog_id)
            ->whereTime("createtime","today")
            ->count();
    }

    public static function findApply($uid=0,$dog_id=0){
        return self::where("uid",$uid)
            ->where("dog_id",$dog_id)
            ->whereTime("createtime","today")
            ->find();
    }




    public function getStatusList()
    {
        return ['0' => '已预约', '1' => '预约成功'];
    }

    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function user()
    {
        return $this->belongsTo('\app\apis\model\Member', 'uid')->bind(["userName"=>"user_name"]);
    }

    public function dog()
    {
        return $this->belongsTo('\app\apis\model\Dog', 'dog_id')->bind(["dog_name"=>"title"]);
    }

}