<?php
/**
 * 网站浏览量插件管理
 *
 * @author wbqing405@sina.com
 */
class DBWebStaticsMongo{
	
	var $tbWebStaticsInfo = 'tbWebStaticsInfo'; //页面采集信息
	
	public function __construct($mongo_model){
		$this->mongo_model = $mongo_model;
	}
	/**
	 * 页面统计数据
	 */
	public function getWebStaticData($fieldArr){
		try{
			$site_code = $fieldArr['site_code'];
			
			$keys = new MongoCode('function(doc){
					var d = new Date(parseInt(doc.append_time) * 1000);
					s = d.getFullYear() + "-";
					s += ("0"+(d.getMonth()+1)).slice(-2) + "-";
					s += ("0"+d.getDate()).slice(-2);
						
					ss = ("0"+d.getHours()).slice(-2);
						
					return {append_time:s, client_day:ss, site_code:doc.site_code}
				}');
				
				
			$initial = array("client_ip" => array(), "record_code" => array(), "day_time" => array(), "client_host" => array(), "count_pv" => 0);
				
			$reduce = new MongoCode('function (obj, prev) {
					var d = new Date(parseInt(obj.append_time) * 1000);
					s = d.getFullYear() + "-";
					s += ("0"+(d.getMonth()+1)).slice(-2) + "-";
					s += ("0"+d.getDate()).slice(-2) + " ";
					s += ("0"+d.getHours()).slice(-2) + ":";
					s += ("0"+d.getMinutes()).slice(-2) + ":";
					s += ("0"+d.getSeconds()).slice(-2);
						
					prev.client_ip.push(obj.client_ip);
					prev.record_code.push(obj.record_code);
					prev.day_time.push(obj.append_time);
					prev.client_host.push(obj.client_host);
					prev.count_pv++;
				}');
				
			$datetime = date('Y-m-d');
				
			$condition = array(
						"append_time" => array( 
									'$gt' => strtotime($datetime.' 00:00:00'), 
									'$lt' => strtotime($datetime.' 23:59:59')
								), 
						'site_code' => $site_code
					);
			
			return $this->mongo_model->table($this->tbWebStaticsInfo)->group($keys, $initial, $reduce, $condition);
		}catch(Exception $e){
			return '';
		}
	}
}