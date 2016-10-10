<?php /* Smarty version Smarty-3.0.8, created on 2014-04-29 14:21:11
         compiled from "./templates/webStatics/index.html" */ ?>
<?php /*%%SmartyHeaderCode:1091136396535f44d7dddf55-92798741%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4335925a73b411f1ded3c6f60637a3b625e48dbb' => 
    array (
      0 => './templates/webStatics/index.html',
      1 => 1398752467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1091136396535f44d7dddf55-92798741',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/www/web/plus_dbowner_com/public_html/include/ext/smarty/plugins/modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template('header_iframe.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/DB_webstatics.js" ></script>

<div class="flo_nav_box"></div>

<div class="incode_box">
	<div class="tb_list">
		<div class="tb_list_title">
			<dl class="w_40"><input type="checkbox" id="checkAllSelect" /></dl>
			<dl class="w_350"><?php echo $_smarty_tpl->getVariable('Lang')->value['PlatformName'];?>
</dl>
			<dl class="w_200"><?php echo $_smarty_tpl->getVariable('Lang')->value['IdentCode'];?>
</dl>
			<dt class="w_150"><?php echo $_smarty_tpl->getVariable('Lang')->value['Time'];?>
</dt>	
			<dt class="w_150"><?php echo $_smarty_tpl->getVariable('Lang')->value['Mandle'];?>
</dt>		
		</div>
		<ul id="tb_list">
			<?php if ($_smarty_tpl->getVariable('listInfo')->value){?>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listInfo')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
					<li id="list_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
						<dl class="w_40"><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['AutoID'];?>
" /></dl>
						<dl class="w_350"><?php echo $_smarty_tpl->tpl_vars['item']->value['pWebName'];?>
</dl>
						<dl class="w_200"><?php echo $_smarty_tpl->tpl_vars['item']->value['pStaticsCode'];?>
</dl>
						<dt class="w_150"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['UpdateTime'],"%Y-%m-%d %H:%M");?>
</dt>
						<dt class="w_150">
							<a href="javascript:void(0);" class="modClick"><?php echo $_smarty_tpl->getVariable('Lang')->value['Modify'];?>
</a>
							|&nbsp;&nbsp;<a href="javascript:void(0);" class="delClick"><?php echo $_smarty_tpl->getVariable('Lang')->value['Delete'];?>
</a>
							|&nbsp;&nbsp;<a href="javascript:void(0);" class="staticClick" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['pStaticsCode'];?>
"><?php echo $_smarty_tpl->getVariable('Lang')->value['CheckStatics'];?>
</a>
						</dt>
					</li>
				<?php }} ?>
			<?php }?>
		</ul>
		<div class="showpage">
			<div class="l_bar">
				<a href="javascript:void(0);" id="add_btn"><?php echo $_smarty_tpl->getVariable('Lang')->value['Add'];?>
</a>
				&nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="javascript:void(0);" id="del_btn"><?php echo $_smarty_tpl->getVariable('Lang')->value['Delete'];?>
</a>
			</div>
			<div class="r_bar"><?php echo $_smarty_tpl->getVariable('showpage')->value;?>
</div>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript">
var webstatics = new Twebstatics();
webstatics.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
//页面完全再入后初始化
$(document).ready(function(){
	webstatics.init();
});
//释放
$(window).unload(function(){
	webstatics = null;
});
</script>

<?php $_template = new Smarty_Internal_Template('footer_iframe.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>