<?php
/**
 * 
 * @author wbqing405@sina.com	
 * 
 * 邀请码信息提示处理
 *
 */

include_once('Addslashes.class.php'); //数据过滤类

class DBInviteCodeLangState{
	
	var $tbInviteCodeLangClassInfo = 'tbInviteCodeLangClassInfo'; //信息提示语言类别
	var $tbInviteCodeLangInfo = 'tbInviteCodeLangInfo'; //信息提示语言
	
	public function __construct($model){
		$this->model = $model;
		
		$this->init();
	}
	/**
	 * 初始化
	 */
	public function init(){
		$this->Addslashes = new Addslashes();
	}
	/**
	 * 增加信息提示类别 
	 */
	public function addMultLangClass($fieldArr){
		try{
			$fieldArr = $this->Addslashes->get_addslashes($fieldArr);

			if(is_array($fieldArr['LangName'])){
				foreach($fieldArr['LangName'] as $key=>$val){
					if ( $val && $fieldArr['LangCode'][$key] ) {
						$data['LangName'] = $val;
						$data['LangCode'] = $fieldArr['LangCode'][$key];
						
						if(!$this->checkLangClassRepeat($data)){
							$data['AppendTime'] = time();
						
							$this->model->table($this->tbInviteCodeLangClassInfo)->data($data)->insert();
						}	
					}
				}
			}
			
			return true;
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 判断类别是否已经存在
	 */
	public function checkLangClassRepeat($fieldArr){
		try{
			$condition['LangCode'] = $fieldArr['LangCode'];
			
			if($this->model->table($this->tbInviteCodeLangClassInfo)->field('LangClassID')->where($condition)->select()){
				return true;
			}else{
				return false;
			}
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 取信息提示信息类别
	 */
	public function getLangClassInfo(){
		try{
			return $this->model->table($this->tbInviteCodeLangClassInfo)->field('LangClassID,LangName,LangCode')->select();
		}catch(Exception $e){
			return null;
		}
	}
	/**
	 * 删除语言信息提示信息类别
	 */
	public function deleteInviteCodeClass($LangClassID){
		try{
			$condition['LangClassID'] = $this->Addslashes->do_addslashes($LangClassID);
			
			$this->model->table($this->tbInviteCodeLangClassInfo)->where($condition)->delete();
			
			return true;
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 增加语言提示信息
	 */
	public function addMultLangMessage($fieldArr){
		try{
			$fieldArr = $this->Addslashes->get_addslashes($fieldArr);
			
			if($fieldArr['LangID']){
				$fieldArr['radio'] = -1;
			}else{
				$fieldArr['radio'] = $fieldArr['radio'] - $fieldArr['listCount'];
			}

			$i = 1;
			if($fieldArr['langStr']){
				$langArr = explode(',', substr($fieldArr['langStr'], 1));
				
				if(is_array($fieldArr[$langArr[0].'_state'])){
					$checked = 0;
					foreach($fieldArr[$langArr[0].'_state'] as $key=>$val){
						if(intval($fieldArr['radio']) == $key){
							$checked = 1;
						}else{
							$checked = 0;
						}
						
						//必须同一组说明不能为空才增加这组提示语言
						$add = true;
						foreach($langArr as $key2=>$val2){
							if($fieldArr[$val2.'_state'][$key]){
								$add = true;
							}else{
								$add = false;
								break;
							}
						}						
						if($add){
							if($i == 1 && !$fieldArr['LangID']){
								$this->updateLangDefaultStatus();
							}
							$i++;
							foreach($langArr as $key3=>$val3){
								$data['LangBelong']  = $key+$fieldArr['listCount'];
								$data['LangType']    = $val3;
								$data['LangState']   = $fieldArr[$val3.'_state'][$key];
								$data['LangStatus']  = $checked;
								$data['AppendTime']  = time();

								$this->model->table($this->tbInviteCodeLangInfo)->data($data)->insert();
							}	
						}
					}
				}	
			}	
			
			unset($condition);
			unset($data);
			
			$condtion['LangStatus'] = 1;
			
			if(!$this->model->table($this->tbInviteCodeLangInfo)->field('LangID')->where($condtion)->select()){
				$rb = $this->getLangBelongList();
	
				if($rb){
					unset($condition);
					unset($data);
					
					$condition['LangBelong'] = $rb['LangBelong'];
					
					$data['LangStatus'] = 1;
					
					$this->model->table($this->tbInviteCodeLangInfo)->data($data)->where($condition)->update();
				}
			}
			
			return true;
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 更新语言提示信息的默认组
	 */
	private function updateLangDefaultStatus(){
		try{
			$condition['LangStatus'] = 1;
			$data['LangStatus'] = 0;
				
			$this->model->table($this->tbInviteCodeLangInfo)->data($data)->where($condition)->update();
		
			return true;
		}catch(Exception $e){
			return false;
		}
	}
	/**
	 * 更新语言提示信息为默认选择选
	 */
	public function updateInviteCodeStatus($LangIDStr){
		try{
			$this->updateLangDefaultStatus();
			
			$where = 'LangID in ('.substr($LangIDStr, 1).')';
			$data['LangStatus'] = 1;
			
			$this->model->table($this->tbInviteCodeLangInfo)->data($data)->where($where)->update();
			return true;
		}catch(Exception $e){
			return false;
		}	
	}
	/**
	 * 取语言提示信息类别
	 */
	public function getLangInfo(){
		try{
			return $this->model->table($this->tbInviteCodeLangInfo)->field('LangID,LangBelong,LangType,LangState,LangStatus')->select();
		}catch(Exception $e){
			return null;
		}
	}
	/**
	 * 取语言提示信息分组列表
	 */
	public function getLangBelongList(){
		try{
			return $this->model->table($this->tbInviteCodeLangInfo)->field('LangBelong,LangStatus')->group('LangBelong')->select();	
		}catch(Exception $e){
			return null;
		}
	}
	/**
	 * 取语言提示信息列表
	 */
	public function getLangList(){
		$langList = $this->getLangInfo();	
		$groupList = $this->getLangBelongList();

		$nLangList = '';
		$checked = 0;
		$LangID = '';
		if(is_array($groupList)){
			foreach($groupList as $key=>$val){
				foreach($langList as $key2=>$val2){
					if($val['LangStatus'] == 1 && $val['LangBelong'] == $val2['LangBelong']){
						$checked = $key;
						$LangID .= ','.$val2['LangID'];
					}
					if($val['LangBelong'] == $val2['LangBelong']){
						$nLangList[$val['LangBelong']][$val2['LangType']]['LangID']    = $val2['LangID'];
						$nLangList[$val['LangBelong']][$val2['LangType']]['LangState'] = $val2['LangState'];
					}
				}
			}
		}

		$re['radio']['checked'] = $checked;
		$re['radio']['LangID']  = $LangID;
		$re['list']    = $nLangList;

		return $re;
	}
	/**
	 * 删除信息提示语言
	 */
	public function deleteInviteCodeLang($LangID){
		try{
			$LangID = $this->Addslashes->do_addslashes($LangID);
			
			if($LangID){
				$LangID = substr($LangID, 1);
			}else{
				$LangID = '';
			}
			
			$where = 'LangID in ('.$LangID.')';

			$this->model->table($this->tbInviteCodeLangInfo)->where($where)->delete();
			
			return true;
		}catch(Exception $e){
			return false;
		}
	}
}