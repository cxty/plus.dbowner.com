<?php 
/**
 * 内部curl调用
 * 
 * @author BQ
 *
 */
class dbMod extends commonMod{
	/**
	 * 返回信息处理
	 */
	private function _return($data=null) {
		if(isset($data['error'])){
			$data['msg'] = ComFun::getErrorValue('private',$data['error']);
		}
	
		return json_encode($data);exit;
	}
	/**
	 * auth平台鉴权调用
	 */
	private function checkUserValid($user_id){
		if(!$user_id){
			echo $this->_return(array('state' => false, 'error' => 'ai104'));exit;
		}
		
		$MandOAuth = $this->_getClass('MandOAuth');
		$token = $MandOAuth->reAccessToken($user_id);
		
		if(!is_array($token)){
			echo $this->_return(array('state' => false, 'error' => 'ai106'));exit;
		}else{
			$tokenInfo['UserID']    = $token[0];
			$tokenInfo['client_id'] = $token[1];
		}
		
		return $tokenInfo;
	}
	/**
	 * access_token鉴权(简单版)
	 */
	private function checkAccessToken($access_token){		
		if(!$access_token){		
			echo $this->_return(array('state' => false, 'error' => 'ai101'));exit;
		}
		
		$MandOAuth = $this->_getClass('MandOAuth');
		$token = $MandOAuth->reAccessToken($access_token);

		$user = $this->_getClass('User');

		if(!$user->checkUserOnlineByOnLineID($token[0])){
			echo $this->_return(array('state' => false,'error' => 'ai108'));exit;
		};
		
		$tokenInfo = $MandOAuth->getTokenInfoByCurl($token[1]);
		if(!$tokenInfo){
			echo $this->_return(array('state' => false,'error' => 'ai102'));exit;
		}	

		return $tokenInfo;
	}
	/**
	 * 取用户信息
	 */
	public function getUserInfo(){
		$GetUserInfo = $this->_getClass('GetUserInfo',$_GET);
		$userInfo = $GetUserInfo->getUserInfo();
		echo $this->_return($userInfo);exit;
	}
	/**
	 * expand平台调用
	 */
	public function expAuthUserAndEncrypt(){
		$client_id    = isset($_GET['client_id']) ? $_GET['client_id'] : $_POST['client_id'];
		$access_token = isset($_GET['access_token']) ? $_GET['access_token'] : $_POST['access_token'];	
		if(!$client_id){
			echo $this->_return(array('state' => false,'error' => 'ai103'));
		}
		
		$token = $this->checkAccessToken($access_token);	
		
		$mandOAuth = $this->_getClass('MandOAuth');
		$user_id = $mandOAuth->doencrypt($token['UserID'].'|'.$client_id);
		
		echo $this->_return(array('state' => true, 'user_id' => $user_id));exit;
	}
	/**
	 * auth平台鉴权调用
	 */
	public function expAuthUserAndEncryptByAuth(){
		$client_id = isset($_GET['client_id']) ? $_GET['client_id'] : $_POST['client_id'];
		$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];
		if(!$user_id){
			echo $this->_return(array('state' => false, 'error' => 'ai104'));exit;
		}
		if(!$client_id){
			echo $this->_return(array('state' => false,'error' => 'ai103'));
		}
		
		$token = $this->checkUserValid($user_id);
		
		$mandOAuth = $this->_getClass('MandOAuth');
		$user_id = $mandOAuth->doencrypt($token['UserID'].'|'.$client_id);
		
		echo $this->_return(array('state' => true, 'user_id' => $user_id));exit;
	}
	/**
	 * 用户user_id换取用户名
	 */
	public function getUserNameByUserID(){
		$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];
		
		$token = $this->checkUserValid($user_id);
		
		$user = $this->_getClass('User');
		$userName = $user->getUserNameByID($token['UserID']);
		
		if($userName){
			echo $this->_return(array('state' => true, 'userName' => $userName));exit;
		}else{
			echo $this->_return(array('state' => false, 'error' => 'ai107'));exit;
		}
	}
	/**
	 * pay平台调用
	 */
	public function checkAccountValid(){
		$client_id    = isset($_GET['client_id']) ? $_GET['client_id'] : $_POST['client_id'];
		$access_token = isset($_GET['access_token']) ? $_GET['access_token'] : $_POST['access_token'];
		if(!$client_id){
			echo $this->_return(array('state' => false,'error' => 'ai103'));
		}
		
		$token = $this->checkAccessToken($access_token);
		
		$mandOAuth = $this->_getClass('MandOAuth');
		$user_id = $mandOAuth->doencrypt($token['UserID'].'|'.$client_id);
		
		echo $this->_return(array('state' => true, 'user_id' => $user_id));exit;
	}
	/**
	 * 取pay平台消费双方用户user_id
	 */
	public function getCoinUserID(){
		$access_token = isset($_GET['access_token']) ? $_GET['access_token'] : $_POST['access_token'];
		$client_id    = isset($_GET['client_id']) ? $_GET['client_id'] : $_POST['client_id'];
		$IdentCode    = isset($_GET['IdentCode']) ? $_GET['IdentCode'] : $_POST['IdentCode'];
		if(!$client_id){
			echo $this->_return(array('state' => false,'error' => 'ai103'));
		}
		if(!$IdentCode){
			echo $this->_return(array('state' => false,'error' => 'ai109'));
		}
		
		$token = $this->checkAccessToken($access_token);

		$mandOAuth = $this->_getClass('MandOAuth');
		$identList = $mandOAuth->dodecrypt(trim($IdentCode));
		
		echo $this->_return(array('state' => true, 
								  'tokenUser' => $mandOAuth->doencrypt($token['UserID'].'|'.$client_id),
								  'identUser' => $mandOAuth->doencrypt($identList[0].'|'.$client_id),
							));exit;
	}
	/**
	 * 取pay平台消费双方user_id
	 */
	public function getCoinTokenID(){
		$TokenCode    = isset($_GET['TokenCode']) ? $_GET['TokenCode'] : $_POST['TokenCode'];
		$IdentCode    = isset($_GET['IdentCode']) ? $_GET['IdentCode'] : $_POST['IdentCode'];
		$client_id    = isset($_GET['client_id']) ? $_GET['client_id'] : $_POST['client_id'];
		
		if(!$TokenCode){
			echo $this->_return(array('state' => false,'error' => 'ai110'));
		}
		if(!$IdentCode){
			echo $this->_return(array('state' => false,'error' => 'ai109'));
		}
		if(!$client_id){
			echo $this->_return(array('state' => false,'error' => 'ai103'));
		}

		$mandOAuth = $this->_getClass('MandOAuth');
		$tokenList = $mandOAuth->dodecrypt(trim($TokenCode));
		$identList = $mandOAuth->dodecrypt(trim($IdentCode));
		
		echo $this->_return(array('state' => true,
								  'tokenUser' => $mandOAuth->doencrypt($tokenList[0].'|'.$client_id),
								  'identUser' => $mandOAuth->doencrypt($identList[0].'|'.$client_id),
							));exit;
	}
	/**
	 * ad广告平台生成加密验证码
	 */
	public function getAdsIdentID(){
		$access_token = isset($_GET['access_token']) ? $_GET['access_token'] : $_POST['access_token'];
		$ads_type     = isset($_GET['ads_type']) ? $_GET['ads_type'] : $_POST['ads_type'];
		
		$token = $this->checkAccessToken($access_token);
		
		$mandOAuth = $this->_getClass('MandOAuth');
		$IdentCode = $mandOAuth->doencrypt($token['UserID'].'|'.$ads_type.'|'.time());
		
		echo $this->_return(array('state' => true, 'IdentCode' => $IdentCode));exit;
	}
	/**
	 * 值加密
	 */
	public function doencrypt(){
		$html = '';
		$html .= '<form method="get" action="/db/doencrypt">';
		$html .= '加密前：<input type="text" name="encrypt" value="'.$_GET['encrypt'].'" size="60" />';
		$html .= '&nbsp;&nbsp;<input type="submit" value="提交" />';
		$html .= '</form>';
		
		if($_GET['encrypt']){
			$mandOAuth = $this->_getClass('MandOAuth');
			$html .= '加密后：'.$mandOAuth->doencrypt(trim($_GET['encrypt']));
		}
		
		echo $html;
	}
	/**
	 * 值解密
	 */
	public function dodecrypt(){
		$html = '';
		$html .= '<form method="get" action="/db/dodecrypt">';
		$html .= '解密前：<input type="text" name="decrypt" value="'.$_GET['decrypt'].'" size="60" />';
		$html .= '&nbsp;&nbsp;<input type="submit" value="提交" />';
		$html .= '</form>';
		
		if($_GET['decrypt']){
			$mandOAuth = $this->_getClass('MandOAuth');
			$html .= '解密后：'.$mandOAuth->dodecrypt(trim($_GET['decrypt']));
		}
		
		echo $html;
	}
	/**
	 * 测试方法
	 */
	public function test(){
		$a = Array
		(
				'access_token' => 'Z0NuTlNlYlVUV3g5eHpISFNua0F3YXBZckVLd0xQV0I%3D',
				'client_id' => 'app15'
		);
		
		$url = '/db/expAuthUserAndEncrypt?'.http_build_query($a);
		
		echo $url;
		
		$this->redirect($url);
	}
	/**
	 * 上传图片测试
	 */
	public function loadPic(){
?>
	<html>
	<head></head>
	<body>
		<form method="post" enctype="multipart/form-data" action="http://expand.dbowner.com/file/up">
			<input type="file" name="filename" />
			<input type="submit" value="submit" />
		</form>
	</body>
	</html>
<?php
	}
}
?>