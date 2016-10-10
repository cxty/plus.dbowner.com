/**
 * 
 * 增加页面统计记录
 * 
 * @author wbqing405@sina.com
 * 
 */
function TaddWebSite(){
	this.JS_LANG = '';
}
TaddWebSite.prototype.init = function(){
	if($('#webStaticID').val() == 0){
		addWebSite.addWebSiteCode();
	}
	
	$('#sub_btn').click(function(){
		addWebSite.subClick();
	});
};
TaddWebSite.prototype.addWebSiteCode = function(){
	$.get('/webStatics/addWebSiteCode',{},function(data){
		$('#staticCode').val('<script src="' + data + '" language="javascript" type="text/javascript"></script>');	
	});
};
TaddWebSite.prototype.subClick = function(){
	var webName = $('#webName').val();
	if(webName == ''){
		alert(addWebSite.JS_LANG.Ex_NotEmptyWebName);
		return;
	}

	$.get('/webStatics/subform',{webStaticID:$('#webStaticID').val(), webName:webName, rnd:Math.random()},function(data){
		alert(data.msg);
		if(data.status){
			window.parent.webstatics.close();
		}
	}
	,'json'
	);
};