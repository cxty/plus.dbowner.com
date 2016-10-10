<?php /* Smarty version Smarty-3.0.8, created on 2014-04-29 15:30:05
         compiled from "./templates/webStatics/addWebSite.html" */ ?>
<?php /*%%SmartyHeaderCode:1407963910535f54fda0ef00-15424169%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '09c76956cbcefcbe1cff93e38b2199fb4412727b' => 
    array (
      0 => './templates/webStatics/addWebSite.html',
      1 => 1398743671,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1407963910535f54fda0ef00-15424169',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header2.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/DB_addWebSite.js" ></script>

<div class="webstatics_box_fancybox">
	<div class="tb_list">
		<input type="hidden" id="webStaticID" value="<?php echo $_GET['webStaticID'];?>
" />
		<div class="tb_list_cnt tb_list_h_30">
			<dl class="w_80"><?php echo $_smarty_tpl->getVariable('Lang')->value['WebName'];?>
</dl>
			<dl class="w_200"><input type="text" class="input" size="53" id="webName" value="<?php echo $_smarty_tpl->getVariable('listInfo')->value['pWebName'];?>
" /></dl>		
			<dl class="w_120 mr_left clo_red" id="rmd_appID"></dl>
		</div>
		<div class="tb_list_cnt tb_list_h_40">
			<dl class="w_80"><?php echo $_smarty_tpl->getVariable('Lang')->value['WebStaticsCode'];?>
</dl>
			<dl class="w_200">
				<textarea id="staticCode" cols="38" rows="10" readonly><?php echo $_smarty_tpl->getVariable('listInfo')->value['webSiteCode'];?>
</textarea>
			</dl>		
			<dl class="w_120 mr_left clo_red" id="rmd_appID"></dl>
		</div>
		<div class="tb_list_btn"><a href="javascript:void(0)" id="sub_btn" class="btn"><?php echo $_smarty_tpl->getVariable('Lang')->value['Submit'];?>
</a></div>
	</div>
</div>

<script language="javascript" type="text/javascript">
var addWebSite = new TaddWebSite();
addWebSite.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
//页面完全再入后初始化
$(document).ready(function(){
	addWebSite.init();
});
//释放
$(window).unload(function(){
	addWebSite = null;
});
</script>

<?php $_template = new Smarty_Internal_Template('footer2.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>