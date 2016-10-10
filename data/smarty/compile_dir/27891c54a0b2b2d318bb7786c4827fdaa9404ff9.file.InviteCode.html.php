<?php /* Smarty version Smarty-3.0.8, created on 2014-05-14 11:05:09
         compiled from "./templates/inviteCode/InviteCode.html" */ ?>
<?php /*%%SmartyHeaderCode:2382387685372dd65330ff6-27863405%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27891c54a0b2b2d318bb7786c4827fdaa9404ff9' => 
    array (
      0 => './templates/inviteCode/InviteCode.html',
      1 => 1398743670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2382387685372dd65330ff6-27863405',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header_iframe.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<div class="flo_nav_box">
	<ul>
		<li <?php if ($_smarty_tpl->getVariable('view')->value=='list'){?>class="flo_selected"<?php }?>><span><a href="/inviteCode?PlugInCode=<?php echo $_GET['PlugInCode'];?>
&PlugInName=<?php echo $_GET['PlugInName'];?>
&view=list"><?php echo $_smarty_tpl->getVariable('Lang')->value['InviteCodeList'];?>
</a></span></li>
		<li <?php if ($_smarty_tpl->getVariable('view')->value=='remind'){?>class="flo_selected"<?php }?>><span><a href="/inviteCode?PlugInCode=<?php echo $_GET['PlugInCode'];?>
&PlugInName=<?php echo $_GET['PlugInName'];?>
&view=remind"><?php echo $_smarty_tpl->getVariable('Lang')->value['InviteCodeRemind'];?>
</a></span></li>
		<li <?php if ($_smarty_tpl->getVariable('view')->value=='class'){?>class="flo_selected"<?php }?>><span><a href="/inviteCode?PlugInCode=<?php echo $_GET['PlugInCode'];?>
&PlugInName=<?php echo $_GET['PlugInName'];?>
&view=class"><?php echo $_smarty_tpl->getVariable('Lang')->value['InviteCodeClass'];?>
</a></span></li>	
	</ul>
</div>
<div class="incode_box">
	<?php if ($_smarty_tpl->getVariable('view')->value=='list'){?>	
		<?php $_template = new Smarty_Internal_Template("inviteCode/inviteCodeList.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php }elseif($_smarty_tpl->getVariable('view')->value=='remind'){?>
		<?php $_template = new Smarty_Internal_Template("inviteCode/inviteCodeState.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php }elseif($_smarty_tpl->getVariable('view')->value=='class'){?>
		<?php $_template = new Smarty_Internal_Template("inviteCode/inviteCodeLang.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php }?>
</div>

<?php $_template = new Smarty_Internal_Template('footer_iframe.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>