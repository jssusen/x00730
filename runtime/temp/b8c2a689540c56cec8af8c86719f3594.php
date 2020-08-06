<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:70:"E:\work\x00730\public/../application/admin\view\member\member\add.html";i:1596425188;s:57:"E:\work\x00730\application\admin\view\layout\default.html";i:1588765312;s:54:"E:\work\x00730\application\admin\view\common\meta.html";i:1588765312;s:56:"E:\work\x00730\application\admin\view\common\script.html";i:1588765312;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
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
        <label class="control-label col-xs-12 col-sm-2">用户名</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-user_name" class="form-control" name="row[user_name]" type="text" value="">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Realname'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-realname" class="form-control" name="row[realname]" type="text" value="">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">开户银行类型</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-bank" class="form-control" name="row[bank]" type="text" value="">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">开户银行号</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-bank_info" class="form-control" name="row[bank_info]" type="text" value="">
        </div>
    </div>




    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Password'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-password" data-rule="required" class="form-control" name="row[password]" type="text" value="">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Paypwd'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-paypwd" class="form-control" name="row[paypwd]" type="text" value="">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Collectionimage'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-collectionimage" class="form-control" size="50" name="row[collectionimage]" type="text">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-collectionimage" class="btn btn-danger plupload" data-input-id="c-collectionimage" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-collectionimage"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-collectionimage" class="btn btn-primary fachoose" data-input-id="c-collectionimage" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-collectionimage"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-collectionimage"></ul>
        </div>
    </div>



    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Idcard'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-idcard" class="form-control" name="row[idcard]" type="text" value="">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sex'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-sex" class="form-control selectpicker" name="row[sex]">
                <?php if(is_array($sexList) || $sexList instanceof \think\Collection || $sexList instanceof \think\Paginator): if( count($sexList)==0 ) : echo "" ;else: foreach($sexList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Mobile'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-mobile" class="form-control" name="row[mobile]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Email'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-email" class="form-control" name="row[email]" type="text" value="">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Avatarimage'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-avatarimage" class="form-control" size="50" name="row[avatarimage]" type="text" value="">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-avatarimage" class="btn btn-danger plupload" data-input-id="c-avatarimage" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-avatarimage"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-avatarimage" class="btn btn-primary fachoose" data-input-id="c-avatarimage" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-avatarimage"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-avatarimage"></ul>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Member_group_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-member_group_id" data-rule="required"   data-field="title" data-source="member/Member_Group/index" class="form-control selectpage" name="row[member_group_id]" type="text" value="">
        </div>
    </div>




    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
            <label for="row[status]-<?php echo $key; ?>"><input id="row[status]-<?php echo $key; ?>" name="row[status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"1"))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>






    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">余额</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-integrals" class="form-control" step="0.01" name="row[integrals]" type="number" value="0.00">
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
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>