/**
 * 
 * 邀请码方法
 * 
 * @author wbqing405@sina.com
 * 
 */
function TinviteCode(){
	this.JS_LANG = '';
}
TinviteCode.prototype.init = function(){
	$('#checkAllSelect').click(function(){
		if($(this).attr('checked')){
			$('#tb_list input[type=checkbox]').attr('checked', true);
		}else{
			$('#tb_list input[type=checkbox]').attr('checked', false);
		}
		
	});
};
TinviteCode.prototype.addInviteCode = function(){
	$.fancybox({
        type: 'iframe',
        href: '/codeAjax/preAddInviteCode',
        scrolling: 'auto',
        width: 450,
        height: 1000,
        autoScale: false,
        centerOnScroll: true,
        hideOnOverlayClick: false,
        onClosed: function(){
        	window.location = location;
        }
    });
};
TinviteCode.prototype.close = function(){
	$.fancybox.close();
	document.location.reload();
};
TinviteCode.prototype.delInviteCode = function(){
	var idStr = '';
	$('#tb_list input[type=checkbox]').each(function(){
		if($(this).attr('checked')){
			idStr += '|' + $(this).val();
		}
	});
	
	Boxy.confirm( inviteCode.JS_LANG.ConfirmDelInviteCode,
			function(){
				$.get('/codeAjax/delInviteCode', {idStr:idStr, rnd:Math.random()}, function(data){
					document.location.reload();
				});
			},
			{title: inviteCode.JS_LANG.RemindMsg }
	);
};
TinviteCode.prototype.del = function(key, inviteCodeID){
	Boxy.confirm( inviteCode.JS_LANG.ConfirmDelInviteCode,
			function(){
				$.get('/codeAjax/delInviteCode', {idStr:inviteCodeID, rnd:Math.random()}, function(data){
					document.location.reload();
				});
			},
			{title: inviteCode.JS_LANG.RemindMsg }
	);
};