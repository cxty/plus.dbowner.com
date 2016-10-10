<?php
/**
 *
 * 具体插件处理
 *
 * @author wbqing405@sina.com
 *
 */

//!DBOwner && header('location:/login/login?ident=manage');

class webStaticsMod extends commonMod {
	/**
	 * 页面流量统计
	 */
	public function index () {
		$this->assign('title', Lang::get('DBOwner'));

		$dbWebStatics = $this->getClass('DBWebStatics');
		$pagesize = 10;
		$listInfo = $dbWebStatics->getWebStaticsList('', $pagesize, $_GET['page']);
	
		$this->assign('listInfo', $listInfo['list']);
		$this->assign('showpage', $this->showpage('/code/webstatics?PlugInCode=webstatics&PlugInName='.$_GET['PlugInName'], $listInfo['count'], $pagesize, 5, 2));
	
		$this->display ('webStatics/index.html');
	}
	
	/**
	 * 增加
	 */
	public function addWebSite(){
		if($_GET['webStaticID']){
			$tArr['webStaticID'] = $_GET['webStaticID'];
			$dbWebStatics = $this->getClass('DBWebStatics');
			$listInfo = $dbWebStatics->getWebStaticsInfo($tArr);
			
			if(is_array($listInfo)){
				$listInfo[0]['webSiteCode'] = '<script src="' . ComFun::getShortUrl( $this->config['PLATFORM']['Analysis'].'/statics/js-'.$listInfo[0]['pStaticsCode'] ) . '" language="javascript" type="text/javascript"></script>';
			}
				
			$this->assign('listInfo', $listInfo[0]);
		}
		
		$this->display ('webStatics/addWebSite.html');
	}
	
	/**
	 * 生成网站随机码
	 */
	public function addWebSiteCode(){
		$staticsCode = md5(time().ComFun::getRandom());
		$cookies['staticsCode'] = $staticsCode;
		ComFun::SetCookies($cookies);
		echo ComFun::getShortUrl( $this->config['PLATFORM']['Analysis'].'/statics/js-'.$staticsCode );
	}
	
	/**
	 * 检验名称是否已经存在
	 */
	public function checkWebName(){
		$dbWebStatics = $this->getClass('DBWebStatics');
		echo $dbWebStatics->checkNameExist($_GET);
	}
	
	/**
	 * 增加记录
	 */
	public function subform(){
		$pWebName = trim($_GET['webName']);
		$staticsCode = ComFun::getCookies('staticsCode');
		if($pWebName == ''){
			echo json_encode(array('status' => false, 'msg' => Lang::get('Ex_NotEmptyWebName')));exit;
		}
		if($staticsCode == ''){
			echo json_encode(array('status' => false, 'msg' => Lang::get('Ex_ErrorParams')));exit;
		}
		
		$tArr['webStaticID']     = $_GET['webStaticID'];
		$tArr['pWebName']        = $pWebName;
		$tArr['pStaticsCode']    = $staticsCode;
		$dbWebStatics = $this->getClass('DBWebStatics');
		$rb = $dbWebStatics->doWebStatics($tArr);
		
		if($rb == 1){
			echo json_encode(array('status' => true, 'msg' => Lang::get('SuccessMandle')));exit;
		}elseif($rb == -3){
			echo json_encode(array('status' => false, 'msg' => Lang::get('WebStaticsExist')));exit;
		}else{
			echo json_encode(array('status' => false, 'msg' => Lang::get('SystemError')));exit;
		}		
	}
	
	/**
	 * 删除记录
	 */
	public function delWebStatics(){
		if($_GET['idStr']){
			$tArr['webStaticID'] = substr($_GET['idStr'], 1);
			$dbWebStatics = $this->getClass('DBWebStatics');
			$rb = $dbWebStatics->deleteWebStatics($tArr);
		}
	}
	
	/**
	 * 页面统计
	 */
	public function web(){
		$site_code = $_GET[0];

		$tArr['site_code'] = $site_code;
		$dbWebStaticsMongo = $this->getClass('DBWebStaticsMongo');
		$list = $dbWebStaticsMongo->getWebStaticData($tArr);
		
		$list['datetime'] = date('Y-m-d');
				
		if(is_array($list['retval'])){
			$list['site_name'] = $list['retval'][0]['site_code'];
			$list['site_href'] = '#';
		}else{
			$list['site_name'] = '';
			$list['site_href'] = '#';
			$list['retval'] = array();
		}
			
		$count_ip = 0;
		foreach($list['retval'] as $key=>$val){
			$tpArr = array();
			foreach($val['client_ip'] as $ke=>$va){
				if(!in_array($va, $tpArr)){
					array_push($tpArr, $va);
				}
			}
			$count_ip += count($tpArr);
			$list['retval'][$key]['count_ip'] = count($tpArr);
		}
		$list['count_ip'] = $count_ip;
			
		$pvArr = array();
		$ipArr = array();
			
		for($i=0;$i<24;$i++){
			$count_pv = 0;
			$count_ip = 0;
			foreach($list['retval'] as $key=>$val){
				if(intval($val['client_day']) == $i){
					$count_pv = $val['count_pv'];
					$count_ip = $val['count_ip'];
					break;
				}
			}
			array_push($pvArr, $count_pv);
			array_push($ipArr, $count_ip);
		}
		$list['pvArr'] = $pvArr;
		$list['ipArr'] = $ipArr;
		
		$list['site_text'] = Lang::get('BrowseAmount').'：'.$list['count'].'，'.Lang::get('IPAmount').'：'.$list['count_ip'];
			
		$dbWebStatics = $this->getClass('DBWebStatics');
		$list['webName'] = $dbWebStatics->getWebNameByStaticsCode($site_code);
		
		//ComFun::pr($list);
		
		$this->assign('udata', json_encode($list));
		$this->display('webStatics/webStatics.html');
	}
	
	/**
	 * 插件转向处理
	 */
	public function statics () {
		$code = $_GET['code'];
		$url = '';
		if ( $code ) {
			$tArr['anCode']       = $code;
			$tArr['access_token'] = ComFun::getCookies('access_token');
			$tArr['AppID']        = $this->config['oauth']['client_id'];
			
			$url = $this->config['PLATFORM']['Show'] . '/statics/web?code=' . DBPluginUniqueCode::getUniqueCode( array_merge($tArr,array('identCode' => $this->config['Expand']['identCode']['url'])) ) . '&' . http_build_query($tArr);
		}
		
		echo $url;
	}
}