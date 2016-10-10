/**
 * 
 * 页面统计管理
 * 
 * @author wbqing405@sina.com
 * 
 */
function Twebstatics(){
	this.JS_LANG = '';
}
Twebstatics.prototype.init = function (){
	$('#add_btn').click(function(){
		webstatics.addClick(0);
	});
	$('#del_btn').click(function(){
		var idStr = '';
		$('#tb_list input[type=checkbox]').each(function(){
			if($(this).attr('checked')){
				idStr += ',' + $(this).val();
			}
		});
		if(idStr){
			webstatics.delClick(idStr);
		}
	});
	$('.modClick').click(function(){
		webstatics.addClick($('#tb_list input[type=checkbox]').eq($('.modClick').index(this)).val());
	});
	$('.delClick').click(function(){ 
		webstatics.delClick(','+$('#tb_list input[type=checkbox]').eq($('.delClick').index(this)).val());
	});
	$('.staticClick').click(function(){
		webstatics.staticWeb( $(this).attr('value') );
	});
	
	$('#checkAllSelect').click(function(){
		if($(this).attr('checked')){
			$('#tb_list input[type=checkbox]').attr('checked', true);
		}else{
			$('#tb_list input[type=checkbox]').attr('checked', false);
		}
		
	});
};
Twebstatics.prototype.addClick = function(webStaticID){
	$.fancybox({
		type: 'iframe',
        href: '/webStatics/addWebSite?webStaticID=' + webStaticID,
        scrolling: 'auto',
        width: 450,
        height: 500,
        fitToView: false,
        helpers: {
         overlay:{
          closeClick: false
         }
        },
        afterLoad : function(){
         
        }
    });
};
Twebstatics.prototype.close = function(){
	$.fancybox.close();
	document.location.reload();
};
Twebstatics.prototype.delClick = function(idStr){
	Boxy.confirm( webstatics.JS_LANG.ConfirmDelWebStaticsCode,
			function(){
				$.get('/webStatics/delWebStatics', {idStr:idStr, rnd:Math.random()}, function(data){
					document.location.reload();
				});
			},
			{title: webstatics.JS_LANG.RemindMsg }
	);
};
Twebstatics.prototype.staticWeb = function( code ) {
	$.get('/webStatics/statics',{code:code,rnd:Math.random()},function(data){
		if ( data ) {
			$.fancybox({
				type: 'iframe',
		        href: data,
		        scrolling: 'auto',
		        width: 1000,
		        height: 500,
		        fitToView: false,
		        centerOnScroll: true,
		        helpers: {
		         overlay:{
		          closeClick: false
		         }
		        },
		        afterLoad : function(){
		         
		        }
		    });
		}	
	});
};