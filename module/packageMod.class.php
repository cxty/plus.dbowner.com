<?php
class packageMod extends commonMod{
	/**
	 * 测试插件
	 */
	public function test(){
		
		$this->display('package/test.html');
	}
	/**
	 * 生成邀请码
	 */
	public function createInviteCode(){
		
		$UserID    = ComFun::getCookies('UserID');
		$client_id = $_GET['client_id'];
		//用户必须先登录系统
		if(empty($UserID)){
			ComFun::throwMsg('Ex_LostParam102');
		}
		if(empty($_GET['client_id'])){
			ComFun::throwMsg('Ex_LostParam102');
		}
		
		$tArr['UserID']    = $UserID;
		$tArr['client_id'] = $client_id;
		
		//旧的方法
		// 		$inviteCode = $this->getClass('InviteCode');
		// 		$inviteArr = $inviteCode->getAllInviteCode($tArr);
		
		$dbSoapExpandInviteCode = $this->getClass('DBSoapExpandInviteCode');
		$inviteCodeList = $dbSoapExpandInviteCode->getUserInviteCodeList($tArr);
		
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
		
		$inviteInfo['total']     = $_GET['count'] ? $_GET['count'] : 5;
		$inviteInfo['product']     = $inviteCodeList ? count($inviteCodeList) : 0;
		$inviteInfo['used']      = $i;
		$inviteInfo['code']      = json_encode($code);
		$inviteInfo['client_id'] = $client_id;
		
		$this->assign('inviteInfo',$inviteInfo);
		$this->display ('main/createInviteCode.html');
	}
}