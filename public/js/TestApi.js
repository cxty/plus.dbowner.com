$(document).ready(function(){

	var apiurl;	
	var data;
	var host ="http://"+window.location.host;
	
	$(".send_msg").hide();
	$(".attention").hide();
	

		$("select").change(function(){
		//alert($("select").val());
		var select=$("select").val();
		
		$(".textarea_a").text("");
		$(".textarea_b").text("");
		
		switch(select)
		{
		case '绑定的第三方平台':	
			$(".send_msg").hide();
			$(".attention").hide();
		break;
		
		case '发布信息':
			$(".send_msg").show();
			$(".attention").hide();
		break;
		
		case '关注':
			$(".attention").show();
			$(".send_msg").hide();		
		break;
		}
		
	})
	
	

	
	$("#btn").click(function(){
	
	var select=$("select").val();
	var appid= $("#appid").val();
	var client_secret= $("#client_secret").val();
	var redirect_uri= $("#redirect_uri").val();
	var access_token = $("#accesss_token").val();	
	var providers  =$("#providers").val();
	var content =$("#content").val();
	var name=$("#name").val()
	
	
	
	
	switch(select)
	{
	case '绑定的第三方平台':
		var api =host+"/share/get_providers"
		//var api="http://share.dbowner.com/share/interface_get_providers";		
		var url=api+'?'+'access_token='+access_token;
		apiurl='/share/get_providers';
		data={"access_token":access_token};
	
	break;
	
	case '发布信息':
		var api=host+"/share/send_msg";
		var url=api+'?'+'access_token='+access_token+'&providers='+providers+'&content='+content;
		apiurl='/share/send_msg';
		data={"access_token":access_token,"providers":providers,"content":content};
		
	break;
	
	case '关注':
		var providers  =$("#providers1").val();
		var api=host+"/share/attention";
		var url=api+'?'+'access_token='+access_token+'&providers='+providers+'&name='+name;
		apiurl='/share/attention';
		data={"access_token":access_token,"providers":providers,"name":name};
	
	break;
	}


	$(".textarea_a").text(url);
	
	$.ajax({   
        url: apiurl,
        data:data,
        type:"post",
        success:function(data){  
       	 
       	$(".textarea_b").text(data);
        }    
	})  
	
	
	
	}) 
	
})