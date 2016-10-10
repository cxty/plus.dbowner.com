<?php 
/**
 * soap调用接口
 * @author wbqing405@sina.com
 *
 */
class soapMod {	
	/**
	 * 调用扩展接口
	 */
	public function plugInSoap(){	
		include_once(dirname(dirname(__FILE__)).'/include/api/ManagePlugIn.php');
		ini_set("soap.wsdl_cache_enabled", "0");
		$server=new SoapServer(dirname(dirname(__FILE__)).'/Interface/ManagePlugIn.wsdl',
						array('soap_version' => SOAP_1_2,'encoding'=>'utf-8'));
		$server->setClass('ManagePlugIn');
		$server->handle();
	}
}

// Server.php
// include_once(dirname(__FILE__).'/include/api/ManageExtend.php');
// $server=new SoapServer('http://exp.dbowner.com/Interface/ManageExtend.wsdl',array('uri' => "abcd"));
// $server->setClass("ManageExtend");
// $server->handle();
?>