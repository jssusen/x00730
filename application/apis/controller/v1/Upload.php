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
                $imgUrl = $this->request->domain(). "/x00730"."/public"."/uploads/".$newUrl;
                return $this->success("上传成功",$imgUrl);
            }
        }
        return $this->error("上传失败");

    }



}