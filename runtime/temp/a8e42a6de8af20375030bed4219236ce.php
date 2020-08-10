<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:84:"G:\phpstudy\WWW\x00730\public/../application/admin\view\history\withdrawal\edit.html";i:1596526264;s:65:"G:\phpstudy\WWW\x00730\application\admin\view\layout\default.html";i:1588765312;s:62:"G:\phpstudy\WWW\x00730\application\admin\view\common\meta.html";i:1588765312;s:64:"G:\phpstudy\WWW\x00730\application\admin\view\common\script.html";i:1588765312;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/x00730/public/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/x00730/public/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/x00730/public/assets/js/html5shiv.js"></script>
  <script src="/x00730/public/assets/js/respond.min.js"></script>
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Money'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-money" data-rule="required"  readonly class="form-control" step="0.01" name="row[money]" type="number" value="<?php echo htmlentities($row['money']); ?>">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Procedures_money'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-procedures_money" data-rule="required"  readonly class="form-control" step="0.01" name="row[procedures_money]" type="number" value="<?php echo htmlentities($row['procedures_money']); ?>">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Really_money'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-really_money" data-rule="required"  readonly class="form-control" step="0.01" name="row[really_money]" type="number" value="<?php echo htmlentities($row['really_money']); ?>">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Remark'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-remark" class="form-control"  readonly  name="row[remark]" type="text" value="<?php echo htmlentities($row['remark']); ?>">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Money_position'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-money_position"  readonly data-rule="required" class="form-control" name="row[money_position]" type="text" value="<?php echo htmlentities($row['money_position']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Is_pay'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <select  id="c-is_pay" data-rule="required" class="form-control selectpicker" name="row[is_pay]">
                <?php if(is_array($isPayList) || $isPayList instanceof \think\Collection || $isPayList instanceof \think\Paginator): if( count($isPayList)==0 ) : echo "" ;else: foreach($isPayList as $key=>$vo): ?>
                <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['is_pay'])?$row['is_pay']:explode(',',$row['is_pay']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

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
        <script src="/x00730/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/x00730/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>