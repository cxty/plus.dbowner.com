/**
 * 
 * 邀请码登录验证
 * 
 * @author wbqing405@sina.com
 * 
 */
function TcheckInviteCode(){
	this.JS_LANG = '';
	this.aurl = '';
};
TcheckInviteCode.prototype.init = function(){
	$("#submit_btn").click(function(){
		var code = $('#inviteCode').val();
		
		if(code == ''){
			Boxy.alert(checkInviteCode.JS_LANG.IsNullInviteCode,
					function(){$('#inviteCode').val('').focus();},
					{title: checkInviteCode.JS_LANG.Remind ,modal:true,unloadOnHide:true}
					);	
		}else{		
			$.get('/inviteCode/useActiveCode',{type:1,client_id:$('#client_id').val(),inviteCode:code,rnd:Math.random()},function(data){
				switch(parseInt(data)){
					case 1:
						Boxy.alert(checkInviteCode.JS_LANG.SuccessActive,
								function(){checkInviteCode.closeFancybox();},
								{title: checkInviteCode.JS_LANG.Remind ,modal:true,unloadOnHide:true}
								);	
						break;
					case -1:
						Boxy.alert(checkInviteCode.JS_LANG.FailActive_CodeNotExist,
								function(){$('#inviteCode').val('').focus();},
								{title: checkInviteCode.JS_LANG.Remind ,modal:true,unloadOnHide:true}
								);
						break;
					case -2:
						Boxy.alert(checkInviteCode.JS_LANG.FailActive_CodeActived,
								function(){$('#inviteCode').val('').focus();},
								{title: checkInviteCode.JS_LANG.Remind ,modal:true,unloadOnHide:true}
								);
						break;
					case -3:
						Boxy.alert(checkInviteCode.JS_LANG.IsNullInviteCode,
								function(){$('#inviteCode').val('').focus();},
								{title: checkInviteCode.JS_LANG.Remind ,modal:true,unloadOnHide:true}
								);
						break;
					default:
						Boxy.alert(checkInviteCode.JS_LANG.FailActive,
								function(){},
								{title: checkInviteCode.JS_LANG.Remind ,modal:true,unloadOnHide:true}
								);
						break;
				}
			});
		}
	});
};
TcheckInviteCode.prototype.closeFancybox = function(){
	//document.getElementById('inCodeFarme').src = this.aurl+'/index/refreshInviCode';
};