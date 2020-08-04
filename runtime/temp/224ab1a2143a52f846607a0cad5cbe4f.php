<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:79:"D:\phpstudy_pro\WWW\newInfo\public/../application/admin\view\business\edit.html";i:1594628045;s:70:"D:\phpstudy_pro\WWW\newInfo\application\admin\view\layout\default.html";i:1588765311;s:67:"D:\phpstudy_pro\WWW\newInfo\application\admin\view\common\meta.html";i:1588765311;s:69:"D:\phpstudy_pro\WWW\newInfo\application\admin\view\common\script.html";i:1588765311;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/newInfo/public/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/newInfo/public/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/newInfo/public/assets/js/html5shiv.js"></script>
  <script src="/newInfo/public/assets/js/respond.min.js"></script>
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-name" data-rule="required"  readonly  class="form-control" name="row[name]" type="text" value="<?php echo htmlentities($row['name']); ?>">
        </div>
    </div>
<!--    <div class="form-group">-->
<!--        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Headimage'); ?>:</label>-->
<!--        <div class="col-xs-12 col-sm-8">-->
<!--            <div class="input-group">-->
<!--                <input id="c-headimage" data-rule="required" class="form-control" size="50" name="row[headimage]" type="text" value="<?php echo htmlentities($row['headimage']); ?>">-->
<!--                <div class="input-group-addon no-border no-padding">-->
<!--                    <span><button type="button" id="plupload-headimage" class="btn btn-danger plupload" data-input-id="c-headimage" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-headimage"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>-->
<!--                    <span><button type="button" id="fachoose-headimage" class="btn btn-primary fachoose" data-input-id="c-headimage" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>-->
<!--                </div>-->
<!--                <span class="msg-box n-right" for="c-headimage"></span>-->
<!--            </div>-->
<!--            <ul class="row list-inline plupload-preview" id="p-headimage"></ul>-->
<!--        </div>-->
<!--    </div>-->

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Propagate'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea  id="c-propagate" name="row[propagate]" type="text"  class="form-control"   readonly value="<?php echo htmlentities($row['propagate']); ?>"><?php echo htmlentities($row['propagate']); ?></textarea>
        </div>
    </div>
    

<!--    <div class="form-group">-->
<!--        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Propagate'); ?>:</label>-->
<!--        <div class="col-xs-12 col-sm-8">-->
<!--            <input id="c-propagate" data-rule="required" class="form-control"  readonly name="row[propagate]" type="text" value="<?php echo htmlentities($row['propagate']); ?>">-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Licenseimage'); ?>:</label>-->
<!--        <div class="col-xs-12 col-sm-8">-->
<!--            <div class="input-group">-->
<!--                <input id="c-licenseimage" data-rule="required" class="form-control" size="50" name="row[licenseimage]" type="text" value="<?php echo htmlentities($row['licenseimage']); ?>">-->
<!--                <div class="input-group-addon no-border no-padding">-->
<!--                    <span><button type="button" id="plupload-licenseimage" class="btn btn-danger plupload" data-input-id="c-licenseimage" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-licenseimage"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>-->
<!--                    <span><button type="button" id="fachoose-licenseimage" class="btn btn-primary fachoose" data-input-id="c-licenseimage" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>-->
<!--                </div>-->
<!--                <span class="msg-box n-right" for="c-licenseimage"></span>-->
<!--            </div>-->
<!--            <ul class="row list-inline plupload-preview" id="p-licenseimage"></ul>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Identity_type'); ?>:</label>-->
<!--        <div class="col-xs-12 col-sm-8">-->
<!--                        -->
<!--            <select  id="c-identity_type" data-rule="required" class="form-control selectpicker" name="row[identity_type]">-->
<!--                <?php if(is_array($identityTypeList) || $identityTypeList instanceof \think\Collection || $identityTypeList instanceof \think\Paginator): if( count($identityTypeList)==0 ) : echo "" ;else: foreach($identityTypeList as $key=>$vo): ?>-->
<!--                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['identity_type'])?$row['identity_type']:explode(',',$row['identity_type']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>-->
<!--                <?php endforeach; endif; else: echo "" ;endif; ?>-->
<!--            </select>-->

<!--        </div>-->
<!--    </div>-->
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Business_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-business_name" data-rule="required" class="form-control"  readonly name="row[business_name]" type="text" value="<?php echo htmlentities($row['business_name']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Code'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-code" data-rule="required" class="form-control"  readonly   name="row[code]" type="text" value="<?php echo htmlentities($row['code']); ?>">
        </div>
    </div>

<!--    <div class="form-group">-->
<!--        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Identityimages'); ?>:</label>-->
<!--        <div class="col-xs-12 col-sm-8">-->
<!--            <div class="input-group">-->
<!--                <input id="c-identityimages" data-rule="required" class="form-control" size="50" name="row[identityimages]" type="text" value="<?php echo htmlentities($row['identityimages']); ?>">-->
<!--                <div class="input-group-addon no-border no-padding">-->
<!--                    <span><button type="button" id="plupload-identityimages" class="btn btn-danger plupload" data-input-id="c-identityimages" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-identityimages"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>-->
<!--                    <span><button type="button" id="fachoose-identityimages" class="btn btn-primary fachoose" data-input-id="c-identityimages" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>-->
<!--                </div>-->
<!--                <span class="msg-box n-right" for="c-identityimages"></span>-->
<!--            </div>-->
<!--            <ul class="row list-inline plupload-preview" id="p-identityimages"></ul>-->
<!--        </div>-->
<!--    </div>-->
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Phone'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-phone" data-rule="required" class="form-control"  readonly    name="row[phone]" type="number" value="<?php echo htmlentities($row['phone']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-type" data-rule="required" class="form-control"   readonly name="row[type]"  readonly type="text" value="<?php echo htmlentities($row['type']); ?>">
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>





    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <div class="radio">
                <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
                <label for="row[status]-<?php echo $key; ?>"><input id="row[status]-<?php echo $key; ?>"  readonly    name="row[status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['status'])?$row['status']:explode(',',$row['status']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>

</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/newInfo/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/newInfo/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>