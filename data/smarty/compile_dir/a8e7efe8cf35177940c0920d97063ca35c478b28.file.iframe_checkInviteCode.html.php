<?php /* Smarty version Smarty-3.0.8, created on 2014-05-27 16:29:51
         compiled from "./templates/package/iframe_checkInviteCode.html" */ ?>
<?php /*%%SmartyHeaderCode:196543638953844cffb15bc3-09849816%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a8e7efe8cf35177940c0920d97063ca35c478b28' => 
    array (
      0 => './templates/package/iframe_checkInviteCode.html',
      1 => 1401179338,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '196543638953844cffb15bc3-09849816',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header_fancybox.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<script language="javascript" type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/DB_checkInviteCode.js"></script>

<div class="lg_incode">
	<div class="lg_title"><?php echo $_smarty_tpl->getVariable('Lang')->value['CheckInviteCode'];?>
</div>
	<div class="lg_ctn mg_top_25">
		<input type="text" class="input_big w_invicode" id="inviteCode" value="<?php echo $_smarty_tpl->getVariable('InviteCode')->value;?>
" <?php ob_start();?><?php echo $_smarty_tpl->getVariable('InviteCode')->value;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>readonly<?php }?> />
	</div>
	<div class="lg_btn">
		<div class="input_sub" id="submit_btn"><span><?php echo $_smarty_tpl->getVariable('Lang')->value['Active'];?>
</span></div>
	</div>
</div>

<iframe id="inCodeFarme" src="#" style="display:none;"></iframe>

<script language="javascript">
//document.domain = "www.dbowner.com";
checkInviteCode = new TcheckInviteCode();
checkInviteCode.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
checkInviteCode.aurl = '<?php echo $_smarty_tpl->getVariable('aurl')->value;?>
';
//页面完全再入后初始化
$(document).ready(function(){
	checkInviteCode.init();
});
//释放
$(window).unload(function(){
	checkInviteCode = null;
});
</script>

<?php $_template = new Smarty_Internal_Template('footer_fancybox.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>