<?php
/**
 *
 * 错误处理
 *
 * @author wbqing405@sina.com
 *
 */
class throwMessageMod extends commonMod{
	/**
	 * 错误提示
	 */
	public function throwMsg(){
		$msgkey = $_GET['msgkey'] ? $_GET['msgkey'] : 'Ex_UnknowError';
		$tt     = $_GET['tt'] ? $_GET['tt'] : '1'; //是否跳转 1默认 2不跳转

		$msgArr['appshow'] = false;
		if($tt == 2){
			$msgArr['urlTurn'] = '';
		}else{
			$msgArr['urlTurn'] = '/code';
		}
		$msgArr['url']     = '/code';
		$msgArr['retry']   = $_SERVER['REQUEST_URI'];
		$msgArr['msg']     = Lang::get($msgkey);
		
		$this->assign('msgArr',$msgArr);
		$this->display('throwMessage/message.html');
	}
	/**
	 * 调用框架错误提示
	 */
	public function throwError(){
		$msgkey = $_GET['msgkey'] ? $_GET['msgkey'] : 'Ex_UnknowError';
		
		echo '<div style="text-align:center;margin-top:20px;">'.Lang::get($msgkey).'</div>';
	}
}