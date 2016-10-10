<?php
/**
 *
 * 具体插件处理
 *
 * @author wbqing405@sina.com
 *
 */

//!DBOwner && header('location:/login/login?ident=manage');

class codeMod extends commonMod {
	/**
	 * index处理
	 */
	public function index() {	
		$this->assign('title', Lang::get('DBOwner'));
		$dbPlugInInfo = $this->getClass('DBPlugInInfo');	
		$pagesize = 10;
		//旧的刷选方法 $condition = 'PlugInTypeID in '.$this->config['DB']['Plus']['InternalPlugIn'].' or AppPlugInID in ' . $this->config['DB']['Plus']['AppPlugInID'];
		$condition = 'pInside = 1';
		$listInfo = $dbPlugInInfo->getPlugInList($condition, $pagesize, $_GET['page']);
//ComFun::pr($listInfo);exit;
		if($listInfo['list']){
			foreach($listInfo['list'] as $key=>$val){
				if($val['pIcoCode']){
					$pIcoCodeArr = explode('|', $val['pIcoCode']);
					if(is_array($pIcoCodeArr)){
						foreach($pIcoCodeArr as $ke=>$va){
							$pICArr = explode(',',$va);
							$listInfo['list'][$key]['pIcoCode_'.$pICArr[1]] = $this->config['FILE_SERVER_GET'].'&filecode='.$pICArr[0].'&w='.$pICArr[1];
						}
					}						
				}
			}
		}

		$this->assign('listInfo',$listInfo['list']);
		$this->assign('showpage',$this->showpage('/code',$listInfo['count'], $pagesize, 5, 1));
		$this->display ('code/code.html'); 
	}
	
	/**
	 * 框架页面
	 */
	public function main () {
		$this->assign('title', Lang::get('DBOwner'));
		
		$this->assign('cdata', array(
					'name' => $_GET['name'],
					'code' => $_GET['code']
				));
		
		$this->display ('code/main.html');
	}	
}
?>