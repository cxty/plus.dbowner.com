<?php /* Smarty version Smarty-3.0.8, created on 2014-07-08 11:06:39
         compiled from "./templates/inviteCode/addInviteCode.html" */ ?>
<?php /*%%SmartyHeaderCode:183584164753bb603fd6cfa5-44890651%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06fb33906f7c069dcf194b52a622dd60adc35e1a' => 
    array (
      0 => './templates/inviteCode/addInviteCode.html',
      1 => 1398743670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183584164753bb603fd6cfa5-44890651',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header2.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/DB_addInviteCode.js" ></script>

<div class="incode_box_fancybox">
	<div class="tb_list">
		<div class="tb_list_cnt tb_list_h_30">
			<dl class="w_80"><?php echo $_smarty_tpl->getVariable('Lang')->value['AppID'];?>
</dl>
			<dl class="w_200"><input type="text" class="input" size="40" id="appID" /></dl>		
			<dl class="w_120 mr_left clo_red" id="rmd_appID"></dl>
		</div>
		<div class="tb_list_btn"><a href="javascript:addInviteCode.addInviteCode()" class="btn"><?php echo $_smarty_tpl->getVariable('Lang')->value['Add'];?>
</a></div>
	</div>
</div>

<script language="javascript" type="text/javascript">
var addInviteCode = new TaddInviteCode();
addInviteCode.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
//页面完全再入后初始化
$(document).ready(function(){
	addInviteCode.init();
});
//释放
$(window).unload(function(){
	addInviteCode = null;
});
</script>

<?php $_template = new Smarty_Internal_Template('footer2.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>