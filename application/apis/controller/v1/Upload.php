<?php


namespace app\apis\controller\v1;


class Upload extends BaseController
{

    public function __construct()
    {
        parent::_initialize();
    }

    public function uploadImg()
    {

        $info = $this -> request->file("file");
        if($info){
            $res =$info->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($res)
            {
                $url = $res->getSaveName();
                $newUrl = str_replace("\\","/",$url);
                $imgUrl = $this->request->domain(). "/public"."/uploads/".$newUrl;
                return $imgUrl;
            }
        }
        return $this->error("上传失败");

    }

}