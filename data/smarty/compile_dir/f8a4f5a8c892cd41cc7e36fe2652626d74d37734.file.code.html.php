<?php /* Smarty version Smarty-3.0.8, created on 2014-04-29 14:46:05
         compiled from "./templates/code/code.html" */ ?>
<?php /*%%SmartyHeaderCode:1346079132535f4aadebe480-03006378%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8a4f5a8c892cd41cc7e36fe2652626d74d37734' => 
    array (
      0 => './templates/code/code.html',
      1 => 1398752136,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1346079132535f4aadebe480-03006378',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/DB_plugInCode.js" ></script>

<div class="code_box">
	<div class="plugIn_list" id="plugIn_list">
		<?php if ($_smarty_tpl->getVariable('listInfo')->value){?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listInfo')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<div class="plugIn_info" code="<?php echo $_smarty_tpl->tpl_vars['item']->value['PlugInCode'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['PlugInName'];?>
" >  
					<a href="/code/main?code=<?php echo $_smarty_tpl->tpl_vars['item']->value['PlugInCode'];?>
&name=<?php echo $_smarty_tpl->tpl_vars['item']->value['PlugInName'];?>
" class="img_list tiptip_plus" title="<div class='wb'><span class='fw_b'><?php echo $_smarty_tpl->getVariable('Lang')->value['PlugInState'];?>
</span>:<?php echo $_smarty_tpl->tpl_vars['item']->value['pPlugInState'];?>
</div>" ><img src-data="<?php echo $_smarty_tpl->tpl_vars['item']->value['pIcoCode_128'];?>
" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/images/loading_128.gif"></a>
					<div class="plugIn_state"><a href="javascript:void(0);" class="tiptip_plus"></a><?php echo $_smarty_tpl->tpl_vars['item']->value['PlugInName'];?>
（<?php echo $_smarty_tpl->tpl_vars['item']->value['PlugInCode'];?>
）</div>
				</div>
			<?php }} ?>
		<?php }?>	
	</div>	
	<div class="showpage"><?php echo $_smarty_tpl->getVariable('showpage')->value;?>
</div>
</div>

<script language="javascript" type="text/javascript">
var plugInCode = new TplugInCode();
plugInCode.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
//页面完全再入后初始化
$(document).ready(function(){
	plugInCode.init();
});
//释放
$(window).unload(function(){
	plugInCode = null;
});
</script>

<?php $_template = new Smarty_Internal_Template('footer.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>