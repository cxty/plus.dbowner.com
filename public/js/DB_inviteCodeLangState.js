/**
 * 
 * 邀请码信息提示语言
 * 
 * @author wbqing405@sina.com
 * 
 */
function TinviteCodeLangState(){
	this.JS_LANG = '';
	this.langJson = '';
}
TinviteCodeLangState.prototype.init = function(){
	$('#ic_lang_ct input[type=radio]').click(function(){	
		inviteCodeLangState.radioClick();
	});
};
TinviteCodeLangState.prototype.radioClick = function(){
	var rObj = $('#ic_lang_ct input[type=radio]');
	rObj.each(function(ke,va){
		if(rObj.eq(ke).attr('checked') == 'checked'){
			$('#radio').val(ke);
			
			inviteCodeLangState.addLangID(ke);
		}
	});
};
TinviteCodeLangState.prototype.addLangID = function(num){
	var hObj = $('#ic_lang_ct span').eq(num).find('input[type=hidden]');
	var LangIDStr = '';
	hObj.each(function(ke,va){
		LangIDStr += ','+hObj.eq(ke).val();
	});
	$('#LangID').val(LangIDStr);
	$.get('/codeAjax/changeInviteCodeStatus',{LangIDStr:LangIDStr,rnd:Math.random()},function(data){

	});
};
TinviteCodeLangState.prototype.addLangRow = function(){
	var html = '<span>';
	if(this.langJson.length > 0){
		for(var i=0;i<this.langJson.length;i++){
			html += '<div class="ic_lang_row w_600">';
			html += '<div class="ic_lang_row_left w_80"><div class="rd">';
			if(i == 0){
				html += '<input type="radio" name="default" />';
			}else{
				html += '&nbsp;&nbsp;&nbsp;&nbsp;';
			}
			html += '</div>' + this.langJson[i]['LangName'] + '：</div>';
			html += '<div class="ic_lang_row_center w_150"><input type="text" class="input" size="80" name="' + this.langJson[i]['LangCode'] + '_state[]" /></div>';
			html += '<div class="ic_lang_row_right w_40">';
			if(i == 0){
				html += '<a href="javascript:void(0);" onclick="javascript:inviteCodeLangState.delLangRow(this);">' + this.JS_LANG.Delete + '</a>';
			}
			html += '</div></div>';
		}
	}
	html += '</span>';
	
	$('#ic_lang_ct').append(
		$(html).find('input[type=radio]').click(function(){
			inviteCodeLangState.radioClick();
		}).parent().parent().parent().parent()
	);
	html = null;
};
TinviteCodeLangState.prototype.delLangRow = function(type){
	Boxy.confirm( 
			inviteCodeLangState.JS_LANG.Ex_ComfirmDelete ,
			function(){
				$(type).parent().parent().parent().remove();

				if($(type).parent().parent().parent().find('input[type=radio]').attr('checked') == 'checked'){
					$('#radio').val(0);
					$('#ic_lang_ct input[type=radio]').eq(0).attr('checked','checked');
					inviteCodeLangState.addLangID(0);
					
				}
				var hObj = $(type).parent().parent().parent().find('input[type=hidden]');
				var LangIDStr = '';
				hObj.each(function(ke,va){
					LangIDStr += ','+hObj.eq(ke).val();
				});

				if(LangIDStr != 0){
					$.get('/codeAjax/delInviteCodeLang',{LangIDStr:LangIDStr,rnd:Math.random()},function(data){
					});
				}
			},
			{title: inviteCodeLangState.JS_LANG.Remind ,modal:true,unloadOnHide:true}
		);
};
TinviteCodeLangState.prototype.doSubmit = function(){
	$('#ic_lang').submit();
};