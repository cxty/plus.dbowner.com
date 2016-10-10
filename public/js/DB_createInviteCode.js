
function TcreateIC(){
	this.JS_LANG = '';
	this.client_id = '';
	this.Root = '';
	this.code = '';
	
}
TcreateIC.prototype.init = function(){
	if(this.code){
		for(var i=0;i<this.code.length;i++){
			this.addinvitecode(this.code[i]);
		}
	}

	$('#submit_btn').click(function(){
		$.fancybox.showLoading();
		$.get('/inviteCode/getActiveCode',{client_id:createIC.client_id,maxValue:$('#ct_total').text(),proNum:$('#ct_pro').text(),rnd:Math.random()},function(data){
			$.fancybox.hideLoading();
			if(data.code == -1){
				Boxy.alert(createIC.JS_LANG.Ex_EmptyUserID,
					function(){},
					{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
				);
			}else if(data.code == -2){
				Boxy.alert(createIC.JS_LANG.Ex_NotEmpty100,
					function(){},
					{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
				);
			}else if(data.code == -3){
				Boxy.alert(createIC.JS_LANG.Ex_Remind200,
					function(){},
					{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
				);
			}else if(data.code == -4){
				Boxy.alert(createIC.JS_LANG.Ex_ErrorSystem410,
					function(){},
					{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
				);
			}else{
				$('#invitecode').val(data.invitecode);
				$('#inviteConnect').val(data.url);
				createIC.addinvitecode(data.invitecode);
				createIC.code.push(data.invitecode);
				
				$('#ct_pro').text(parseInt($('#ct_pro').text())+1);
			}					
		},'json');	
	});	
};
TcreateIC.prototype.addinvitecode = function(code){
	var _codeBar = '';
	_codeBar = $('<div class="ic_invitecode" code="'+code+'"><dt>'+this.JS_LANG.InviteCode+':</dt><dr>'+code+'</dr></div>').click(function(){
		var _code = $(this).attr('code');
		$.fancybox.showLoading();
		$.get('/inviteCode/changeInvitecode', {invitecode:_code, rnd:Math.random()}, function ( data ) {
			$.fancybox.hideLoading();
			$('#invitecode').val( data.invitecode );
			$('#inviteConnect').val( data.url );
		},'json');
		_code = null;
	});
	$('.ic_con_invitecode').append(_codeBar);
	_codeBar = null;	
};
TcreateIC.prototype.sendInviteCode = function(){
	if($('#invitecode').val() == ''){
		Boxy.alert(createIC.JS_LANG.Ex_Remind202,
			function(){},
			{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
		);
	
	}else if($('#inviteEmail').val() == ''){
		Boxy.alert(createIC.JS_LANG.Ex_Remind201,
			function(){$('#inviteEmail').focus();},
			{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
		);
	}else{
		var rules = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;//验证Mail的正则表达式,^[a-zA-Z0-9_-]:开头必须为字母,下划线,数字,

		if(rules.test($('#inviteEmail').val())){
			$.get('/inviteCode/sendInviteCode',{client_id:this.client_id,inviteCode:$('#invitecode').val(),Email:$('#inviteEmail').val(),rnd:Math.random()},function(data){
				switch(parseInt(data)){
					case -1:
						Boxy.alert(createIC.JS_LANG.Ex_Remind205,
								function(){},
								{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
							);
						break;
					case -2:
						Boxy.alert(createIC.JS_LANG.Ex_Remind206,
								function(){},
								{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
							);
						break;
					case -3:
						Boxy.alert(createIC.JS_LANG.Ex_Remind207,
								function(){},
								{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
							);
						break;
					default:
						Boxy.alert(createIC.JS_LANG.Ex_Remind203,
								function(){
									$('.ic_invitecode').each(function(ke, va){
										if($('.ic_invitecode').eq(ke).attr('code') == $('#invitecode').val()){
											$('.ic_invitecode').eq(ke).remove();
											$('.ic_content input[type=text]').eq(0).val('');
											$('.ic_content input[type=text]').eq(1).val('');
											$('.ic_content input[type=text]').eq(2).val('').focus();
										};
									});
								},
								{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
							);
						break;
				}	
			});
		}else{
			Boxy.alert(createIC.JS_LANG.EffectiveEmail,
				function(){$('#inviteEmail').val('').focus();},
				{title: createIC.JS_LANG.Remind ,modal:true,unloadOnHide:true}
			);
		}	
	}
};