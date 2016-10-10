<?php
/**
 *
 * CURL处理D币
 *
 * @author wbqing405@sina.com
 *
 */
class testMod extends commonMod {
	public function test(){
		//ComFun::pr(ComFun::getCookies());exit;
		exit;
		$url = ComFun::getShortUrl( 'http://analysis.dbowner.com/statics/js-872520fc1fb9775df93e09e365b1dd9e' );
		ComFun::pr($url);
		exit;
		$appid = '80002001';
		
		$code = ComFun::__encrypt($appid);
		
		echo '<br />';
		
		echo $code;
		
		echo '<br />';
		
		echo ComFun::__decrypt($code);
		
		exit;
		
		//echo ComFun::getTimeRandom(16);exit;
		
		echo ComFun::getRandom(32);
		exit;
		echo phpinfo();exit;
		$DBOCache = new DBOCache(array(), 'Memcache');
		
	}
	public function server(){
		exit;
		include(dirname(dirname(__FILE__)).'/include/api/DBOwnerPay.php');
		$DBOwnerPay = new DBOwnerPay();
		$info = $DBOwnerPay->SelectUserInfo('aaaa');
		ComFun::pr($info);
	}
	public function soap(){
		//exit;
		//header('content-type:text/html;charset=utf-8');
		$type = 'tPlus';
		$tableName = 'PageStaticsLogInfo';
		$condition = '';
		$DBSoap = new DBSoap();
		
		echo '==========table=========<br>';
		echo $tableName;
		
		echo '<br>=========insert=========<br>';
// 		$idata['UserID'] = ComFun::getCookies('UserID');
// 		$idata['uName'] = '吴本清844';
// 		$ire = $DBSoap->InsertTableInfo($type, 'Insert'.$tableName, $idata);
// 		ComFun::pr($ire);
//  		exit;
		
		echo '<br>=========update=========<br>';
		//UpdateUserInfo
// 		$udata['UID'] = 7;
// 		$udata['uState'] = 2;
// 		$ure = $DBSoap->UpdateTableInfo($type, 'Update'.$tableName, $udata);
// 		ComFun::pr($ure);
// 		exit;

		echo '<br>=========Delete=========<br>';
// 		$ddata['UID'] = 3;
// 		$ure = $DBSoap->DeleteTableInfo($type, 'Delete'.$tableName, $ddata);
// 		ComFun::pr($ure);
// 		exit;
		
		echo '<br>==========select==========<br>';
  		$where = "PGID = 1";
// 		$sre = $DBSoap->SelectTableInfo($type, 'Select'.$tableName, $where);
// 		ComFun::pr($sre);
		
// 		exit;
		
		echo '<br>==========list==========<br>';
		$page=1; 
		$pagesize=20;
		$lre = $DBSoap->GetTableList($type, 'Get'.$tableName.'List', $page, $pagesize, $where);
		ComFun::pr($lre);
		exit;	

		
		echo '<br>==========get==========<br>';
		$type = 'plus';
		$tArr['pStaticsCode'] = '7a80d5378df718c55c06dbc23629f879';
		$tArr['pIP'] = ComFun::getIP();
		$tArr['pData'] = json_encode($_SERVER);
		ComFun::pr($tArr);
		$gre = $DBSoap->GetTableInfo($type, 'GetPageStaticsLogInfo', $tArr);
		ComFun::pr($gre);
		echo date('Y-m-d H:i:s', '1386080923');
		echo '<br>';
		echo date('Y-m-d H:i:s', '1386656923');
		echo '<br>';
		echo date('Y-m-d H:i:s', '1386302038');
	}
	public function curl(){
		exit;
		$url = $this->config['PLATFORM']['Secret'];
		//$url .= '/authcode/getCoinRandomCode';
		$url .= '/authcode/decryptCoinRandom';
		
		$tArr['code']        = 'OGxiSUF5Z3VqaURFVzcxdWhGS1R5NnVSOEtwZ25mVUtUK0dMUFBsMEoraDlITHdCdmJncUNBdXZrTFFjcnJGLzVvZXRVMUl5SGd3PQ%3D%3D';
		$tArr['UserID']      = 1;
		$tArr['serialCode']  = '20130516125250968536000042080817';
		$tArr['coin']        = 300;
		$tArr['type']        = 3;
		$tArr['AppendTime']  = '1368679970';
		
		// 		$url .= '?'.http_build_query($tArr);
		// 		echo $url;
		$re = DBCurl::dbGet($url, 'get', $tArr);
		ComFun::pr($re);
		exit;
		$url = 'http://tpay.dbowner.com';
		$url .= '/coin/earn';

		$tArr['access_token']   = ComFun::getCookies('access_token');
		$tArr['IdentCode']      = 'eTNBSUkzT1YxOXc9';
		$tArr['platform']       = '004';
		$tArr['message']        = '测试';
		$tArr['db']             = 300;
		
		//echo $url.'?'.http_build_query($tArr);exit;
		
		$re = DBCurl::dbGet($url, 'get', $tArr);
		
		ComFun::pr($re);
	}
}