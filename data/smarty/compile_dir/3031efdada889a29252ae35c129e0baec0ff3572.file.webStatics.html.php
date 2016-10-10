<?php /* Smarty version Smarty-3.0.8, created on 2014-04-29 14:19:53
         compiled from "./templates/webStatics/webStatics.html" */ ?>
<?php /*%%SmartyHeaderCode:812668085535f44898c9cd6-34266945%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3031efdada889a29252ae35c129e0baec0ff3572' => 
    array (
      0 => './templates/webStatics/webStatics.html',
      1 => 1398752390,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '812668085535f44898c9cd6-34266945',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header2.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<script src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/plugin/Highcharts/js/highcharts.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/plugin/Highcharts/js/modules/exporting.js"></script>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/DB.webStaticsPlugIn.js"></script>

<div id="container" style="width: 1000px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">
var webStaticsPlugIn = new TwebStaticsPlugIn();
webStaticsPlugIn.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
webStaticsPlugIn.udata = <?php echo $_smarty_tpl->getVariable('udata')->value;?>
;
//页面完全载入后初始化
$(document).ready(function(){
	webStaticsPlugIn.init();
});
//释放
$(window).unload(function(){
	webStaticsPlugIn = null;
});
</script>

<?php $_template = new Smarty_Internal_Template('footer2.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>