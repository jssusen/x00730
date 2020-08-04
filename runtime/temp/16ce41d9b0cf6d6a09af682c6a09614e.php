<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:79:"G:\phpstudy\WWW\newInfo\public/../application/admin\view\member\member\add.html";i:1595405149;s:66:"G:\phpstudy\WWW\newInfo\application\admin\view\layout\default.html";i:1588765311;s:63:"G:\phpstudy\WWW\newInfo\application\admin\view\common\meta.html";i:1588765311;s:65:"G:\phpstudy\WWW\newInfo\application\admin\view\common\script.html";i:1588765311;}*/ ?>
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Realname'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-realname" class="form-control" name="row[realname]" type="text" value="">
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Token'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-token" class="form-control" name="row[token]" type="text" value="">
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
            <input id="c-member_group_id" data-rule="required" data-source="member/group/index" class="form-control selectpage" name="row[member_group_id]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Login_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-login_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[login_time]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Login_ip'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-login_ip" class="form-control" name="row[login_ip]" type="text">
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Error_login_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-error_login_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[error_login_time]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Error_count'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-error_count" class="form-control" name="row[error_count]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Alipay'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-alipay" class="form-control" name="row[alipay]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Wia'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-wia" class="form-control" step="0.01" name="row[wia]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Doge'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-doge" class="form-control" step="0.01" name="row[doge]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Balance'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-balance" class="form-control" step="0.01" name="row[balance]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Integrals'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-integrals" class="form-control" step="0.01" name="row[integrals]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Service_integrals'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-service_integrals" class="form-control" step="0.01" name="row[service_integrals]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Invest_integrals'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-invest_integrals" class="form-control" step="0.01" name="row[invest_integrals]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Re_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-re_id" data-rule="required" data-source="re/index" class="form-control selectpage" name="row[re_id]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Re_level'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-re_level" class="form-control" name="row[re_level]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Re_path'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-re_path" class="form-control " rows="5" name="row[re_path]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Super_power'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-super_power" class="form-control" name="row[super_power]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Self_achievement'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-self_achievement" class="form-control" step="0.01" name="row[self_achievement]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Team_achievement'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-team_achievement" class="form-control" step="0.01" name="row[team_achievement]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Share_achievement'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-share_achievement" class="form-control" step="0.01" name="row[share_achievement]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Share_code'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-share_code" class="form-control" name="row[share_code]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Flow'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-flow" class="form-control" step="0.01" name="row[flow]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Total_income'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-total_income" class="form-control" step="0.01" name="row[total_income]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Online_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-online_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[online_time]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('First_sell'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-first_sell" class="form-control" name="row[first_sell]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Effective'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-effective" class="form-control" name="row[effective]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Share_income'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-share_income" class="form-control" step="0.01" name="row[share_income]" type="number" value="0.00">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Robber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-robber" class="form-control selectpicker" name="row[robber]">
                <?php if(is_array($robberList) || $robberList instanceof \think\Collection || $robberList instanceof \think\Paginator): if( count($robberList)==0 ) : echo "" ;else: foreach($robberList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
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
        <script src="/newinfo/public/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/newinfo/public/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>