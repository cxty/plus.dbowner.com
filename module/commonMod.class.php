<?php
//公共模块
class commonMod {
	public $model; //数据库模型对象
	public $tpl; //模板对象
	public $config; //全局配置
	static $global; //静态变量，用来实现单例模式
	public function __construct() {	
		global $config;
		$this->config = $config; //配置

		//数据库模型初始化
		if (! isset ( self::$global ['model'] )) {
			self::$global ['model'] = new DBOModel ( $this->config ); //实例化数据库模型类 
		}
		$this->model = self::$global ['model']; //数据库模型对象

		//MongoDB数据库初始化
		if (! isset ( self::$global ['mongo_model'] )) {
			//require_once(DBO_PATH . 'core/db/mongodb.class.php');
			//require_once(DBO_PATH . 'core/DBOMongo.class.php');
			self::$global ['mongo_model'] = new DBOMongo ( $this->config ); //实例化数据库模型类
		}
		$this->mongo_model = self::$global ['mongo_model']; //数据库模型对象
		
		//LANG::init();
		//模板初始化
		//if (! isset ( self::$global ['tpl'] )) {
		//	self::$global ['tpl'] = new DBOTemplate ( $this->config ); //实例化模板类 
		//}
		//加载并实例化smarty类  
        if (! (file_exists($this->config['SMARTY_TEMPLATE_DIR']) && is_dir($this->config['SMARTY_TEMPLATE_DIR'])) ) {
            mkdir($this->config['SMARTY_TEMPLATE_DIR'], 0755, true);
        }
        if (! (file_exists($this->config['SMARTY_COMPILE_DIR']) && is_dir($this->config['SMARTY_COMPILE_DIR'])) ) {
            mkdir($this->config['SMARTY_COMPILE_DIR'], 0755, true);
        }
        if (! (file_exists($this->config['SMARTY_CACHE_DIR']) && is_dir($this->config['SMARTY_CACHE_DIR'])) ) {
            mkdir($this->config['SMARTY_CACHE_DIR'], 0755, true);
        }
        require_once(DBO_PATH . 'ext/smarty/Smarty.class.php');    

        $smarty                 =   new Smarty();         
        $smarty->debugging      =   $this->config['SMARTY_DEBUGGING'];              
        $smarty->caching        =   $this->config['SMARTY_CACHING'];              
        $smarty->cache_lifetime =   $this->config['SMARTY_CACHE_LIFETIME'];
        $smarty->template_dir   =   $this->config['SMARTY_TEMPLATE_DIR'];           
        $smarty->compile_dir    =   $this->config['SMARTY_COMPILE_DIR'];      
        $smarty->cache_dir      =   $this->config['SMARTY_CACHE_DIR'];   
        $smarty->left_delimiter =   $this->config['SMARTY_LEFT_DELIMITER'];
        $smarty->right_delimiter=   $this->config['SMARTY_RIGHT_DELIMITER'];
         
        self::$global['tpl']    =   $smarty;
		
		$this->tpl = self::$global ['tpl']; //模板类对象
		
		Lang::init();
		
		//语言包
		$this->assign(Lang,Lang::getPack());
		$this->assign(JS_LANG,json_encode(Lang::getPack()));
		
		//加载静态处理通用类
		include(dirname(dirname(__FILE__)).'/include/lib/ComFun.class.php');
				
		//初始化全局变量
		$this->init();
		
		//$this->checkPlugIn();
	}
	/**
	 * 判断是否需要登录
	 */
	private function init(){
		$this->commonOAuth2 = $this->getClass('CommonOAuth2');
		
		$ckInfo['p_pay'] = $this->config['PLATFORM']['Pay'];
		
		if ( !in_array( $_GET['_module'], $this->config['NoNeedLogin'] ) ) {
			$this->redirect('/login/login?dbo=' . ComFun::getCallback() );
		} else {
			if ( $_COOKIE['UserID'] ) {
				//没有权限查看页面
				if ( !in_array($_GET['_module'] , array('login','throwMessage')) && !$_COOKIE['invalid'] ) {
					$this->redirect('/throwMessage/throwMsg?tt=2&msgkey=Ex_UnVailid');
				}
					
				//验证个人中心登录者
				$_re = $this->commonOAuth2->api_istimeout();
			
				if ( $_re['error'] ) {
					ComFun::destoryCookies();
					$this->redirect('/login/login?dbo=' . ComFun::getCallback() );
				}
			
				$ckInfo['uName']   = ComFun::getCookies('uName');
				$ckInfo['uType']   = ComFun::getCookies('uType');
				$ckInfo['uNumber'] = ComFun::getCookies('uNumber');
				$ckInfo['ico']     = ComFun::getCookies('ico');
				$ckInfo['account'] = ComFun::getCookies('account');
				$ckInfo['UserID']  = true;
				$ckInfo['Ads']     = $this->config['PLATFORM']['Ad'];
				$ckInfo['Union']   = $this->config['PLATFORM']['Union'];
			}
		}
		
		$this->assign('ckInfo', $ckInfo);
		
		$this->assign('_module',$_GET['_module']);
		$this->assign('_action',$_GET['_action']);
		
		$urlArr['dbback'] = $_SERVER['QUERY_STRING'] ? (strtolower(__ROOT__).'?'.$_SERVER['QUERY_STRING']) : strtolower(__ROOT__);
		
		$this->redirect = ComFun::makeCallBack($urlArr);
		$this->assign('redirect',$this->redirect);
	}
	/**
	 * 插件详情处理
	 */
	protected function checkPlugIn(){
		if($_GET['_module'] == 'code' && !in_array($_GET['_action'], $this->config['DB']['Plus']['PlugIn'])){
			$this->redirect('/throwMessage/throwMsg?msgkey=Ex_NoExistPlugIn');
		}
	}
	//模板变量解析
	protected function assign($name, $value) {
		return $this->tpl->assign ( $name, $value );
		
	}
	//模板输出
	protected function display($tpl = '') {
		//return $this->tpl->display ( $tpl );
		//在模板中使用定义的常量,使用方式如{$__ROOT__} {$__APP__}
        $this->assign("__ROOT__",__ROOT__);
        $this->assign("__BASE__",__ROOT__.'/index.php');
        $this->assign("__APP__",__APP__);
        $this->assign("__URL__",__URL__);
        $this->assign("__PUBLIC__",__PUBLIC__);
        
        //实现不加参数时，自动加载相应的模板
        $tpl=empty($tpl)?$_GET['_module'].'/'.$_GET['_action'].$this->config['TPL_TEMPLATE_SUFFIX'] : $tpl;     
        return $this->tpl->display($tpl); 
	}
	
	//直接跳转
	protected function redirect($url) {
		header ( 'location:' . $url, false, 301 );
		exit ();
	}
	
	//出错之后跳转，后退到前一页
	protected function error($msg) {
		header ( "Content-type: text/html; charset=utf-8" );
		$msg = "alert('$msg');";
		echo "<script>$msg history.go(-1);</script>";
		exit ();
	}
	/**
	 * 分页
	 */
	protected function showpage($url, $total, $perpage = 10, $pagebarnum = 5, $mode = 1){
		$page = new ShowPage();
		return $page->show($url, $total, $perpage, $pagebarnum, $mode);
	}
	
/*
功能:分页
$url，基准网址，若为空，将会自动获取，不建议设置为空 
$total，信息总条数 
$perpage，每页显示行数 
$pagebarnum，分页栏每页显示的页数 
$mode，显示风格，参数可为整数1，2，3，4任意一个 
*/
	protected function page($url, $total, $perpage = 10, $pagebarnum = 5, $mode = 1) {
		$page = new page ();
		return $page->show ( $url, $total, $perpage, $pagebarnum, $mode );
	}
	
	/*
	 * 全局语言包
	*/
	public function getGobleLang(){
		$this->assign ('__ROOT__',__ROOT__);
		$this->assign ('_PUBLIC_',__PUBLIC__);
		$this->assign ( 'Index', Lang::get('Index'));
		$this->assign ( 'Login', Lang::get('Login'));
		$this->assign ( 'LoginOut', Lang::get('LoginOut'));
		$this->assign ( 'Register', Lang::get('Register'));
		$this->assign ( 'Help', Lang::get('Help'));
		$this->assign ( 'AboutUs', Lang::get('AboutUs'));
		$this->assign ( 'ChanceCoop', Lang::get('ChanceCoop'));
		$this->assign ( 'JoinUs', Lang::get('JoinUs'));
		$this->assign ( 'API', Lang::get('API'));
		$this->assign ( 'Feedback', Lang::get('Feedback'));
		$this->assign ( 'BackTop', Lang::get('BackTop'));
	}
	/**
	 * 取类
	 */
	protected function getClass($className,$fieldArr=''){	
		switch($className){
			case 'CommonOAuth2':
				include(dirname(dirname(__FILE__)).'/include/lib/CommonOAuth2.php');
				return new CommonOAuth2($this->config['oauth']);
				break;
			case 'DBLogin':
				include(dirname(dirname(__FILE__)).'/include/lib/DBLogin.class.php');
				return new DBLogin($this->model);
				break;
			case 'DBPlugInInfo':
				include(dirname(dirname(__FILE__)).'/include/lib/DBPlugInInfo.class.php');
				return new DBPlugInInfo($this->model, $this->config);
				break;
			case 'DBextendSoap':
				$this->config['DES']['ident'] = 'private';
				include(dirname(dirname(__FILE__)).'/include/lib/DBextendSoap.class.php');
				return new DBextendSoap($this->config);
				break;
			case 'DBQRCode':
				include(dirname(dirname(__FILE__)).'/include/lib/DBQRCode.class.php');
				return new DBQRCode();
				break;
			case 'DBQRCodeForPC':
				include(dirname(dirname(__FILE__)).'/include/lib/DBQRCodeForPC.class.php');
				return new DBQRCodeForPC($this->model, $this->config);
				break;	
			case 'DBTokenCode':
				include(dirname(dirname(__FILE__)).'/include/lib/DBTokenCode.class.php');
				return new DBTokenCode();
				break;	
			case 'DBInviteCodeLangState':
				include(dirname(dirname(__FILE__)).'/include/lib/DBInviteCodeLangState.class.php');
				return new DBInviteCodeLangState($this->model);
				break;
			case 'DBWebStatics':
				include(dirname(dirname(__FILE__)).'/include/lib/DBWebStatics.class.php');
				return new DBWebStatics($this->model);
				break;
			case 'DBWebStaticsMongo':
				include(dirname(dirname(__FILE__)).'/include/lib/DBWebStaticsMongo.class.php');
				return new DBWebStaticsMongo($this->mongo_model);
				break;	
			default:
				break;
		}
	}
}
?>