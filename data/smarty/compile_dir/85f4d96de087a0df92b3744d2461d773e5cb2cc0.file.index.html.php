<?php /* Smarty version Smarty-3.0.8, created on 2014-04-28 17:36:50
         compiled from "./templates/share/index.html" */ ?>
<?php /*%%SmartyHeaderCode:1352483741535e213294a707-95782933%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85f4d96de087a0df92b3744d2461d773e5cb2cc0' => 
    array (
      0 => './templates/share/index.html',
      1 => 1393897100,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1352483741535e213294a707-95782933',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header_iframe.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

  <link href="<?php echo $_smarty_tpl->getVariable('__ROOT__')->value;?>
/public/css/TestApi.css" rel="stylesheet" type="text/css"></link>
  <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__ROOT__')->value;?>
/public/js/jquery-1.7.2.js"></script> 
  <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('__ROOT__')->value;?>
/public/js/TestApi.js"></script> 

    <div class="center_box">
        

<div class="main">

<div class="left">
 
  <div>
 <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;API项目:</span>
   <span>
     <select>
      <option>绑定的第三方平台</option>
      <option>发布信息</option>
      <option>关注</option>
     </select>
    </span>
   </div>
  
 <!--   <div><span>提交方式:</span>POST<input type="radio" checked="checked" name="submit"></input>GET<input type="radio" name="submit"></input></div>-->
  <div><span>accesss_token:</span><span><input type="text" id="accesss_token"></input></span></div>
  <div class="get_providers">
  <!--  <div><span>appid:</span><span><input type="text" id="appid"></input></span></div>
  <div><span>client_secret:</span><span><input type="text" id="client_secret"></input></span></div>
  <div><span>redirect_uri: </span><span><input type="text"  id="redirect_uri"></input></span></div>  -->
  
  </div>
  
  <div class="send_msg">
  
  <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;providers: <input type="text" id="providers"></input></div>
  <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;content: <input type="text" id="content"></input></div>
  </div>
  
  <div class="attention">

  <div><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;providers: </span><span><input type="text" id="providers1"></input></span></div>
  <div><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;name: </span><span><input type="text" id="name"></input></span></div>
  </div>
  
  <div><input type="submit" value='提交' id="btn"></input></div> 
</div>

<div class="right">
     <div>提交参数：</div>
     <div><textarea class="textarea_a"></textarea></div>
     
     <div>返回结果：</div>
     <div><textarea class="textarea_b"></textarea></div>
</div>


</div>
        
    </div>
<?php $_template = new Smarty_Internal_Template('footer_iframe.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
