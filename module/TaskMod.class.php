<?php 
class TaskMod extends commonMod {
	
	public function index() {	
		echo "<script language=javascript>window.location='http://task.dbowner.com/DBOwnerlogin'</script>";
		}
    //发布计划任务
	public function URLTask(){
		//获取参数信息
		$access_token = $_GET['access_token'] ? $_GET['access_token'] : $_POST['access_token'];
		$TaskName= $_GET['TaskName'] ? $_GET['TaskName'] : $_POST['TaskName'];
		$Act_URL= $_GET['Act_URL'] ? $_GET['Act_URL'] : $_POST['Act_URL'];
		$Act_Time = $_GET['Act_Time'] ? $_GET['Act_Time'] : $_POST['Act_Time'];
		$Act_Count = $_GET['Act_Count'] ? $_GET['Act_Count'] : $_POST['Act_Count'];
		$Act_Email =  $_GET['Act_Email'] ? $_GET['Act_Email'] : $_POST['Act_Email'];
		$Act_Start = $_GET['Act_Start'] ? $_GET['Act_Start'] : $_POST['Act_Start'];
		$Act_End  = $_GET['Act_Start'] ? $_GET['Act_Start'] : $_POST['Act_Start'];
		
		//通过soap接口转入Task服务
		
		$requesturl='http://task.dbowner.com/soap/URLTask';
		$tArr['access_token'] =$access_token ;
		$tArr['TaskName'] =$TaskName ;
		$tArr['Act_URL'] =$Act_URL ;
		$tArr['Act_Time'] =$Act_Time ;
		$tArr['Act_Count'] =$Act_Count ;
		$tArr['Act_Email'] =$Act_Email ;
		$tArr['Act_Start'] =$Act_Start ;
		$tArr['Act_End'] =$Act_End ;
		
		$result= DBCurl::dbGet($requesturl, 'POST', $tArr);
		echo json_encode($result);
	} 
    
}	
?>