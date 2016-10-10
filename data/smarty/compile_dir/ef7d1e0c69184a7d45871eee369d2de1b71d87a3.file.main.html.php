<?php /* Smarty version Smarty-3.0.8, created on 2014-04-29 14:16:11
         compiled from "./templates/code/main.html" */ ?>
<?php /*%%SmartyHeaderCode:2023652599535f43abaa9bd5-61650951%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef7d1e0c69184a7d45871eee369d2de1b71d87a3' => 
    array (
      0 => './templates/code/main.html',
      1 => 1398752136,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2023652599535f43abaa9bd5-61650951',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<div class="main_top_box"></div>

<iframe src ="/<?php echo $_smarty_tpl->getVariable('cdata')->value['code'];?>
" frameborder="0" marginheight="0" marginwidth="0" frameborder="0" scrolling="auto" height="600" id="ifm" name="ifm" onload="javascript:dyniframesize('ifm');" width="100%"></iframe> 


<script language="javascript" type="text/javascript"> 
$.fancybox.showLoading();
var isOnLoad = true; 
$('#ifm').load(function() { 
	isOnLoad = false;// 加载完成 
	$.fancybox.hideLoading();
}); 

function dyniframesize(down) { 
	var pTar = null; 
	if (document.getElementById){ 
		pTar = document.getElementById(down); 
	}else{ 
		eval('pTar = ' + down + ';'); 
	} 
	if (pTar && !window.opera){ 
		//begin resizing iframe 
		pTar.style.display="block" 
		if (pTar.contentDocument && pTar.contentDocument.body.offsetHeight){ 
			//ns6 syntax 
			pTar.height = pTar.contentDocument.body.offsetHeight + 50; 
			pTar.width = pTar.contentDocument.body.scrollWidth; 
		} 
		else if (pTar.Document && pTar.Document.body.scrollHeight){ 
			//ie5+ syntax 
			pTar.height = pTar.Document.body.scrollHeight + 50; 
			pTar.width = pTar.Document.body.scrollWidth; 
		} 
	} 
} 
</script>

<?php $_template = new Smarty_Internal_Template('footer.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>