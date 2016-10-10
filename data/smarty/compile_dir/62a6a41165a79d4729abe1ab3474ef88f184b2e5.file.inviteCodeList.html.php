<?php /* Smarty version Smarty-3.0.8, created on 2014-05-27 15:45:23
         compiled from "./templates/inviteCode/inviteCodeList.html" */ ?>
<?php /*%%SmartyHeaderCode:444716314538442937e3982-79093832%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62a6a41165a79d4729abe1ab3474ef88f184b2e5' => 
    array (
      0 => './templates/inviteCode/inviteCodeList.html',
      1 => 1401176721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '444716314538442937e3982-79093832',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/www/web/plus_dbowner_com/public_html/include/ext/smarty/plugins/modifier.date_format.php';
?>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/js/DB_inviteCode.js" ></script>

<div class="tb_list">
	<div class="tb_list_title">
		<dl class="w_40"><input type="checkbox" id="checkAllSelect" /></dl>
		<dl class="w_100"><?php echo $_smarty_tpl->getVariable('Lang')->value['AppID'];?>
</dl>
		<dl class="w_100"><?php echo $_smarty_tpl->getVariable('Lang')->value['FUserName'];?>
</dl>
		<dl class="w_100"><?php echo $_smarty_tpl->getVariable('Lang')->value['TUserName'];?>
</dl>
		<dl class="w_180"><?php echo $_smarty_tpl->getVariable('Lang')->value['InviteCode'];?>
</dl>
		<dl class="w_100"><?php echo $_smarty_tpl->getVariable('Lang')->value['Mandle'];?>
</dl>
		<dt class="w_150"><?php echo $_smarty_tpl->getVariable('Lang')->value['UserTime'];?>
</dt>
		<dt class="w_150"><?php echo $_smarty_tpl->getVariable('Lang')->value['AppendTime'];?>
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
					<dl class="w_40"><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['InviteCodeID'];?>
" /></dl>
					<dl class="w_100"><?php echo $_smarty_tpl->tpl_vars['item']->value['AppInfoID'];?>
</dl>
					<dl class="w_100"><?php if ($_smarty_tpl->tpl_vars['item']->value['fUserName']){?><?php echo $_smarty_tpl->tpl_vars['item']->value['fUserName'];?>
<?php }else{ ?>&nbsp;<?php }?></dl>
					<dl class="w_100"><?php if ($_smarty_tpl->tpl_vars['item']->value['tUserName']){?><?php echo $_smarty_tpl->tpl_vars['item']->value['tUserName'];?>
<?php }else{ ?>&nbsp;<?php }?></dl>
					<dl class="w_180"><?php echo $_smarty_tpl->tpl_vars['item']->value['InviteCode'];?>
</dl>
					<dl class="w_100">
						<a href="javascript:inviteCode.del(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['item']->value['InviteCodeID'];?>
')"><?php echo $_smarty_tpl->getVariable('Lang')->value['Delete'];?>
</a>
					</dl>
					<dt class="w_150"><?php if ($_smarty_tpl->tpl_vars['item']->value['iUseTime']){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['iUseTime'],"%Y-%m-%d %H:%M");?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('Lang')->value['NotUsed'];?>
<?php }?></dt>
					<dt class="w_150"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['iAppendTime'],"%Y-%m-%d %H:%M");?>
</dt>
				</li>
			<?php }} ?>
		<?php }?>
	</ul>
	<div class="showpage">
		<div class="l_bar">
			<a href="javascript:void(0);" onclick="javascript:inviteCode.addInviteCode();"><?php echo $_smarty_tpl->getVariable('Lang')->value['Add'];?>
</a>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="javascript:inviteCode.delInviteCode();"><?php echo $_smarty_tpl->getVariable('Lang')->value['Delete'];?>
</a>
		</div>
		<div class="r_bar"><?php echo $_smarty_tpl->getVariable('showpage')->value;?>
</div>
	</div>
</div>

<script language="javascript" type="text/javascript">
var inviteCode = new TinviteCode();
inviteCode.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
//页面完全再入后初始化
$(document).ready(function(){
	inviteCode.init();
});
//释放
$(window).unload(function(){
	inviteCode = null;
});
</script>