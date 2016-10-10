<?php /* Smarty version Smarty-3.0.8, created on 2014-05-26 21:04:36
         compiled from "./templates/package/createInviteCode.html" */ ?>
<?php /*%%SmartyHeaderCode:207427387253833be402ff87-20180826%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7bfb1746e997acfb3a214caab47e92b1c7bd1aa2' => 
    array (
      0 => './templates/package/createInviteCode.html',
      1 => 1398743670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207427387253833be402ff87-20180826',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
 <?php echo $_smarty_tpl->getVariable('SysName')->value;?>
</title>
<link href="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/css/inviteCode.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/boxy/boxy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/jquery.js" ></script>
<script type="text/javascript" language="javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/jquery.boxy.js" ></script>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/fancybox/jquery.fancybox.js?v=2.1.3"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/fancybox/jquery.fancybox.pack.js?v=2.1.3"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />

<script type="text/javascript" language="javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/DB_createInviteCode.js"></script>

</head>
<body id="top">

<div class="ic_box">
	<div class="ic_content">
		<div class="ic_con_detail"><dt><?php echo $_smarty_tpl->getVariable('Lang')->value['InviteCode'];?>
:</dt><dr><input type="text" id="invitecode" readonly /></dr></div>
		<div class="ic_con_detail"><dt><?php echo $_smarty_tpl->getVariable('Lang')->value['InviteConnect'];?>
:</dt><dr><input type="text" id="inviteConnect" readonly /></dr></div>
		<div class="ic_con_detail"><dt><?php echo $_smarty_tpl->getVariable('Lang')->value['InviteEmail'];?>
:</dt><dr><input type="text" class="ic_reable" id="inviteEmail"  /><a href="javascript:createIC.sendInviteCode()"><?php echo $_smarty_tpl->getVariable('Lang')->value['InviteByEmail'];?>
</a></dr></div>
		<div class="ic_line"></div>
		<div class="ic_con_invitecode"></div>
		<div class="ic_foot"><?php echo $_smarty_tpl->getVariable('Lang')->value['Ic_Detail1'];?>
<span id="ct_total"><?php echo $_smarty_tpl->getVariable('inviteInfo')->value['total'];?>
</span><?php echo $_smarty_tpl->getVariable('Lang')->value['Ic_Detail2'];?>
<span id="ct_pro"><?php echo $_smarty_tpl->getVariable('inviteInfo')->value['product'];?>
</span><?php echo $_smarty_tpl->getVariable('Lang')->value['Ic_Detail3'];?>
<span id="ct_used"><?php echo $_smarty_tpl->getVariable('inviteInfo')->value['used'];?>
</span><?php echo $_smarty_tpl->getVariable('Lang')->value['Ic_Detail4'];?>
</div>
	</div>
	
	<div class="input_btn" id="submit_btn"><span> <?php echo $_smarty_tpl->getVariable('Lang')->value['CreateInviteCode'];?>
</span></div>
</div>

<script type="text/javascript">
createIC = new TcreateIC();
createIC.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
createIC.Root = '<?php echo $_smarty_tpl->getVariable('inviteInfo')->value['iurl'];?>
';
createIC.client_id = '<?php echo $_smarty_tpl->getVariable('inviteInfo')->value['client_id'];?>
';
createIC.encrypt_client_id = '<?php echo $_smarty_tpl->getVariable('inviteInfo')->value['encrypt_client_id'];?>
';
createIC.code = <?php echo $_smarty_tpl->getVariable('inviteInfo')->value['code'];?>
;

//页面完全再入后初始化
$(document).ready(function(){
	createIC.init();
});
//释放
$(window).unload(function(){
	createIC = null;
});
</script>

</body>