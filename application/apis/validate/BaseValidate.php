<?php
namespace app\apis\validate;

use think\Validate;
use think\Request;
use app\apis\exception\ParamsException;
class BaseValidate extends  Validate
{
    public function goCheck()
    {
        $request = Request::instance();
        $params  = $request->param();
        if (!$this->check($params)){
            $e =  new ParamsException(["msg"=>$this->error]);
            throw $e;
        }
        return true;
    }

    protected function isLevel($value)
    {
        if (in_array($value,[1,2]) || $value == (int)37 || $value == (int)815)
        {
            return true;
        }else{
            return false;
        }
    }

    protected function isType($value)
    {
        if (in_array($value,[1,2]))
        {
            return true;
        }else{
            return false;
        }
    }

    protected function isInt($value)
    {
        if(is_numeric($value) && is_int($value+0) && ($value+0) > 0){
            return true;
        }else{
            //如果不符合我们的条件，返回错误信息，在控制器中可以用getError()方法输出
            return false;
        }
    }


    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    protected function is_idcard($id)
    {
        $id = strtoupper($id);
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
        $arr_split = array();
        if(!preg_match($regx, $id))
        {
            return FALSE;
        }
        if(15==strlen($id)) //检查15位
        {
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";

            @preg_match($regx, $id, $arr_split);
            //检查生日日期是否正确
            $dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
            if(!strtotime($dtm_birth))
            {
                return FALSE;
            } else {
                return TRUE;
            }
        }
        else      //检查18位
        {
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
            @preg_match($regx, $id, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
            if(!strtotime($dtm_birth)) //检查生日日期是否正确
            {
                return FALSE;
            }
            else
            {
                //检验18位身份证的校验码是否正确。
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign = 0;
                for ( $i = 0; $i < 17; $i++ )
                {
                    $b = (int) $id{$i};
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($id,17, 1))
                {
                    return FALSE;
                } //phpfensi.com
                else
                {
                    return TRUE;
                }
            }
        }

    }


    protected function check_url($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        $result = curl_exec($curl);
        $found = false;
        // 如果请求没有发送失败
        if ($result !== false) {
            // 再检查http响应码是否为200
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($statusCode == 200) {
                $found = true;
            }
        }
        curl_close($curl);
        return $found;
    }
}