<?php

namespace app\admin\controller\general;

use app\common\controller\Backend;
use app\common\library\Email;
use app\common\model\Config as ConfigModel;
use think\Db;
use think\Exception;
use think\Validate;

/**
 * 系统配置
 *
 * @icon   fa fa-cogs
 * @remark 可以在此增改系统的变量和分组,也可以自定义分组和变量,如果需要删除请从数据库中删除
 */
class Config extends Backend
{

    /**
     * @var \app\common\model\Config
     */
    protected $model = null;
    protected $noNeedRight = ['check', 'rulelist'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Config');
        ConfigModel::event('before_write', function ($row) {
            if (isset($row['name']) && $row['name'] == 'name' && preg_match("/fast" . "admin/i", $row['value'])) {
                throw new Exception(__("Site name incorrect"));
            }
        });
    }

    /**
     * 查看
     */
    public function index()
    {
        $results = Db::name("setting")->column("key,value");
        $this->view->assign('result', $results);
        return $this->view->fetch("index");
    }

    public function other(){
        if ($this->request->isPost()){
           $params = $this->request->post("row/a");
//            if (array_key_exists("dog_rob_model",$params))
//            {
//               $isTrue=  Db::name("setting")
//                    ->where("key","dog_rob_model")
//                    ->update(["value"=>$params["dog_rob_model"]]);
//               if ($isTrue){
//                   $this->success("设置成功");
//               }
//                $this->error("未设置");
//             }
            $set = $this->saveValue($params);
            if(!empty($set)) {
                $this->success('保存成功');
            }

            $this->error('更新修改失败！请稍后重试');



       }
    }

    public function saveValue($params){

        is_array($params) || $params = explode(',',$params);

        $exits = $this->getExitsKey();

        $status = 0;
        foreach ($params as $k => $v){
            if(empty($k))
                continue;
            if(!in_array($k, $exits)){

                if(empty($v) && $v!==0){
                    continue;
                }
//                $result = $this->insert(['key'=>$k, 'value'=>$v,'city_id'=>$GLOBALS['city_id'], 'uniacid'=>$GLOBALS['uniacid']]);
                Db::name("setting")->insert(["key"=>$k,"value",$v]);
                !empty($result) && $status += 1;
            }else{
                $result =Db::name("setting")->where(['key'=>$k])->update(['value'=>$v]);
                !empty($result) && $status += 1;
            }
        }

        return $status;
    }


    public function getExitsKey(){
       return  Db::name("setting")->column("key");
    }
    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $this->token();
            $params = $this->request->post("row/a", [], 'trim');
            if ($params) {
                foreach ($params as $k => &$v) {
                    $v = is_array($v) ? implode(',', $v) : $v;
                }
                if (in_array($params['type'], ['select', 'selects', 'checkbox', 'radio', 'array'])) {
                    $params['content'] = json_encode(ConfigModel::decode($params['content']), JSON_UNESCAPED_UNICODE);
                } else {
                    $params['content'] = '';
                }
                try {
                    $result = $this->model->create($params);
                } catch (Exception $e) {
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    try {
                        $this->refreshFile();
                    } catch (Exception $e) {
                        $this->error($e->getMessage());
                    }
                    $this->success();
                } else {
                    $this->error($this->model->getError());
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }

    /**
     * 编辑
     * @param null $ids
     */
    public function edit($ids = null)
    {
        if ($this->request->isPost()) {
            $this->token();
            $row = $this->request->post("row/a", [], 'trim');
            if ($row) {
                $configList = [];
                foreach ($this->model->all() as $v) {
                    if (isset($row[$v['name']])) {
                        $value = $row[$v['name']];
                        if (is_array($value) && isset($value['field'])) {
                            $value = json_encode(ConfigModel::getArrayData($value), JSON_UNESCAPED_UNICODE);
                        } else {
                            $value = is_array($value) ? implode(',', $value) : $value;
                        }
                        $v['value'] = $value;
                        $configList[] = $v->toArray();
                    }
                }
                try {
                    $this->model->allowField(true)->saveAll($configList);
                } catch (Exception $e) {
                    $this->error($e->getMessage());
                }
                try {
                    $this->refreshFile();
                } catch (Exception $e) {
                    $this->error($e->getMessage());
                }
                $this->success();
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
    }

    /**
     * 删除
     * @param string $ids
     */
    public function del($ids = "")
    {
        $name = $this->request->post('name');
        $config = ConfigModel::getByName($name);
        if ($name && $config) {
            try {
                $config->delete();
                $this->refreshFile();
            } catch (Exception $e) {
                $this->error($e->getMessage());
            }
            $this->success();
        } else {
            $this->error(__('Invalid parameters'));
        }
    }

    /**
     * 刷新配置文件
     */
    protected function refreshFile()
    {
        $config = [];
        foreach ($this->model->all() as $k => $v) {
            $value = $v->toArray();
            if (in_array($value['type'], ['selects', 'checkbox', 'images', 'files'])) {
                $value['value'] = explode(',', $value['value']);
            }
            if ($value['type'] == 'array') {
                $value['value'] = (array)json_decode($value['value'], true);
            }
            $config[$value['name']] = $value['value'];
        }
        file_put_contents(
            APP_PATH . 'extra' . DS . 'site.php',
            '<?php' . "\n\nreturn " . var_export($config, true) . ";"
        );
    }

    /**
     * 检测配置项是否存在
     * @internal
     */
    public function check()
    {
        $params = $this->request->post("row/a");
        if ($params) {
            $config = $this->model->get($params);
            if (!$config) {
                return $this->success();
            } else {
                return $this->error(__('Name already exist'));
            }
        } else {
            return $this->error(__('Invalid parameters'));
        }
    }

    /**
     * 规则列表
     * @internal
     */
    public function rulelist()
    {
        //主键
        $primarykey = $this->request->request("keyField");
        //主键值
        $keyValue = $this->request->request("keyValue", "");

        $keyValueArr = array_filter(explode(',', $keyValue));
        $regexList = \app\common\model\Config::getRegexList();
        $list = [];
        foreach ($regexList as $k => $v) {
            if ($keyValueArr) {
                if (in_array($k, $keyValueArr)) {
                    $list[] = ['id' => $k, 'name' => $v];
                }
            } else {
                $list[] = ['id' => $k, 'name' => $v];
            }
        }
        return json(['list' => $list]);
    }

    /**
     * 发送测试邮件
     * @internal
     */
    public function emailtest()
    {
        $row = $this->request->post('row/a');
        $receiver = $this->request->post("receiver");
        if ($receiver) {
            if (!Validate::is($receiver, "email")) {
                $this->error(__('Please input correct email'));
            }
            \think\Config::set('site', array_merge(\think\Config::get('site'), $row));
            $email = new Email;
            $result = $email
                ->to($receiver)
                ->subject(__("This is a test mail"))
                ->message('<div style="min-height:550px; padding: 100px 55px 200px;">' . __('This is a test mail content') . '</div>')
                ->send();
            if ($result) {
                $this->success();
            } else {
                $this->error($email->getError());
            }
        } else {
            return $this->error(__('Invalid parameters'));
        }
    }
}
