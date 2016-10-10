<?php /* Smarty version Smarty-3.0.8, created on 2014-04-29 11:54:41
         compiled from "./templates/header.html" */ ?>
<?php /*%%SmartyHeaderCode:845418168535f2281dcc3f8-48480978%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd701c050746a5ee258b58a5bc4dd80a198b99e51' => 
    array (
      0 => './templates/header.html',
      1 => 1398743672,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '845418168535f2281dcc3f8-48480978',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>
<?php $_template = new Smarty_Internal_Template('link.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</head>
  
<body>
<div class="header_box">
	<div class="header_inner">
		<div class="h_img"><a href="/" ><img src="<?php echo $_smarty_tpl->getVariable('__PUBLIC__')->value;?>
/images/ico_2.png"  height="35" /></a></div>
		<div class="h_left">
             |&nbsp;&nbsp;<a href="/code"><?php echo $_smarty_tpl->getVariable('Lang')->value['PlugInInfo'];?>
</a>
             <?php if ($_smarty_tpl->getVariable('cdata')->value['name']){?>
	             &nbsp;&nbsp;|&nbsp;&nbsp;
				 <a href="/<?php echo $_smarty_tpl->getVariable('cdata')->value['code'];?>
" target="ifm"><?php echo $_smarty_tpl->getVariable('cdata')->value['name'];?>
</a>
			 <?php }?>
        </div>
        <div class="h_right">
            <script src="http://auth.dbowner.com/provitejs/userbox?lang=zh" language="javascript" type="text/javascript"></script>
        </div>
	</div>
</div>

<script language="javascript" type="text/javascript">
var headerJs = new TheaderJs();
headerJs.JS_LANG = <?php echo $_smarty_tpl->getVariable('JS_LANG')->value;?>
;
//页面完全再入后初始化
$(document).ready(function(){
	headerJs.init();
});
//释放
$(window).unload(function(){
	headerJs = null;
});
</script>