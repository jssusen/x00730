<?php


namespace app\apis\controller\v1;


use think\Controller;
use think\Request;

class BaseController extends Controller
{
    protected $request;

    public function _initialize(){
        $this->request      = Request::instance();
    }

    protected function success($msg = '', $data = null, $code = 1, $type = null, array $header = [])
    {
        $result = [
            'code' => $code,
            'msg'  => $msg,
            'time' => Request::instance()->server('REQUEST_TIME'),
            'data' => $data,
        ];
        return json($result);
    }

    protected function error($msg = '', $data = null, $code = 0, $type = null, array $header = [])
    {
        $result = [
            'code' => $code,
            'msg'  => $msg,
            'time' => Request::instance()->server('REQUEST_TIME'),
            'data' => $data,
        ];
        return json($result);
    }
}