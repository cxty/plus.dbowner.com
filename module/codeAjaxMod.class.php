<?php
/**
 *
 * 具体插件处理
 *
 * @author wbqing405@sina.com
 *
 */

//!DBOwner && header('location:/login/login?ident=manage');

class codeAjaxMod extends commonMod {
	/**
	 * 增加邀请码前
	 */
	public function preAddInviteCode(){
		$this->display ('inviteCode/addInviteCode.html');
	}
	/**
	 * 增加邀请码
	 */
	public function addInviteCode(){
		ComFun::pr($_GET);
		$AppInfoID = $_GET['AppInfoID'];
		if($AppInfoID){
			$tArr['AppInfoID'] = $AppInfoID;
			$tArr['UserID']    = ComFun::getCookies('UserID');
			
			$dbPlugInInfo = $this->getClass('DBPlugInInfo');
			if($dbPlugInInfo->addInviteCode($tArr)){
				echo 1;
			}else{
				echo -1;
			}
		}else{
			echo -1;
		}	
	}
	/**
	 * 删除邀请码
	 */
	public function delInviteCode(){
		$idStr = $_GET['idStr'];
		if($idStr){
			$idArr = explode('|', $idStr);
			foreach($idArr as $val){
				if($val){
					$inviCodeID .= ','.$val;
				}
			}
			$dbPlugInInfo = $this->getClass('DBPlugInInfo');
			$dbPlugInInfo->doDelInviteCode(substr($inviCodeID, 1));
		}
	}
	/**
	 * 语言提示信息类别
	 */
	public function addInviteCodeClass(){
		$dbInviteCodeLangState = $this->getClass('DBInviteCodeLangState');
		$dbInviteCodeLangState->addMultLangClass($_POST);
		
		$this->redirect('/inviteCode?PlugInCode='.$_POST['PlugInCode'].'&PlugInName='.$_POST['PlugInName'].'&view='.$_POST['view']);
	}
	/**
	 * 删除语言信息提示信息类别
	 */
	public function delInviteCodeClass(){
		$dbInviteCodeLangState = $this->getClass('DBInviteCodeLangState');
		$dbInviteCodeLangState->deleteInviteCodeClass($_GET['LangClassID']);
	}
	/**
	 * 增加语言信息
	 */
	public function addInviteCodeLang(){
		$dbInviteCodeLangState = $this->getClass('DBInviteCodeLangState');
		$dbInviteCodeLangState->addMultLangMessage($_POST);

		$this->redirect('/inviteCode?PlugInCode='.$_POST['PlugInCode'].'&PlugInName='.$_POST['PlugInName'].'&view='.$_POST['view']);
	}
	/**
	 * 删除语言信息提示信息
	 */
	public function delInviteCodeLang(){
		$dbInviteCodeLangState = $this->getClass('DBInviteCodeLangState');
		$dbInviteCodeLangState->deleteInviteCodeLang($_GET['LangIDStr']);
	}
	/**
	 * 更新语言信息状态
	 */
	public function changeInviteCodeStatus(){
		if($_GET['LangIDStr']){
			$dbInviteCodeLangState = $this->getClass('DBInviteCodeLangState');
			$dbInviteCodeLangState->updateInviteCodeStatus($_GET['LangIDStr']);
		}	
	}
}