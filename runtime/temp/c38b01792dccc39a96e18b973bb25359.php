<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:77:"G:\phpstudy\WWW\newInfo\public/../application/admin\view\order\match\add.html";i:1595826576;s:66:"G:\phpstudy\WWW\newInfo\application\admin\view\layout\default.html";i:1588765311;s:63:"G:\phpstudy\WWW\newInfo\application\admin\view\common\meta.html";i:1588765311;s:65:"G:\phpstudy\WWW\newInfo\application\admin\view\common\script.html";i:1588765311;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/newinfo/public/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/newinfo/public/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/newinfo/public/assets/js/html5shiv.js"></script>
  <script src="/newinfo/public/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-order_id" data-rule="required" data-source="order/index" class="form-control selectpage" name="row[order_id]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Uid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-uid" data-rule="required" class="form-control" name="row[uid]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Match_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-match_time" data-rule="required" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[match_time]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Money'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-money" data-rule="required" class="form-control" step="0.01" name="row[money]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Unmatched'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-unmatched" data-rule="required" class="form-control" step="0.01" name="row[unmatched]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
            <label for="row[status]-<?php echo $key; ?>"><input id="row[status]-<?php echo $key; ?>" name="row[status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Order_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-order_type" data-rule="required" class="form-control selectpicker" name="row[order_type]">
                <?php if(is_array($orderTypeList) || $orderTypeList instanceof \think\Collection || $orderTypeList instanceof \think\Paginator): if( count($orderTypeList)==0 ) : echo "" ;else: foreach($orderTypeList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Match_status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($matchStatusList) || $matchStatusList instanceof \think\Collection || $matchStatusList instanceof \think\Paginator): if( count($matchStatusList)==0 ) : echo "" ;else: foreach($matchStatusList as $key=>$vo): ?>
            <label for="row[match_status]-<?php echo $key; ?>"><input id="row[match_status]-<?php echo $key; ?>" name="row[match_status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Pay_status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-pay_status" data-rule="required" class="form-control" name="row[pay_status]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Is_lock'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-is_lock" data-rule="required" class="form-control selectpicker" name="row[is_lock]">
                <?php if(is_array($isLockList) || $isLockList instanceof \think\Collection || $isLockList instanceof \think\Paginator): if( count($isLockList)==0 ) : echo "" ;else: foreach($isLockList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Finish_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-finish_time" data-rule="required" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[finish_time]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Source'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-source" data-rule="required" class="form-control" name="row[source]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Plan_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-plan_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[plan_time]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Dog_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-dog_id" data-rule="required" data-source="dog/index" class="form-control selectpage" name="row[dog_id]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('First_sell'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-first_sell" class="form-control" name="row[first_sell]" type="number" value="0">
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/newinfo/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/newinfo/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>