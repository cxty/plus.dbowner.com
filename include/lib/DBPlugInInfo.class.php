<?php
/**
 * SOAP调用例子
*
* @author wbqing405@sina.com
*/

include_once('Addslashes.class.php'); //数据过滤类

class DBPlugInInfo {
	
	var $tbInviteCodeInfo = 'tbInviteCodeInfo';//邀请码
	
	public function __construct($model, $config){
		$this->model = $model;
		$this->config = $config;	

		$this->init();
	}
	/**
	 * 初始化ExpandSoap
	 */
	private function init(){
		include_once('DBextendSoap.class.php'); //soap类
		$this->config['DES']['ident'] = 'private';
		$this->DBextendSoap = new DBSoap();		
		$this->Addslashes = new Addslashes();
	}
	/**
	 * 增加邀请码
	 */
	public function addInviteCode($fieldArr){
		try{
			$AppInfoID = $fieldArr['AppInfoID'];
			$FUID      = $fieldArr['UserID'];
			
			if(empty($AppInfoID) || empty($FUID)){
				return false;
			}
			
			$InviteCode = self::getUniqueInviteCode();
			
			$data['AppInfoID']   = $AppInfoID;
			$data['InviteCode']  = $InviteCode;
			$data['FUID']        = $FUID;
			$data['iStatus']     = 0;
			$data['iAppendTime'] = time();

			return $this->model->table($this->tbInviteCodeInfo)->data($data)->insert();
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 增加邀请码
	 */
	public function addInviteCodeBack($fieldArr){
		try{
			$AppInfoID = $fieldArr['AppInfoID'];
			$FUID      = $fieldArr['UserID'];
				
			if(empty($AppInfoID) || empty($FUID)){
				return false;
			}
				
			$InviteCode = self::getUniqueInviteCode();
				
			$data['AppInfoID']   = $AppInfoID;
			$data['InviteCode']  = $InviteCode;
			$data['FUID']        = $FUID;
			$data['iStatus']     = 0;
			$data['iAppendTime'] = time();
	
			$this->model->table($this->tbInviteCodeInfo)->data($data)->insert();
			
			return $InviteCode;
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 取唯一激活码
	 */
	private function getUniqueInviteCode(){
		$inviteCode = ComFun::getTimeRandom(16);
		$tArr['InviteCode'] = $inviteCode;
		if($this->model->table($this->tbInviteCodeInfo)->field('InviteCodeID')->where($tArr)->select()){
			return self::getUniqueInviteCode($inviteCode);
		}else{
			return $inviteCode;
		}
	}
	/**
	 * 取当前登陆用户的相对应用扩展平台的应用ID
	 */
	public function getExpandUserID(){
		$tArr['UserID'] = ComFun::getCookies('UserID');
		$tArr['client_id'] = $this->config['DB']['Plus']['PlugInAppID'];
		
		$re = $this->DBextendSoap->SelectTableInfo('Auth','SelectUserIDWithAppID',$tArr);
		
		if(isset($re['data'])){
			return $re['data'];
		}else{
			return null;
		}
	}
	/**
	 * 获取插件列表
	 */
	public function getPlugInList($condition='', $pagesize=10, $page=1, $order=''){
		/*
		if($condition){
			$condition .= ' and UserID = \''.$this->getExpandUserID().'\'';
		}else{
			$condition = ' UserID = \''.$this->getExpandUserID().'\'';
		}
*/
		
		$appList = $this->DBextendSoap->GetTableList('Expand', 'GetAppPlugInInfoList', $page, $pagesize, $condition, $order);
		
		if(isset($appList['data'])){
			return $appList['data'];
		}else{
			return null;
		}
	}
	/**
	 * 取用户对应应用的所有记录
	 */
	public function getInviteCodeInfo($fieldArr){
		try{
			$condition['AppInfoID'] = $fieldArr['client_id'];
			$condition['FUID'] = $fieldArr['user_id'];

			return $this->model->table($this->tbInviteCodeInfo)->field('InviteCodeID,InviteCode,TUID')->where($condition)->select();
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 取邀请码列表
	 */
	public function getInviteCodeList($fieldArr, $pagesize=10, $page=1){
		try{
			$page = $page ? $page : 1;
			$limit = (($page - 1) * $pagesize) . ',' . $pagesize;
			
			$condition = '';
			$field = 'InviteCodeID,AppInfoID,InviteCode,FUID,TUID,iAppendTime,iUseTime';
			$order = 'iUseTime desc,iAppendTime desc';//'AppInfoID asc,TUID asc,iAppendTime desc';
			// 获取行数
			$count = $this->model->table($this->tbInviteCodeInfo)->field('InviteCodeID')->where($condition)->count();
			$list = $this->model->table($this->tbInviteCodeInfo)->field($field)->where($condition)->order($order)->limit($limit)->select();
			
			if($list){
				$listInfo = $list;
			}else{
				$listInfo = null;
			}
			return array (
					'count' => $count,
					'list' => $listInfo
			);
		}catch(Exception $e){
			return array(
					'count' => 0,
					'list' => null
					);
		}
	}
	/**
	 * 取用户user_id对应的用户名
	 */
	public function getUserNameInfoByUserID($ListID){		
		$tArr['ListID'] = $ListID;
	
		$appList = $this->DBextendSoap->SelectTableInfo('Auth', 'SelectUserNameByUserID', $tArr, '', false);
	
		if(isset($appList['data'])){
			return $appList['data'];
		}else{
			return null;
		}
	}
	/**
	 * 删除邀请码
	 */
	public function doDelInviteCode($inviteCode){
		try{
			$where = 'InviteCodeID in ('.$inviteCode.')';
			
			return $this->model->table($this->tbInviteCodeInfo)->where($where)->delete();
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 验证用户是否已经输入过邀请码
	 */
	public function checkUserHadInviteCode($fieldArr){
		try{
			$condition['AppInfoID'] = $fieldArr['client_id'];
			$condition['TUID'] = $fieldArr['user_id'];
			
			if($this->model->table($this->tbInviteCodeInfo)->field('InviteCodeID')->where($condition)->select()){
				return true;
			}else{
				return false;
			}
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 用户输入邀请码进行激活动作处理
	 */
	public function activeInviteCode($fieldArr){
		try{
			$condition['InviteCode'] = $fieldArr['InviteCode'];
			$condition['AppInfoID']  = $fieldArr['client_id'];

			$rb = $this->model->table($this->tbInviteCodeInfo)->field('TUID')->where($condition)->select();

			if($rb){
				if(!empty($rb[0]['TUID'])){
					return -2; //邀请码已经被使用
				}
			}else{
				return -1; //邀请码不存在
			}

			$data['TUID']       = $fieldArr['user_id'];
			$data['iUseTime']   = time();
			
			$this->model->table($this->tbInviteCodeInfo)->data($data)->where($condition)->update();

			return 1;
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 
	 */
	public function getAppIDByInviteCode($fieldArr){
		try{
			$condition['InviteCode'] = $fieldArr['InviteCode'];
			
			$_re = $this->model->table($this->tbInviteCodeInfo)->field('AppInfoID')->where($condition)->select();
			
			if($_re){
				return $_re[0]['AppInfoID'];
			}else{
				return false;
			}
		}catch(Exception $e){
			return false;
		}
	}
}