<?php
//session_start();
include('include/ext/DBCurl.class.php');
class shareMod extends commonMod {


	public  $token;  //access_token
	
	

	public function test2 () {
		header ( "content-type: text/javascript; charset=utf-8" );
		
		$lang = $_GET['lang'] ? $_GET['lang'] : 'zh' ;
		$type=$_GET['type']?$_GET['type']:'button';
		$providers=$this->get_providers();
		//$providers = json_encode(array('QQ','Sina'));
		
		//$providers = '{"QQ","Sina"}';
		//echo 'alert("' . $providers . '。length")';exit;
	
	if($type=="button")
		{
			$html = 'var js_u_ui={
							root : "'.__ROOT__.'",
							type:"'.$type.'",
						    css : "'.__PUBLIC__.'/css/ShowStyle1.css",
						    js  :"'.__PUBLIC__.'/js/ShowStyle1.js"
						    b:"'.$providers.'"
						    		
						    
						};';
		}
		else 
		{
			$html = 'var js_u_ui={
							root : "'.__ROOT__.'",
							type:"'.$type.'",
						    css : "'.__PUBLIC__.'/css/ShowStyle.css",
						    js  :"'.__PUBLIC__.'/js/ShowStyle.js",
					      	providers:'.$providers.'
						   
						};';
		}
		

		
		$html .='(function() {';
		$html .= 'document.write(\'<div id="ui_share"></div>\');';
		$html .= 'var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true; ';
		$html .= 'ga.src = "'.__PUBLIC__.'/js/test.js"; ';
		$html .= 'var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.appendChild(ga, s); ';
		$html .='})();';
		
		echo $html;
	}
	
	public function test3 () {

		$this->display();
	}
	
	public function test () {
		
		//$type = $_GET['type'] ? $_GET['type'] : 'button';
		

		$provides = $_GET['provides'] ? $_GET['provides'] : 'QQ,Sina,Wangyi,Douban,Kaixin';
		
		$arr = array(
				'state' => true,
				'data' => array(
					'providers' => array("QQ","Sina","Wangyi","Douban","Kaixin")
				)
		);  
		
		
	    $a=$this->get_providers();
	    $b= $a['data']['providers'];
	    $c=json_decode($b,true);
	    //print_r($a);
	   // print_r($c);
	   // print_r($arr[data][providers]);

	    
	    switch ( $_GET['type'] ) {
	    	case 'float':
	    		    $i = 0;
	    			foreach ( $c as $_v_1 ) {
	    				$_list[$i] = $_v_1;
	    				$i++;	
	    			
	    		}
	    		//print_r($_list);
	    		$this->assign('list', $_list);
	    		$this->display('share/test_float.html');
	    		break;
	    	default:
	    		if ( $provides ) {
	    			$proArr = explode(',',$provides);
	    			$i = 0;
	    			foreach ( $proArr as $_v ) {
	    				foreach ( $c as $_v_2 ) {
	    					if ( strtolower($_v_2) == strtolower($_v) ) {
	    						$_list[$i] = $_v_2;
	    						$i++;
	    					}
	    				}
	    			}
	    		} else {
	    
	    			//默认
	    		}
	    
	    		$this->assign('list', $_list);
	    
	    		$this->display('share/test_button.html');
	    		break;
	    }  
	
		
	}
	
	//请求分享
	public function index () 
	{
		$title = 'aaaaa';
		$this->assign('title', $title);
		//echo $_COOKIE['access_token'];
		$url = 'http://share.dbowner.com/share/share_interface';
		$tArr['access_token'] ='Tk5lTGY3WnA3NEswejF5cjY5ZmU1T05YenhFbEk3YXo%3D';
		$tArr['providers']=json_encode(array('QQ'));
		$tArr['content']='好好学习3';
		//$tArr['url']='http://share.dbowner.com/plugin';
		
		$aaa= DBCurl::dbGet($url, 'post', $tArr);
 
		//echo json_encode($aaa);
	    print_r($aaa);

	}
	
	
	//发布信息到指定平台
	public function interface_send_msg () {
		
		//接收参数
	    $format       = $_GET['format'] ? $_GET['format'] : $_POST['format'];
		$access_token = $_GET['access_token'] ? $_GET['access_token'] : $_POST['access_token'];
		$providers    = $_GET['providers'] ? $_GET['providers'] : $_POST['providers'];
		$content      = $_GET['content'] ? $_GET['content'] : $_POST['content'];
		//$url          = $_GET['url'] ? $_GET['url'] : $_POST['url'];
		 
	    //调用接口
	    $requesturl='http://auth.dbowner.com/share/send_msg';	    
	    $tArr['access_token'] =$access_token ;
	    $tArr['providers']=json_encode(array($providers));
	    $tArr['content']=$content;
	    
	    $result= DBCurl::dbGet($requesturl, 'POST', $tArr);
	 
	    
	    echo json_encode($result);

	}
	
	//DBOwner所有第三方平台、请求用户绑定的第三方平台
	public function interface_get_providers()
	{
		//接收参数
		$access_token = $_GET['access_token'] ? $_GET['access_token'] : $_POST['access_token'];
		
		//调用接口
		$requesturl='http://auth.dbowner.com/share/get_providers';
		$tArr['access_token'] =$access_token ; 
		 
		$result= DBCurl::dbGet($requesturl, 'POST', $tArr);
		 
		echo json_encode($result);
	}
	
	//关注DBOwner账号
	public function interface_attention()
	{
		//接收参数	
		$access_token = $_GET['access_token'] ? $_GET['access_token'] : $_POST['access_token'];
		$providers    = $_GET['providers'] ? $_GET['providers'] : $_POST['providers'];
		$name    = $_GET['name'] ? $_GET['name'] : $_POST['name'];
		//$url          = $_GET['url'] ? $_GET['url'] : $_POST['url'];
		
		
			
		//调用接口
		$requesturl='http://auth.dbowner.com/share/attention';
		$tArr['access_token'] =$access_token ;
		$tArr['providers']=json_encode(array($providers));
		$tArr['name']=$name;
		
		$result= DBCurl::dbGet($requesturl, 'POST', $tArr);
		 
		echo json_encode($result);
	}
	

	//授权第1步，获取code
	public function authorize()
	{
		$params['client_id'] = $this->config['client_id'];
		$params['redirect_uri'] = $this->config['redirect_uri'];
		$params['response_type'] = 'code';
		$params['display'] = 'default';
		
		$url = $this->config['authorizeURL'].'?'.http_build_query($params);
		$this->redirect($url);

       	//$authorize='http://auth.dbowner.com/oauth/authorize?client_id=app33&redirect_uri=http://share.dbowner.com/share/hide&response_type=code&display=default';
		//$this->redirect($authorize);

	}

	//授权第2步,获取accesss_token
	public function  GetToken($code)
	{
		$url=$this->config['accessTokenURL'];
		$parameters['client_id']=$this->config['client_id'];
		$parameters['client_secret']=$this->config['client_secret'];
		$parameters['redirect_uri']=$this->config['redirect_uri'];
		$parameters['grant_type ']='code';
		$parameters['code']=$code;
			
		$result=DBCurl::dbGet($url, 'POST', $parameters);
		
		$date=$this->model->query('select * from authorize'); //查询数据
		
		$access=$result['access_token'];
			
	    if(isset($date[0]['access_token']))
	    {
	    	$this->model->query('update  authorize set access_token=\''.$access.'\'');  //更新access_token
	    }
	    else
	    {
	    	$this->model->query('insert into authorize values(\''.$access.'\')');      //插入access_token
	    } 
		
	}
	
	//分享页面
	public function sharepage()
	{
		
		$style=$_GET["style"];
		$providers=$_GET["providers"];
		switch ($style)
		{
			//按钮
			case 'button':
			{
				
				break;
			}
			//侧边式
			case 'float':
			{
				
			   break;
			}
			//划词
			case '3':
			{
			   break;		
			}	
		}  
		
		$this->display();
	}
	
	//发布页面
	public function share()
	{
	   
	   $date=$this->model->query('select * from authorize');

		//print_r($date);
	   if(isset($date[0]['access_token']))
	   {
	   	  //$this->token=$date[0]['access_token'];   	  
	      setcookie("access_token",$date[0]['access_token'], time()+3600);
	   } 
	   
	   
		//发布页面的url
		$shareurl= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$_SESSION['shareurl']=$shareurl;
	
		//$this->config['access_token'];
	
		$title= $_GET['title'];          //分享页面的title
		$url=$_GET['url'];               //分享页面的url
		$providers=$_GET['providers'];   //平台
		
		$this->assign('title', $title);
		$this->assign('url', $url);
		$this->assign('providers', $providers);
	
		//echo $_COOKIE['access_token'];exit();
	
		//获取绑定的平台
		//$partner=$this->get_providers();
		//$common= json_decode($partner,true);
	
		//显示默认的平台
		//$common = array('QQ','Sina','QQmb','Renren','Kaixin');
		//$this->assign('common', $common);
	
		//获取绑定第三方平台的信息
		$this->istimeoutofpartner($providers);
	
		$backurl= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
		$this->display();
	}
	
	//分享按钮
	public function  ajax()
	{  		
		if(isset($_COOKIE['access_token']))
    	{
		 	$content=$_GET['title']."\n".$url=$_GET['url'];
			$providers=$_GET['providers'];
			//echo json_encode($providers);
			$this->send_msg($content,$providers);  
		
		} 
		else
		{		
			echo false;
		}  
			
	
	}
	
	//回调页面
	public function hide()
	{
		if(isset($_GET['code']))
		{
			$this->GetToken($_GET['code']);
		}
	
		$this->redirect($_SESSION['shareurl']);
		$this->display();
	}
	
	
	public function config()
	{
		$this->display();
	}
	
	//分享成功页面
	public  function success()
	{	
		$this->display();
	}
	
	//分享失败页面
	public  function failure()
	{
		$this->display();
		
	}
	
	
	//发布信息到指定平台
	public function send_msg($content,$providers)
	{
		$url='http://auth.dbowner.com/share/send_msg';
		$p['access_token']=$_COOKIE['access_token'];
		$p['providers']= json_encode($providers);
		$p['content']=$content;
		$result= DBCurl::dbGet($url, 'POST', $p);
		
		//print_r($result);exit();	
		
		//返回发布信息结果
		if(array_key_exists($result['msg'],$this->config['abcde']))
		{
			$a= $result['msg'];
			echo $this->config['abcde'][$a];
			//print_r($this->config['abcde']);
		}
	    else if($result['data']['error']==108) 
	    {
	    	echo false;
	    }    
	    else 
	    {
	    	echo true;
	    }
	}
	
	//用户绑定的第三方平台
	public function get_providers()
	{
		
		$url='http://auth.dbowner.com/share/get_providers';
		$p['access_token']= $_COOKIE['access_token'];
		$result= DBCurl::dbGet($url, 'POST', $p);
		if($result[data][error]=108)
		{
			$p['access_token']= '';
			$result= DBCurl::dbGet($url, 'POST', $p);
		}
		//echo $result['data']['providers'];exit();
		
		return $result;
	    //return	$result['data']['providers'];
	    //return	$result['data']['banding'];
	}
	
	//获取绑定的第三方用户信息
	public function istimeoutofpartner($partner)
	{
		$url ='http://auth.dbowner.com/users/istimeoutofpartner';
		$parameters['access_token'] = $_COOKIE['access_token'];
		$parameters['partner']=$partner;
		$parameters['format'] = 'json';	
	    $result=  DBCurl::dbGet($url, 'POST', $parameters);
	   // print_r($result);exit();
	    
	   
	    if($result["state"]==true)   //access_token没过期
	    {
	    	$name=$result["data"]["name"];
	    	$profile=$result["data"]["profile"]; 
	    	
	    	$this->assign('name', $name);       //用户名
	    	$this->assign('profile', $profile); //用户url
	    	$this->assign('state', '换个账号');
	    	
	    }
	    else 
	    {
	    	$this->assign('state', '登录');
	    }
	    
	}

	
	//判断DBowner用户登录状态
	public function LoginState()
	{
	
		$params['access_token'] = $_COOKIE['access_token'];
		$params['format'] = 'json';
	
		$url = 'http://auth.dbowner.com/users/istimeout'.'?'.http_build_query($params);
	
		$ci = curl_init();
		curl_setopt($ci,CURLOPT_URL, $url);
		curl_setopt($ci,CURLOPT_RETURNTRANSFER, TRUE);
		$result = json_decode(curl_exec($ci),true);
		//print_r($result);exit();
	
		if(!$result['error'])
		{
			$this->UserShow();
				
		}
		else
		{
			$this->assign('state', '登录');
		}
	
	
	}
	
	//判断DBowner用户是否过期
	public function UserOut()
	{
		$params['access_token'] =$_COOKIE['access_token'] ;
		$params['format'] = 'json';
	
		$url = 'http://auth.dbowner.com/users/signout'.'?'.http_build_query($params);
	
		$ci = curl_init();
		curl_setopt($ci,CURLOPT_URL, $url);
		curl_setopt($ci,CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ci);
		curl_close($ci);
	
		var_dump($result);exit();
	}
	
	//取得DBowner用户个人信息
	public function UserShow()
	{
		$params['access_token'] = $_COOKIE['access_token'];
		$params['format'] = 'json';
			
		$url = 'http://auth.dbowner.com/users/show'.'?'.http_build_query($params);
			
		$ci = curl_init();
		curl_setopt($ci,CURLOPT_URL, $url);
		curl_setopt($ci,CURLOPT_RETURNTRANSFER, TRUE);
		$result = json_decode(curl_exec($ci),true);
		curl_close($ci);
		//print_r($result);
		//var_dump($result);
		
		$name =$result['data']['name'];
		$this->assign('name', $name);
		$this->assign('state', '换个账号');
	}
	
	
	
}