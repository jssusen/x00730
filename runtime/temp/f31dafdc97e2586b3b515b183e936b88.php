<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"G:\phpstudy\WWW\newInfo\public/../application/admin\view\dog\dog\edit.html";i:1595389510;s:66:"G:\phpstudy\WWW\newInfo\application\admin\view\layout\default.html";i:1588765311;s:63:"G:\phpstudy\WWW\newInfo\application\admin\view\common\meta.html";i:1588765311;s:65:"G:\phpstudy\WWW\newInfo\application\admin\view\common\script.html";i:1588765311;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text" value="<?php echo htmlentities($row['title']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-price" data-rule="required" class="form-control" step="0.01" name="row[price]" type="number" value="<?php echo htmlentities($row['price']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Price2'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-price2" data-rule="required" class="form-control" step="0.01" name="row[price2]" type="number" value="<?php echo htmlentities($row['price2']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Level'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-level" data-rule="required" class="form-control" name="row[level]" type="number" value="<?php echo htmlentities($row['level']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Remark'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-remark" class="form-control" name="row[remark]" type="text" value="<?php echo htmlentities($row['remark']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Is_sell'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-is_sell" data-rule="required" class="form-control selectpicker" name="row[is_sell]">
                <?php if(is_array($isSellList) || $isSellList instanceof \think\Collection || $isSellList instanceof \think\Paginator): if( count($isSellList)==0 ) : echo "" ;else: foreach($isSellList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['is_sell'])?$row['is_sell']:explode(',',$row['is_sell']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Image'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-image" data-rule="required" class="form-control" size="50" name="row[image]" type="text" value="<?php echo htmlentities($row['image']); ?>">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-image" class="btn btn-danger plupload" data-input-id="c-image" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-image"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-image" class="btn btn-primary fachoose" data-input-id="c-image" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-image"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-image"></ul>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sell_s_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-sell_s_time" class="form-control datetimepicker" data-date-format="HH:mm" data-use-current="true" name="row[sell_s_time]" type="text" value="<?php echo $row['sell_s_time']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sell_e_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-sell_e_time" class="form-control datetimepicker" data-date-format=" HH:mm" data-use-current="true" name="row[sell_e_time]" type="text" value="<?php echo $row['sell_e_time']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Apply_fee'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-apply_fee" class="form-control" name="row[apply_fee]" type="number" value="<?php echo htmlentities($row['apply_fee']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Adopt_fee'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-adopt_fee" class="form-control" name="row[adopt_fee]" type="number" value="<?php echo htmlentities($row['adopt_fee']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Grow_day'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-grow_day" class="form-control" name="row[grow_day]" type="number" value="<?php echo htmlentities($row['grow_day']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Gains'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-gains" class="form-control" step="0.01" name="row[gains]" type="number" value="<?php echo htmlentities($row['gains']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Wia'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-wia" class="form-control" step="0.01" name="row[wia]" type="number" value="<?php echo htmlentities($row['wia']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Doge'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-doge" class="form-control" step="0.01" name="row[doge]" type="number" value="<?php echo htmlentities($row['doge']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Rob_status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($robStatusList) || $robStatusList instanceof \think\Collection || $robStatusList instanceof \think\Paginator): if( count($robStatusList)==0 ) : echo "" ;else: foreach($robStatusList as $key=>$vo): ?>
            <label for="row[rob_status]-<?php echo $key; ?>"><input id="row[rob_status]-<?php echo $key; ?>" name="row[rob_status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['rob_status'])?$row['rob_status']:explode(',',$row['rob_status']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Start_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-start_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[start_time]" type="text" value="<?php echo $row['start_time']?datetime($row['start_time']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('End_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-end_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[end_time]" type="text" value="<?php echo $row['end_time']?datetime($row['end_time']):''; ?>">
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