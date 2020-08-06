<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"G:\phpstudy\WWW\kj\public/../application/admin\view\member\member\edit.html";i:1596620453;s:61:"G:\phpstudy\WWW\kj\application\admin\view\layout\default.html";i:1588765311;s:58:"G:\phpstudy\WWW\kj\application\admin\view\common\meta.html";i:1588765311;s:60:"G:\phpstudy\WWW\kj\application\admin\view\common\script.html";i:1588765311;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Password'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-password" data-rule="required" class="form-control" name="row[password]" type="text" value="<?php echo htmlentities($row['password']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Paypwd'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-paypwd" class="form-control" name="row[paypwd]" type="text" value="<?php echo htmlentities($row['paypwd']); ?>">
        </div>
    </div>




    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Realname'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-realname" class="form-control" name="row[realname]" type="text" value="<?php echo htmlentities($row['realname']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Idcard'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-idcard" class="form-control" name="row[idcard]" type="text" value="<?php echo htmlentities($row['idcard']); ?>">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sex'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-sex" class="form-control selectpicker" name="row[sex]">
                <?php if(is_array($sexList) || $sexList instanceof \think\Collection || $sexList instanceof \think\Paginator): if( count($sexList)==0 ) : echo "" ;else: foreach($sexList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['sex'])?$row['sex']:explode(',',$row['sex']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Mobile'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-mobile" class="form-control" name="row[mobile]" type="text" value="<?php echo htmlentities($row['mobile']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Email'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-email" class="form-control" name="row[email]" type="text" value="<?php echo htmlentities($row['email']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Token'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-token" class="form-control" name="row[token]" type="text" value="<?php echo htmlentities($row['token']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Avatarimage'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-avatarimage" class="form-control" size="50" name="row[avatarimage]" type="text" value="<?php echo htmlentities($row['avatarimage']); ?>">
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
            <input id="c-member_group_id"
                   data-rule="required"
                   data-source="member/Member_Group/index"
                   class="form-control selectpage"
                   name="row[member_group_id]"
                   type="text"
                   data-field="title"
                   value="<?php echo htmlentities($row['member_group_id']); ?>">

        </div>
    </div>



    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Login_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-login_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[login_time]" type="text" value="<?php echo $row['login_time']?datetime($row['login_time']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Login_ip'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-login_ip" class="form-control" name="row[login_ip]" type="text" value="<?php echo htmlentities($row['login_ip']); ?>">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
            <label for="row[status]-<?php echo $key; ?>"><input id="row[status]-<?php echo $key; ?>" name="row[status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['status'])?$row['status']:explode(',',$row['status']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>







    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Integrals'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-integrals" class="form-control" step="0.01" name="row[integrals]" type="number" value="<?php echo htmlentities($row['integrals']); ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Re_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-re_id" data-rule="required" data-source="re/index" class="form-control selectpage" name="row[re_id]" type="text" value="<?php echo htmlentities($row['re_id']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Re_level'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-re_level" class="form-control" name="row[re_level]" type="number" value="<?php echo htmlentities($row['re_level']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Re_path'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-re_path" class="form-control " rows="5" name="row[re_path]" cols="50"><?php echo htmlentities($row['re_path']); ?></textarea>
        </div>
    </div>





    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Share_code'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-share_code" class="form-control" name="row[share_code]" type="text" value="<?php echo htmlentities($row['share_code']); ?>">
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
        <script src="/kj/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/kj/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>