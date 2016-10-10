/**
 * 
 * 邀请码信息提示语言
 * 
 * @author wbqing405@sina.com
 * 
 */
function TinviteCodeLang(){
	this.JS_LANG = '';
}
TinviteCodeLang.prototype.init = function(){
	
};
TinviteCodeLang.prototype.addLangRow = function(){
	var html = '';
	html += '<div class="ic_lang_row w_350">';
	html += '<div class="ic_lang_row_left w_150">' + this.JS_LANG.LangName + '：<input type="text" class="input" size="10" name="LangName[]" /></div>';
	html += '<div class="ic_lang_row_center w_150">' + this.JS_LANG.LangCode + '：<input type="text" class="input" size="10" name="LangCode[]" /></div>';
	html += '<div class="ic_lang_row_right w_40"><a href="javascript:void(0);" onclick="javascript:inviteCodeLang.delLangRow(this,0);">' + this.JS_LANG.Delete + '</a></div>';
	html += '</div>';
	
	$('#ic_lang_ct').append(html);
	html = null;
};
TinviteCodeLang.prototype.delLangRow = function(type, LangClassID){
	Boxy.confirm( 
			inviteCodeLang.JS_LANG.Ex_ComfirmDelete ,
			function(){
				$(type).parent().parent().remove();
				if(LangClassID != 0){
					$.get('/codeAjax/delInviteCodeClass',{LangClassID:LangClassID,rnd:Math.random()},function(data){
					});
				}
			},
			{title: inviteCodeLang.JS_LANG.Remind ,modal:true,unloadOnHide:true}
		);
};
TinviteCodeLang.prototype.doSubmit = function(){
	$('#ic_lang').submit();
};