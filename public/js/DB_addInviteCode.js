/**
 * 
 * 增加邀请码方法
 * 
 * @author wbqing405@sina.com
 * 
 */
function TaddInviteCode(){
	this.JS_LANG = '';
}
TaddInviteCode.prototype.init = function(){
	
};
TaddInviteCode.prototype.addInviteCode = function(){
	var appID = $('#appID').val();
	if(appID == ''){
		$('#rmd_appID').text( addInviteCode.JS_LANG.Ex_NotNullAppID );
		$('#appID').focus();
	}else{
		$.get('/codeAjax/addInviteCode', {AppInfoID:appID, rnd:Math.random()}, function(data){
			if(data == -1){
				$('#rmd_appID').text( addInviteCode.JS_LANG.Ex_ErrorParams );
			}else{
				window.parent.inviteCode.close();
			}
		});
	}
};