<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:77:"G:\phpstudy\WWW\kj\public/../application/admin\view\general\config\index.html";i:1595413830;s:61:"G:\phpstudy\WWW\kj\application\admin\view\layout\default.html";i:1588765311;s:58:"G:\phpstudy\WWW\kj\application\admin\view\common\meta.html";i:1588765311;s:67:"G:\phpstudy\WWW\kj\application\admin\view\general\config\other.html";i:1596436920;s:60:"G:\phpstudy\WWW\kj\application\admin\view\common\script.html";i:1588765311;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/kj/public/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/kj/public/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/kj/public/assets/js/html5shiv.js"></script>
  <script src="/kj/public/assets/js/respond.min.js"></script>
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
                                <link href="/kj/public//assets/plugins/color-picker/bootstrap-colorpicker.min.css" rel="stylesheet">


<div class="panel panel-default panel-intro">
    <div class="panel-heading">
        <?php echo build_heading(null, false); ?>
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#program" data-toggle="tab">基础配置</a></li>
            <li><a href="#other" data-toggle="tab">其它配置</a></li>


        </ul>
    </div>

    <div class="panel-body">
        <div id="myTabContent" class="tab-content">

            <div class="tab-pane fade in active " id="program">
                 <form id="other-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="../general/config/other">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">客服微信</label>
        <div class="col-xs-12 col-sm-2">
            <?php echo Form::text('row[wx_number]', $result['wx_number'], ['data-rule'=>'required']); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">开放注册:</label>
        <div class="col-xs-12 col-sm-2">
            <?php echo build_radios('row[website_open]', ['0'=>'不开放', '1'=>'开放'], !empty($result['website_open']) ? $result['website_open'] : 0); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">新用户注册送</label>
        <div class="col-xs-12 col-sm-2">
            <?php echo Form::text('row[money_save]', $result['money_save'], ['data-rule'=>'required']); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">充值范围</label>
        <div class="col-xs-12 col-sm-2">
            <?php echo Form::text('row[invest_scope]', $result['invest_scope'], ['data-rule'=>'required']); ?>
            <span>最低充值|最高充值</span>
        </div>
    </div>



    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed "><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>


</form>
            </div>

            <div class="tab-pane fade in  " id="other">
               125125
            </div>







        </div>
    </div>
</div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/kj/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/kj/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>