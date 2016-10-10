<?php
/**
 * 网站浏览量插件管理
 *
 * @author wbqing405@sina.com
 */
class DBWebStatics{
	
	var $tbPageStaticsInfo = 'tbPageStaticsInfo'; //流量统计
	var $tbPageStaticsLogInfo = 'tbPageStaticsLogInfo'; //流量统计详情
	
	public function __construct($model){
		$this->model = $model;
	}
	/**
	 * 操作
	 */
	public function doWebStatics($fieldArr){
		if($this->checkNameExist($fieldArr) == 1){
			$_rb = -3;
		}else{
			if($fieldArr['webStaticID']){
				$_rb = $this->updateWebStatics($fieldArr);
			}else{
				$_rb = $this->addWebStatics($fieldArr);
			}
		}
		
		return $_rb;
	}
	/**
	 * 添加记录
	 */
	private function addWebStatics($fieldArr){
		try{
			$data['pWebName']     = $fieldArr['pWebName'];
			$data['pStaticsCode'] = $fieldArr['pStaticsCode'];
			$data['Status']       = 0;
			$data['AppendTime']   = time();
			$data['UpdateTime']   = time();
			
			$this->model->table($this->tbPageStaticsInfo)->data($data)->insert();
			
			return 1;
		}catch(Exception $e){
			return -1;
		}	
	}
	/**
	 * 更新记录
	 */
	private function updateWebStatics($fieldArr){
		try{
			$condition['AutoID'] = $fieldArr['webStaticID'];
			
			$data['pWebName']   = $fieldArr['pWebName'];
			$data['UpdateTime'] = time();
			
			$this->model->table($this->tbPageStaticsInfo)->data($data)->where($condition)->update();
			
			return 1;
		}catch(Exception $e){
			return -1;
		}
	}
	
	/**
	 * 更新访问次数
	 */
	public function updateWebStaticsCountByID ( $params ) {
		$da = false;
		try{
			$cond['AutoID'] = $params['AutoID'];
				
			$data['pCount'] = $params['pCount'];
				
			$this->model->table($this->tbPageStaticsInfo)->data($data)->where($cond)->update();
				
			return true;
		}catch(Exception $e){
			return $da;
		}
	}
	
	/**
	 * 标记删除记录
	 */
	public function deleteWebStatics($fieldArr){
		try{
			$where = 'AutoID in ('.$fieldArr['webStaticID'].')';
			
			$data['Status']     = 1;
			$data['UpdateTime'] = time();
			
			$this->model->table($this->tbPageStaticsInfo)->data($data)->where($where)->update();
			
			return 1;
		}catch(Exception $e){
			return -1;
		}
	}
	/**
	 * 检验名称是否已经存在
	 */
	public function checkNameExist($fieldArr){
		try{
			$where = 'pWebName = \''.$fieldArr['pWebName'].'\'';
			if($fieldArr['webStaticID']){
				$where .= ' and AutoID != \''.$fieldArr['webStaticID'].'\'';
			}
			
			if($this->model->table($this->tbPageStaticsInfo)->field('AutoID')->where($where)->select()){
				return 1;
			}else{
				return -2;
			}
		}catch(Exception $e){
			return -1;
		}
	}
	/**
	 * 选出指定记录
	 */
	public function getWebStaticsInfo($fieldArr=array()){
		try{
			$condition = array();
			if($fieldArr['webStaticID']){
				$condition['AutoID'] = $fieldArr['webStaticID'];
			}
			
			$field = 'AutoID as webStaticID,pWebName,pStaticsCode';
			
			return $this->model->table($this->tbPageStaticsInfo)->field($field)->where($condition)->select();
		}catch(Exception $e){
			return '';
		}
	}
	/**
	 * 通过唯一码选网址名称
	 */
	public function getWebNameByStaticsCode($pStaticsCode){
		try{
			$condition['pStaticsCode'] = $pStaticsCode;
	
			$_re = $this->model->table($this->tbPageStaticsInfo)->field('pWebName,pStaticsCode')->where($condition)->select();

			if($_re){
				return $_re[0]['pWebName'];
			}else{
				return '';
			}
		}catch(Exception $e){
			return '';
		}
	}
	
	/**
	 * 通过唯一码选网址名称
	 */
	public function getByStaticsCode ( $pStaticsCode ) {
		$da = array();
		try{
			$cond['pStaticsCode'] = $pStaticsCode;
	
			$_re = $this->model->table($this->tbPageStaticsInfo)->field('AutoID,pCount')->where($cond)->select();
			
			if($_re){
				return $_re[0];
			}else{
				return $da;
			}
		}catch(Exception $e){
			return $da;
		}
	}
	
	/**
	 * 取流量统计
	 */
	public function getPageStaticsInfo ( $params ) {
		$da = array();
		try{
			$field = '*';
			
			$where = '';
			if ( is_array($params) ) {
				
			} else {
				$where =  $params;
			}
			
			return $this->model->table($this->tbPageStaticsInfo)->field($field)->where($where)->select();
		}catch(Exception $e){
			return $da;
		}
	}
	
	/**
	 * 选记录列表
	 */
	public function getWebStaticsList($params, $pagesize=10, $page=1, $field='*'){
		try{
			$page = $page ? $page : 1;
			$limit = (($page - 1) * $pagesize) . ',' . $pagesize;
			
			if ( $field != '*' ) {
				$field = 'AutoID as webStaticID,pWebName,pStaticsCode,UpdateTime';
			}
			$order = 'UpdateTime desc';
			
			if ( is_array($params) ) {
				$where['Status'] = '0';
			} else {
				$where = 'Status = 0';
				$where .=  $params ? ' and ' . $params : '';
			}
		
			$count = $this->model->table($this->tbPageStaticsInfo)->field('AutoID')->where($where)->count();
			$list = $this->model->table($this->tbPageStaticsInfo)->field($field)->where($where)->order($order)->limit($limit)->select();
		
			return array (
					'count' => $count,
					'list' => $list
			);
		}catch(Exception $e){
			return array(
					'count' => 0,
					'list' => ''
					);
		}
	}
	
	
	/**
	 * 增加记录数据
	 */
	public function addPageStaticsLogInfo ( $params ) {
		$da = 0;
		try {
			$data['PGID']        = $params['PGID'];
			$data['pIP']         = $params['pIP'];
			$data['pData']       = $params['pData'];
			$data['pAppendTime'] = time();
			
			return $this->model->table($this->tbPageStaticsLogInfo)->data($data)->insert();
		} catch ( Exception $e ) {
			return $da;
		}
	}
	
	/**
	 * 取流量统计详情
	 */
	public function getPageStaticsLogInfo ( $params ) {
		$da = array();
		try{
			$field = '*';
				
			$where = '';
			if ( is_array($params) ) {
	
			} else {
				$where =  $params;
			}
				
			return $this->model->table($this->tbPageStaticsLogInfo)->field($field)->where($where)->select();
		}catch(Exception $e){
			return $da;
		}
	}
	
	/**
	 * 取流量统计详情列表
	 */
	public function getPageStaticsLogInfoList($where, $pagesize=10, $page=1, $field='*'){
		try{
			$page = $page ? $page : 1;
			$limit = (($page - 1) * $pagesize) . ',' . $pagesize;
				
			if ( $field != '*' ) {
				$field = '*';
			}
			$order = 'pAppendTime desc';
			
			$count = $this->model->table($this->tbPageStaticsLogInfo)->field('AutoID')->where($where)->count();
			$list = $this->model->table($this->tbPageStaticsLogInfo)->field($field)->where($where)->order($order)->limit($limit)->select();
	
			return array (
					'count' => $count,
					'list' => $list
			);
		}catch(Exception $e){
			return array(
					'count' => 0,
					'list' => ''
			);
		}
	}
}