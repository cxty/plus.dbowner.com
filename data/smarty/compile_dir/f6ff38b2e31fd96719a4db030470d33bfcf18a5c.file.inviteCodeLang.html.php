<?php /* Smarty version Smarty-3.0.8, created on 2014-11-13 16:48:17
         compiled from "./templates/inviteCode/inviteCodeLang.html" */ ?>
<?php /*%%SmartyHeaderCode:620396450546470512e2ba7-71566385%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6ff38b2e31fd96719a4db030470d33bfcf18a5c' => 
    array (
      0 => './templates/inviteCode/inviteCodeLang.html',
      1 => 1398743670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '620396450546470512e2ba7-71566385',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/DB_inviteCodeLang.js" ></script>

<div class="ic_lang_box ">
	<div class="ic_lang_title"><?php echo $_smarty_tpl->getVariable('Lang')->value['LangTitle'];?>
:</div>
	<form id="ic_lang" method="post" action="/codeAjax/addInviteCodeClass">
	<input type="hidden" name="PlugInCode" value="<?php echo $_GET['PlugInCode'];?>
" />
	<input type="hidden" name="PlugInName" value="<?php echo $_GET['PlugInName'];?>
" />
	<input type="hidden" name="view" value="<?php echo $_GET['view'];?>
" />
	<div class="ic_lang_ct w_350" id="ic_lang_ct">
		<?php if ($_smarty_tpl->getVariable('listInfo')->value){?>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listInfo')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<div class="ic_lang_row w_350">
					<div class="ic_lang_row_left w_150"><?php echo $_smarty_tpl->getVariable('Lang')->value['LangName'];?>
：<span><?php echo $_smarty_tpl->tpl_vars['item']->value['LangName'];?>
</span></div>
					<div class="ic_lang_row_center w_150"><?php echo $_smarty_tpl->getVariable('Lang')->value['LangCode'];?>
：<span><?php echo $_smarty_tpl->tpl_vars['item']->value['LangCode'];?>
</span></div>
					<div class="ic_lang_row_right w_40"><a href="javascript:void(0);" onclick="javascript:inviteCodeLang.delLangRow(this,<?php echo $_smarty_tpl->tpl_vars['item']->value['LangClassID'];?>
);"><?php echo $_smarty_tpl->getVariable('Lang')->value['Delete'];?>
</a></div>		
				</div>
			<?php }} ?>
		<?php }?>
		<div class="ic_lang_row w_350">
			<div class="ic_lang_row_left w_150"><?php echo $_smarty_tpl->getVariable('Lang')->value['LangName'];?>
：<input type="text" class="input" size="10" name="LangName[]" /></div>
			<div class="ic_lang_row_center w_150"><?php echo $_smarty_tpl->getVariable('Lang')->value['LangCode'];?>
：<input type="text" class="input" size="10" name="LangCode[]" /></div>
			<div class="ic_lang_row_right w_40"><a href="javascript:void(0);" onclick="javascript:inviteCodeLang.addLangRow();"><?php echo $_smarty_tpl->getVariable('Lang')->value['Add'];?>
</a></div>
		</div>
	</div>
	<div class="in_lang_btn w_350"><a class="btn" href="javascript:void(0);" onclick="javascript:inviteCodeLang.doSubmit();"><?php echo $_smarty_tpl->getVariable('Lang')->value['Submit'];?>
</a></div>
	</form>
</div>

<script language="javascript" type="text/javascript">
var inviteCodeLang = new TinviteCodeLang();
inviteCodeLang.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
//页面完全再入后初始化
$(document).ready(function(){
	inviteCodeLang.init();
});
//释放
$(window).unload(function(){
	inviteCodeLang = null;
});
</script>