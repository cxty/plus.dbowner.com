<?php /* Smarty version Smarty-3.0.8, created on 2014-11-13 16:48:11
         compiled from "./templates/inviteCode/inviteCodeState.html" */ ?>
<?php /*%%SmartyHeaderCode:11997764935464704b7fc069-77197234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc8caf50a877a5bc995ca6d6ff67485cb84d5ffd' => 
    array (
      0 => './templates/inviteCode/inviteCodeState.html',
      1 => 1398743670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11997764935464704b7fc069-77197234',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/DB_inviteCodeLangState.js" ></script>

<div class="ic_lang_box" >
	<div class="ic_lang_title"><?php echo $_smarty_tpl->getVariable('Lang')->value['Explain'];?>
：（<?php echo $_smarty_tpl->getVariable('Lang')->value['ExplainContent'];?>
）</div>
	<form id="ic_lang" method="post" action="/codeAjax/addInviteCodeLang">
	<input type="hidden" name="PlugInCode" value="<?php echo $_GET['PlugInCode'];?>
" />
	<input type="hidden" name="PlugInName" value="<?php echo $_GET['PlugInName'];?>
" />
	<input type="hidden" name="view" value="<?php echo $_GET['view'];?>
" />
	<input type="hidden" name="listCount" value="<?php echo $_smarty_tpl->getVariable('listCount')->value;?>
" />
	<input type="hidden" name="langStr" value="<?php echo $_smarty_tpl->getVariable('langStr')->value;?>
" />
	<input type="hidden" name="LangID" id="LangID" value="<?php echo $_smarty_tpl->getVariable('listInfo')->value['radio']['LangID'];?>
" />
	<input type="hidden" name="radio" id="radio" value="0" />
	<div class="ic_lang_ct w_600" id="ic_lang_ct">
		<?php if ($_smarty_tpl->getVariable('listInfo')->value){?>		
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listInfo')->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<span>
					<?php  $_smarty_tpl->tpl_vars['item2'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('langInfo')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item2']->key => $_smarty_tpl->tpl_vars['item2']->value){
 $_smarty_tpl->tpl_vars['key2']->value = $_smarty_tpl->tpl_vars['item2']->key;
?>
						<div class="ic_lang_row w_600">
							<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['item2']->value['LangCode']]['LangID'];?>
" />
							<div class="ic_lang_row_left w_80"><div class="rd"><?php if ($_smarty_tpl->tpl_vars['key2']->value==0){?><input type="radio" name="default" <?php if ($_smarty_tpl->tpl_vars['key']->value==$_smarty_tpl->getVariable('listInfo')->value['radio']['checked']){?>checked="checked"<?php }?>  /><?php }else{ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }?></div><?php echo $_smarty_tpl->tpl_vars['item2']->value['LangName'];?>
：</div>
							<div class="ic_lang_row_center w_450"><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['item2']->value['LangCode']]['LangState'];?>
</div>
							<div class="ic_lang_row_right w_40"><?php if ($_smarty_tpl->tpl_vars['key2']->value==0){?><a href="javascript:void(0);" onclick="javascript:inviteCodeLangState.delLangRow(this);"><?php echo $_smarty_tpl->getVariable('Lang')->value['Delete'];?>
</a><?php }?></div>					
						</div>
					<?php }} ?>	
				</span>
			<?php }} ?>	
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('langInfo')->value){?>
			<span>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('langInfo')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<div class="ic_lang_row w_600">
					<div class="ic_lang_row_left w_80"><div class="rd"><?php if ($_smarty_tpl->tpl_vars['key']->value==0){?><input type="radio" name="default" <?php if (!$_smarty_tpl->getVariable('listInfo')->value){?>checked="checked"<?php }?> /><?php }else{ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }?></div><?php echo $_smarty_tpl->tpl_vars['item']->value['LangName'];?>
：</div>
					<div class="ic_lang_row_center w_450"><input type="text" class="input" size="80" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['LangCode'];?>
_state[]" /></div>
					<div class="ic_lang_row_right w_40"><?php if ($_smarty_tpl->tpl_vars['key']->value==0){?><a href="javascript:void(0);" onclick="javascript:inviteCodeLangState.addLangRow(this,0);"><?php echo $_smarty_tpl->getVariable('Lang')->value['Add'];?>
</a><?php }?></div>		
				</div>
			<?php }} ?>
			</span>
		<?php }?>
	</div>
	<div class="in_lang_btn"><a class="btn" href="javascript:void(0);" onclick="javascript:inviteCodeLangState.doSubmit();"><?php echo $_smarty_tpl->getVariable('Lang')->value['Submit'];?>
</a></div>
	</form>
</div>		
		
<script language="javascript" type="text/javascript">
var inviteCodeLangState = new TinviteCodeLangState();
inviteCodeLangState.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
inviteCodeLangState.langJson  = <?php echo $_smarty_tpl->getVariable('langJson')->value;?>
;
//页面完全再入后初始化
$(document).ready(function(){
	inviteCodeLangState.init();
});
//释放
$(window).unload(function(){
	inviteCodeLangState = null;
});
</script>