<?php
/**
 * SOAP服务器处理类
*
* @author wbqing405@sina.com
*/
include('Server.class.php');

class ManagePlugIn extends Server{

	var $tbUserInfo = 'tbUserInfo'; //用户授权信息
	var $tbInviteCodeInfo = 'tbInviteCodeInfo'; //邀请码信息表
	var $tbPageStaticsInfo = 'tbPageStaticsInfo'; //流量统计
	var $tbPageStaticsLogInfo = 'tbPageStaticsLogInfo'; //流量统计详情
	
	public $authorized = false;

	public function __construct($model=null){
		$this->model = $model;
		include(dirname(dirname(dirname(__FILE__))).'/conf/config.php');
		$this->config      = $config;
		
		$this->SOAP_USER   = $this->config['DES']['SOAP_USER'];
		$this->DES_PWD     = $this->config['DES']['SOAP_PWD'];
		$this->DES_IV      = $this->config['DES']['SOAP_IV'];
		$this->user        = $this->config['DES']['SOAP_USER'];

		$this->ClientIP = parent::fun()->GetIP ();
		
		if (! in_array ( $this->ClientIP, $this->config ['DES']['SOAP_SERVER_CLIENTIP'] )) {
			$this->authorized = false;
			return parent::Unauthorized_IP();
		}
	}

	/**
	 * 接口鉴权
	 *
	 * @param array $a
	 * @throws SoapFault
	 */
	public function Auth($a) {
		if ($a->user === $this->user) {
			$this->authorized = true;
			return $this->_return ( true, 'OK', null );
		} else {
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 负责data加密
	 *
	 * @see Service::_return()
	 */
	public function _return($state, $msg, $data) {
		return parent::_return ( $state, $msg,
				$this->_encrypt ( json_encode(array('data'=>$data)),
						$this->DES_PWD, $this->DES_IV ) );
	}
	/**
	 * 负责解密data,还原客户端传来的参数
	 */
	public function _value($data) {
		if (isset ( $data )) {
			return json_decode ( trim ( $this->_decrypt ( $data, $this->DES_PWD , $this->DES_IV ) ) );
		} else {
			return $data;
		}
	}
	/**
	 * 数组转化
	 */
	public function arrAddslashes($data){
		foreach($data as $key=>$val){
			$rb[$key] = parent::_addslashes($val);
		}
		return $rb;
	}
	/**
	 * 字符串转化
	 */
	public function strAddslashes($str){
		return parent::_addslashes($str);
	}
	/**
	 * 数据库连接
	 */
	public function requireConnect(){
		$this->connect = parent::RequireClass($this->model);
	}
	/**
	 * 链接数据库
	 */
	private function _connect(){
		$this->_getConnect = parent::getConnect($this->model);
	}
	/**
	 * 实例化类
	 */
	private function _getClass($className,$fieldArr=''){
		switch($className){
			case 'DBQRCodeForPC':
				include(dirname(dirname(__FILE__)).'/lib/DBQRCodeForPC.class.php');			
				return new DBQRCodeForPC($this->_getConnect, $this->config);
				break;
			case 'DBTokenCode':
				include(dirname(dirname(__FILE__)).'/lib/DBTokenCode.class.php');
				return new DBTokenCode();
				break;
			case 'DBInviteCodeLangState':
				include(dirname(dirname(__FILE__)).'/lib/DBInviteCodeLangState.class.php');
				return new DBInviteCodeLangState($this->_getConnect);
			case 'DBSoap':
				include(dirname(dirname(__FILE__)).'/lib/DBSoap.class.php');
				return new DBSoap();
				break;
		}
	
	}
	//=====以下是后台调用接口=====
	//用户信息
	/**
	 * 取用户信息
	 */
	public function SelectUserInfo($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
	
				$exp = parent::RequireClass($this->model);
	
				$field = 'UID,GroupID,UserID,uName,uLevel,uState,uAppendTime,uUpdateTime';
				
				$rb = $exp->seTableData($this->tbUserInfo,$this->strAddslashes($data->condition),$this->strAddslashes($data->order));
	
				return $this->_return ( true, 'OK', $rb );
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 更新用户信息
	 */
	public function UpdateUserInfo($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
	
				$exp = parent::RequireClass($this->model);
	
				if(!isset($data->UID)){
					return $this->_return ( false, 'UID is missing', $rb );
				}
				if(!isset($data->uState)){
					return $this->_return ( false, 'uState is missing', $rb );
				}
				
				$condition['UID'] = $data->UID;
				
				$udata['uState']       = $data->uState;
				$udata['uUpdateTime']  = time();
	
				$rb = $exp->upTableData($this->tbUserInfo, $condition, $udata);
	
				return $this->_return ( true, 'OK', $rb );
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 取用户信息列表
	 */
	public function GetUserInfoList($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
	
				$exp = parent::RequireClass($this->model);
	
				$field = 'UID,GroupID,UserID,uName,uLevel,uState,uAppendTime,uUpdateTime';
				
				$rb = $exp->geTableData($this->tbUserInfo,parent::getListPage($data->page),parent::getListPageSize($data->pagesize), $data->condition, $data->order, $field);
	
				return $this->_return ( true, 'OK', $rb );
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 增加用户信息
	 */
	public function InsertUserInfo($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
				
				if(!isset($data->uName)){
					return $this->_return ( false, 'uName is missing', null );
				}
	
				$tArr['uName']     = $data->uName;
				$tArr['client_id'] = $this->config['oauth']['client_id'];
				
				$dbSoap = $this->_getClass('DBSoap');
				$_re = $dbSoap->GetTableInfo('Auth', 'GetUserIDByUserNameAndClientID', $tArr);
		
				if($_re['data']){
					$exp = parent::RequireClass($this->model);
					
					$user_id = $_re['data'];
					
					$condition['UserID'] = $user_id;
			
					if(!$exp->seTableData($this->tbUserInfo, $condition, '', 'UID')){			
						$idata['GroupID']     = isset($data->GroupID) ? $data->GroupID : 0;
						$idata['UserID']      = $user_id;
						$idata['uName']       = $data->uName;
						$idata['uPermission'] = $data->uPermission;
						$idata['uLevel']      = isset($data->uLevel) ? $data->uLevel : 1;
						$idata['uState']      = 0;
						$idata['uAppendTime'] = time();
						$idata['uUpdateTime'] = time();
							
						$rb = $exp->inTableData($this->tbUserInfo, $idata);
							
						return $this->_return ( true, 'OK', $rb );
					}else{
						return $this->_return ( false, 'record is exist', null);
					}
				}else{
					return $this->_return ( false, $data->uName.' is not exist', null);
				}		
			}else{
				return $this->_return ( false, 'Data Error', null );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 删除用户信息
	 */
	public function DeleteUserInfo($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
	
				if(!isset($data->UID)){
					return $this->_return ( false, 'UID is missing', $rb );
				}
				
				$exp = parent::RequireClass($this->model);
				
				$where = 'UID in ('.$data->UID.')';
	
				$rb = $exp->deTableData($this->tbUserInfo, $where);
	
				return $this->_return ( true, 'OK', $rb );
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	
	//邀请码信息表
	/**
	 * 取
	 */
	public function SelectInviteCodeInfo($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
		
				$exp = parent::RequireClass($this->model);
		
				$field = 'InviteCodeID,AppInfoID,InviteCode,FUID,TUID,iStatus,iAppendTime,iUseTime';
		
				$rb = $exp->seTableData($this->tbInviteCodeInfo, $data->condition, $data->order);
		
				return $this->_return ( true, 'OK', $rb );
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
		
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	/**
	 * 更新
	 */
	public function UpdateInviteCodeInfo($pa){
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	/**
	 * 取列表
	 */
	public function GetInviteCodeInfoList($pa){
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	/**
	 * 增加
	 */
	public function InsertInviteCodeInfo($pa){
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	/**
	 * 删除
	 */
	public function DeleteInviteCodeInfo($pa){
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	
	//流量统计
	/**
	 * 取
	 */
	public function SelectPageStaticsInfo($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
	
				$dbWebStatics = parent::getlib('DBWebStatics');
				$re = $dbWebStatics->getPageStaticsInfo ( $data->condition );
				
				return $this->_return ( true, 'OK', $re );
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 更新
	 */
	public function UpdatePageStaticsInfo($pa){
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	/**
	 * 取列表
	 */
	public function GetPageStaticsInfoList($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
				
				$dbWebStatics = parent::getlib('DBWebStatics');
				$re = $dbWebStatics->getWebStaticsList ( $data->condition, $data->pagesize, $data->page );

				return $this->_return ( true, 'OK', $re );
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 增加
	 */
	public function InsertPageStaticsInfo($pa){
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	/**
	 * 删除
	 */
	public function DeletePageStaticsInfo($pa){
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	
	//流量统计详情
	/**
	 * 取
	 */
	public function SelectPageStaticsLogInfo($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
	
				$dbWebStatics = parent::getlib('DBWebStatics');
				$re = $dbWebStatics->getPageStaticsLogInfo ( $data->condition );
	
				return $this->_return ( true, 'OK', $re );
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 更新
	 */
	public function UpdatePageStaticsLogInfo($pa){
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	/**
	 * 取列表
	 */
	public function GetPageStaticsLogInfoList($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
	
				$dbWebStatics = parent::getlib('DBWebStatics');
				$re = $dbWebStatics->getPageStaticsLogInfoList ( $data->condition, $data->pagesize, $data->page );
	
				return $this->_return ( true, 'OK', $re );
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 增加
	 */
	public function InsertPageStaticsLogInfo($pa){
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	/**
	 * 删除
	 */
	public function DeletePageStaticsLogInfo($pa){
		return $this->_return ( false, 'System information', 'Interface is not open' );
	}
	
	//=============个人中心二维码登录================
	/**
	 * 增加session值
	 */
	public function GetAddSessionValue($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );

				if(!empty($data->sessionkey)){
					$tArr['cSessionID'] = $data->sessionkey;
	
					$this->_connect(); //链接数据库
					$dbQRCodeForPC = $this->_getClass('DBQRCodeForPC');
					$dbQRCodeForPC->saveSessionValue($tArr); //增加值
					$dbQRCodeForPC->deleteOverTimeSession(); //删除过期值
					
					return $this->_return ( true, 'OK', true );
				}else{
					return $this->_return ( false, 'sessionkey is empty!', false );
				}
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 验证手机登录,成功后写入用户信息
	 */
	public function GetUpdateCheckResult($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
				
				$sessionkey = $data->sessionkey;
				$user_id    = $data->user_id;
				$userCode   = $data->uCode;
				
				if(empty($sessionkey)){
					return $this->_return ( false, 'sessionkey is empty!', false );
				}
				if(empty($user_id)){
					return $this->_return ( false, 'user_id is empty!', false );
				}
				if(empty($userCode)){
					return $this->_return ( false, 'uCode is empty!', false );
				}
					
				$this->_connect(); //链接数据库
				
				$dbTokenCode = $this->_getClass('DBTokenCode');
					
				if($dbTokenCode->CheckUserByUserCode($user_id, $userCode)){

					$dbQRCodeForPC = $this->_getClass('DBQRCodeForPC');
						
					if($dbQRCodeForPC->checkSessionValid($sessionkey)){
							
						$tArr['cUserID']    = $user_id;
						$tArr['cUserCode']  = $userCode;
						$tArr['cSessionID'] = $sessionkey;
							
						$dbQRCodeForPC->updateCheckResult($tArr);
				
						return $this->_return ( true, 'OK', true );
					}else{
						return $this->_return ( false, 'it is overtime!', $rb );
					}
				}else{
					return $this->_return ( false, 'check failed!', $rb );
				}			
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 个人中心验证手机登录是否成功
	 */
	public function GetCheckPhoneLogin($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );

				$sessionkey = $data->sessionkey;
				
				if(empty($sessionkey)){
					return $this->_return ( false, 'sessionkey is empty!', false );
				}

				$this->_connect(); //链接数据库
				
				$dbQRCodeForPC = $this->_getClass('DBQRCodeForPC');
				$rb = $dbQRCodeForPC->checkPhoneLogin($sessionkey);

				if($rb){
					return $this->_return ( true, 'OK', $rb );
				}else{
					return $this->_return ( false, 'login in failed!', false );
				}
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	/**
	 * 取激活页面提示信息
	 */
	public function GetInviteCodeMessage($pa){
		if($this->authorized){
			$rb = null;
			if (isset($pa)) {
				$this->_connect(); //链接数据库
		
				$dbInviteCodeLangState = $this->_getClass('DBInviteCodeLangState');
				$rb = $dbInviteCodeLangState->getLangList();
				
				if($rb['list']){
					$nRe = '';
					foreach($rb['list'] as $key=>$val){
						if($rb['radio']['checked'] == $key){
							$i = 0;
							foreach($val as $key2=>$val2){
								$nRe[$i]['LangType']  = $key2;
								$nRe[$i]['LangState'] = $val[$key2]['LangState'];
								$i++;
							}
							break;
						}
					}
					
					return $this->_return ( true, 'OK', $nRe );
				}else{
					return $this->_return ( false, 'message is empty!', false );
				}
			}else{
				return $this->_return ( false, 'Data Error', $rb );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
	
	/**
	 * 增加网页流量统计详情
	 */
	public function GetPageStaticsLogInfo ( $pa ) {
		if($this->authorized){
			if (isset($pa)) {
				$data = $this->_value ( json_decode ( $pa->data )->data );
		
				if ( !isset($data->pStaticsCode) ) {
					return $this->_return ( false, 'pStaticsCode is empty!', null );
				}
				if ( !isset($data->pIP) ) {
					return $this->_return ( false, 'pIP is empty!', null );
				}
				if ( !isset($data->pData) ) {
					return $this->_return ( false, 'pData is empty!', null );
				}
				
				$dbWebStatics = parent::getlib('DBWebStatics');
				$re = $dbWebStatics->getByStaticsCode ( $data->pStaticsCode );
				
				if ( $re ) {
					$re['pCount'] += 1;
					$dbWebStatics->updateWebStaticsCountByID( $re );
					
					$tArr['PGID']        = $re['AutoID'];
					$tArr['pIP']         = $data->pIP;
					$tArr['pData']       = $data->pData;
					
					if ( $dbWebStatics->addPageStaticsLogInfo( $tArr ) ) {
						return $this->_return ( true, 'OK', null );
					} else {
						return $this->_return ( false, 'failed', null );
					}
				} else {
					return $this->_return ( false, 'add data is failed!', null );
				}
			}else{
				return $this->_return ( false, 'Data Error', null );
			}
		}else{
			return parent::Unauthorized_User();
		}
	}
}
?>