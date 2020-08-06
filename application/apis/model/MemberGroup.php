<?php


namespace app\apis\model;
use think\Request;


class MemberGroup extends  BaseModel
{
    private   $request;
    protected $name ="member_group";
    public function __construct(){
//        $this->request=Request::instance();
    }


    public static function getTitle($id){
       return  self::where("id",$id)->value("title");
    }

}