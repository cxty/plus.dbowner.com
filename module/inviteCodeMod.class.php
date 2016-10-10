<?php
/**
 *
 * 具体插件处理-----二维码
 *
 * @author wbqing405@sina.com
 *
 */
class inviteCodeMod extends commonMod {
	/**
	 * 邀请码处理
	 */
	public function index () {
		$this->assign('title', Lang::get('DBOwner'));
		
		$view = isset($_GET['view']) ? $_GET['view'] : 'list';
		switch($view){
			case 'list':
				$paramsUrl = 'PlugInCode=InviteCode&PlugInName='.$_GET['PlugInName'];
				$inCodeUrl = '/inviteCode?'.$paramsUrl;
				$dbPlugInInfo = $this->getClass('DBPlugInInfo');
				$pagesize = 10;
				$listInfo = $dbPlugInInfo->getInviteCodeList('', $pagesize, $_GET['page']);
				if($listInfo['list']){
					foreach($listInfo['list'] as $key=>$val){
						$FUID[] = $val['FUID'];
						$TUID[] = $val['TUID'];
					}
				}
		
				$FUIDList = $dbPlugInInfo->getUserNameInfoByUserID($FUID);
				$TUIDList = $dbPlugInInfo->getUserNameInfoByUserID($TUID);
				if(is_array($FUIDList)){
					foreach($FUIDList as $key=>$val){
						$listInfo['list'][$key]['fUserName'] = $val['username'];
						$listInfo['list'][$key]['tUserName'] = $TUIDList[$key]['username'];
					}
				}
		
				$this->assign('listInfo', $listInfo['list']);
				$this->assign('FUIDList', $FUIDList);
				$this->assign('FUIDList', $FUIDList);
				$this->assign('paramsUrl', $paramsUrl);
				$this->assign('inCodeUrl', $inCodeUrl);
				$this->assign('showpage', $this->showpage($inCodeUrl, $listInfo['count'], $pagesize, 5, 2));
				break;
			case 'remind':
				$dbInviteCodeLangState = $this->getClass('DBInviteCodeLangState');
				$langInfo = $dbInviteCodeLangState->getLangClassInfo();
				$langStr = '';
				if(is_array($langInfo)){
					foreach($langInfo as $val){
						$langStr .= ','.$val['LangCode'];
					}
				}
				$listInfo = $dbInviteCodeLangState->getLangList();
		
				$this->assign('langStr', $langStr);
				$this->assign('langInfo', $langInfo);
				$this->assign('langJson', json_encode($langInfo));
				$this->assign('listInfo', $listInfo);
				$this->assign('listCount', ($listInfo['list'] ? count($listInfo['list']) : 0));
				break;
			case 'class':
				$dbInviteCodeLangState = $this->getClass('DBInviteCodeLangState');
				$listInfo = $dbInviteCodeLangState->getLangClassInfo();
				$this->assign('listInfo', $listInfo);
				break;
		}
		
		$this->assign('view', $view);
		$this->display ('inviteCode/InviteCode.html');
	}
	
	
	
//curl方法
	/**
	 * 返回信息处理
	 */
	private function _return($data=null) {
		if(isset($data['error'])){
			$data['msg'] = ComFun::getErrorValue($data['error']);
		}
	
		echo json_encode($data);exit;
	}
	/**
	 * 检验应用是否有调用插件的权限
	 */
	public function checkUserValid($tArr){	
		$url = $this->config['PLATFORM']['Auth'].'/db/expAuthUserAndEncryptByAuth';
		$url = 'https://auth.dbowner.com/db/expAuthUserAndEncryptByAuth';
		
		$tArr['client_id'] = $this->config['oauth']['client_id'];
		$tArr['user_id']   = $tArr['user_id'];
		
		$token = DBCurl::dbGet($url, 'get', $tArr);
		
		if(!$token['state']){
			$this->_return(array('state' => false,'error' => 'pl1002'));
		}
	
		return $token;
	}
	/**
	 * 用户是否已经输入过邀请码
	 */
	public function used(){
		$client_id = isset($_GET['client_id']) ? $_GET['client_id'] : $_POST['client_id'];
		$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];
		
		$tArr['user_id'] = $user_id;
		
		$re = $this->checkUserValid($tArr);
		
		if($re['state']){
			$tArr['user_id'] = $user_id;
			$tArr['client_id'] = $client_id;
			
			$dbPlugInInfo = $this->getClass('DBPlugInInfo');
			$rb = $dbPlugInInfo->checkUserHadInviteCode($tArr);
				
			$this->_return(array('state' => true,'result' => $rb));
		} else {
			$this->_return(array('state' => false,'result' => false));
		}
	}
	/**
	 * 通过url进行邀请码验证
	 */
	public function useInviteCode(){
		$client_id = isset($_GET['client_id']) ? $_GET['client_id'] : $_POST['client_id'];
		$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_POST['user_id'];
		$InviteCode = isset($_GET['InviteCode']) ? $_GET['InviteCode'] : $_POST['InviteCode'];
		
		if(!$client_id){
			$this->_return(array('state' => false,'error' => 'pl1003'));
		}
		if(!$user_id){
			$this->_return(array('state' => false,'error' => 'pl1004'));
		}
		if(!$InviteCode){
			$this->_return(array('state' => false,'error' => 'pl1005'));
		}
		
		$tArr['user_id']   = $user_id;
		$tArr['client_id'] = $client_id;
			
		$dbPlugInInfo = $this->getClass('DBPlugInInfo');
		
		if($dbPlugInInfo->checkUserHadInviteCode($tArr)){
			$this->_return(array('state' => false,'error' => 'pl1006'));
		}
		
		$tArr['InviteCode'] = $InviteCode;
		
		if($dbPlugInInfo->activeInviteCode($tArr) == 1 ){
			$this->_return(array('state' => true,'result' => 'success'));
		}else{
			$this->_return(array('state' => false,'error' => 'pl1007'));
		}
	}
	/**
	 * 二维码登录时，弹出框
	 */
	public function check(){
		$client_id    = $_GET['client_id'];
		$user_id      = $_GET['user_id'];
		$InviteCode   = $_GET['InviteCode'];
		$this->assign('InviteCode', $InviteCode);
		
		if(empty($client_id)){
			$this->redirect('/throwMessage/throwError?msgkey=Ex_NotNullClientID');
		}
		if(empty($user_id)){
			$this->redirect('/throwMessage/throwError?msgkey=Ex_NotNullUserID');
		}
		$cookies['check_client_id'] = $client_id;
		$cookies['check_user_id']   = $user_id;
		ComFun::SetCookies($cookies);
		
		$this->assign('aurl', $this->config['PLATFORM']['Auth']);
		
		$this->display('package/iframe_checkInviteCode.html');
	}
	/**
	 * 通过邀请码获取应用ID
	 */
	public function getClientIDByInviteCode(){
		$InviteCode = isset($_GET['InviteCode']) ? $_GET['InviteCode'] : $_POST['InviteCode'];
		
		if(!$InviteCode){
			$this->_return(array('state' => false,'error' => 'pl1005'));
		}
		
		$tArr['InviteCode'] = $InviteCode;
		$dbPlugInInfo = $this->getClass('DBPlugInInfo');
		$rb = $dbPlugInInfo->getAppIDByInviteCode($tArr);
		
		if($rb){
			$this->_return(array('state' => true,'result' => $rb));
		}else{
			$this->_return(array('state' => false,'error' => 'pl1008'));
		}
		
	}
	/**
	 * 用户输入邀请码进行激活动作处理
	 */
	public function useActiveCode(){	
		$inviteCode = $_GET['inviteCode'];
		if(empty($inviteCode)){
			echo -3;exit;
		}
		$tArr['InviteCode'] = $inviteCode;
		$tArr['client_id']  = ComFun::getCookies('check_client_id');
		$tArr['user_id']    = ComFun::getCookies('check_user_id');
	
		$dbPlugInInfo = $this->getClass('DBPlugInInfo');
		echo $dbPlugInInfo->activeInviteCode($tArr);
		
		ComFun::destoryCookies($tArr);
	}
	/**
	 * 生成二维码
	 */
	public function set(){
		$user_id   = $_GET['user_id'];
		$client_id = $_GET['client_id'];

		//用户必须先登录系统
		if(empty($user_id)){
			ComFun::throwMsg('Ex_LostParam102');
		}
		if(empty($_GET['client_id'])){
			ComFun::throwMsg('Ex_LostParam102');
		}
		
		$tArr['user_id']   = $user_id;
		$tArr['client_id'] = $client_id;
		
		$dbPlugInInfo = $this->getClass('DBPlugInInfo');
		$inviteCodeList = $dbPlugInInfo->getInviteCodeInfo($tArr);
		
		$i = 0;
		$code = array();
		if(is_array($inviteCodeList)){
			foreach($inviteCodeList as $val){
				if(empty($val['TUID'])){
					$code[] = $val['InviteCode'];
				}else{
					$i++;
				}
			}
		}
	
		$inviteInfo['total']             = $_GET['count'] ? $_GET['count'] : 5;
		$inviteInfo['product']           = $inviteCodeList ? count($inviteCodeList) : 0;
		$inviteInfo['used']              = $i;
		$inviteInfo['code']              = json_encode($code);
		$inviteInfo['client_id']         = $client_id;
		$inviteInfo['encrypt_client_id'] = ComFun::__encrypt($client_id);
		$inviteInfo['iurl']              = '';
		
		
		
		$cookies['check_client_id'] = $client_id;
		$cookies['check_user_id']   = $user_id;
		ComFun::SetCookies($cookies);
		
		$this->assign('inviteInfo',$inviteInfo);
		$this->display ('package/createInviteCode.html');
	}
	/**
	 * 取激活码
	 */
	public function getActiveCode(){
		$user_id = ComFun::getCookies('check_user_id');
		$client_id = ComFun::getCookies('check_client_id');
		//用户必须先登录系统
		if(empty($user_id)){
			$code = -1;
		}elseif(empty($client_id)){
			$code = -2;
		}else{
			if(intval($_GET['proNum']) >= intval($_GET['maxValue'])){
				$code = -3;
			}else{
				$tArr['UserID']    = $user_id;
				$tArr['AppInfoID'] = $client_id;
					
				$dbPlugInInfo = $this->getClass('DBPlugInInfo');
				$rb = $dbPlugInInfo->addInviteCodeBack($tArr);
				
				if($rb){
					$code = 1;
					$invitecode = $rb;
					$url = ComFun::getShortUrl( $this->config['PLATFORM']['Auth'] . '/index/inviteCode-' . $invitecode );
				}else{
					$code = -4;
				}
			}
		}
		$_rb['code']       = $code;
		$_rb['invitecode'] = $invitecode;
		$_rb['url']        = $url;
		
		echo json_encode( $_rb );
	}
	/**
	 * 地址改为短地址
	 */
	public function changeInvitecode () {
		$_invitecode = $_GET['invitecode'];
		if ( $_invitecode ) {
			$_rb['url'] = ComFun::getShortUrl( $this->config['PLATFORM']['Auth'] . '/index/inviteCode-' . $_invitecode );
		} else {
			$_rb['url'] = '';
		}
		$_rb['invitecode'] = $_invitecode;
		echo json_encode( $_rb );
	}
	/**
	 * 邮件发送激活码
	 */
	public function sendInviteCode(){		
		$url = $this->config['PLATFORM']['Auth'].'/db/getUserNameByUserID';
		
		$tArr['user_id'] = ComFun::getCookies('check_user_id');
		
		$token = DBCurl::dbGet($url, 'get', $tArr);

		if(!$token['state']){
			echo -1;exit;
		}
		
		$uName = $token['userName'];
		
		$Email      = $_GET['Email'];
		$inviteCode = $_GET['inviteCode'];
		$client_id  = $_GET['client_id'];
		
		if(empty($Email)){
			echo -2;exit;
		}
		if(empty($inviteCode)){
			echo -3;exit;
		}

		$emArr['uName']   = $uName;
		$emArr['uEmail']  = $Email;
		$emArr['uCode']   = $inviteCode;
		$emArr['type']    = 'inviteCode';
	
		ComFun::toSendMail($emArr);
		
		echo 1;exit;
	}
	/**
	 * 测试方法
	 */
	public function email(){
		$emArr['uName']   = '吴本清';
		$emArr['uEmail']  = '379182261@qq.com';
		$emArr['uCode']   = '0cdb5f893bb9b81eab2198c7a';
		$emArr['type']    = 'invitecode';
		ComFun::pr($emArr);
		//exit;
		ComFun::toSendMail($emArr);
		exit;
	}
	/**
	 * 测试
	 */
	public function test(){
		$a = Array
		(
				'user_id' => 'ajQ3VGU2NVRtOGh4WHlhWWZtSXhGQT09',
				'client_id' => '80022003'
		);
		
		ComFun::pr($a);
		$this->display('package/test.html');
	}
}