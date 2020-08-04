<?php


namespace app\apis\controller\v1;


use app\apis\model\Notice as NoticeModel;

class Notice extends BaseController
{
    protected  $notice;
    public function __construct()
    {
        parent::_initialize();
        $this->notice =new NoticeModel();
    }



}