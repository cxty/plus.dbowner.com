<?php
/**
 *
 * 前台处理
 *
 * @author wbqing405@sina.com
 *
 */

//!DBOwner && header('location:/login/login?ident=manage');

//header('location:/code');

class indexMod extends commonMod {
	/**
	 * index处理
	 */
	public function index() {
		$this->redirect('/code');exit;	
		ComFun::pr(ComFun::getCookies());exit;
		
		
		$this->display ('index/index.html'); //输出模板
	}
}
?>