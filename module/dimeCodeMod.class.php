<?php
/**
 *
 * 具体插件处理
 *
 * @author wbqing405@sina.com
 *
 */
class dimeCodeMod extends commonMod {
	/**
	 * 二维码
	 */
	public function index () {
		$this->assign('title', Lang::get('DBOwner'));
	
		$dbQRCode = $this->getClass('DBQRCode');
		//$dbQRCode->getQRCode('');
		//exit;
		$this->display ('dimeCode/index.html');
	}
}