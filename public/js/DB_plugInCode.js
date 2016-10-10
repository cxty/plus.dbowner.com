/**
 * 
 * code方法
 * 
 * @author wbqing405@sina.com
 * 
 */
function TplugInCode(){
	this.JS_LANG = '';
}
TplugInCode.prototype.init = function(){
	$(".tiptip_plus").tipTip({maxWidth: "160px", edgeOffset: 10});
	
	plugInCode.loadImg();
};
TplugInCode.prototype.loadImg = function(){
	var pObj = $('#plugIn_list img');
	pObj.each(function(ke,va){
		pObj.eq(ke).attr('src',pObj.eq(ke).attr('src-data'));
	});
};