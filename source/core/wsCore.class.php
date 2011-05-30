<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.com
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb http://www.ciphp.com
*/ 
class wsCore
{	
	function __construct()
	{
		require_once WS_ROOT.'source/core/wsForm.class.php';
	}
	
	
	public function isLogin()
	{
		if(!isset($_SESSION['login']) || empty($_SESSION['login']))
		{
			$this->redirect("public/login");
		}
	}
	
	/**
	 * 载入视图
	 * @param string $tpl
	 * @param array $array
	 * @param boolean $return
	 */
	public function loadView($tpl,$array=false,$return=false)
	{
		$laodTemp=wsTemplate::loadTemplate($tpl,$array);
		if($laodTemp===false)
		{
			wsEcho::showMsg(wsLang::getLang('system_tpl_not_exits').$tpl);
		}
		if($return)
		{
			return $laodTemp;
		}
		else 
		{
			echo $laodTemp;
			exit;
		}
	}
	
	/**
	 * 载入成功模版
	 * @param string $msg
	 * @param string $url
	 */
	public function success($msg,$url)
	{
		$this->loadView("success",array('message'=>$msg,'url'=>$url));
	}
	
	/**
	 * 载入错误处理模版
	 * @param string $msg
	 */
	public function error($msg='系统发生错误，操作失败!请稍后重试！')
	{
		$this->loadView("error",array('message'=>$msg));
	}
	
	public function redirect($url='')
	{
		header("Location:".siteUrl($url));
	}
	
	/**
	 * 检测表单字段
	 * @param sting $name
	 * @param string $post
	 * @param string $msg
	 * @param array $checkLen
	 * @param array $oterhFun
	 * @throws Exception
	 */
	public function checkForm($name,$post,$msg,$checkLen,$oterhFun=false,$ajax=false)
	{
		try 
		{
			return wsForm::formField($name, $post, $msg, $checkLen, $oterhFun,$ajax);
		}
		catch (Exception $e)
		{
			$this->loadView('error',array('message'=>$e->getMessage()));
		}
	}
	
	/**
	 * 启动路由解析
	 */
	public function start()
	{
		wsRoute::routePath();
		$this->dispenseRoute();
	}
	
	/**
	 * 分发路由
	 */
	private function dispenseRoute()
	{
		$wsPath=wsRoute::getPath();
		if($wsPath==false)
		{
			wsEcho::showMsg(wsLang::getLang('system_route_error'));
		}
		else 
		{
			$this->exeFun($wsPath[0],$wsPath[1]);
		}
	}
	
	/**
	 * 执行方法
	 * @param string $class
	 * @param string $fun
	 */
	private function exeFun($class,$fun)
	{
		if(strtolower($class)=="empty")
		{
			wsEcho::showMsg(wsLang::getLang('system_error_contr_not_exits'));
		}
		$class=ucfirst($class);
		$file=WS_ROOT.APP_PATH.'/controllers/'.$class.'Action.php';
		if(!file_exists($file))
		{
			$file=WS_ROOT.APP_PATH.'/controllers/EmptyAction.php';
			$class="Empty";
			$fun='index';
		}
		require $file;
		$className=$class.'Action';
		$className=new $className;
		if(method_exists($className,$fun))
		{
			$className->$fun();
		}
		else 
		{
			wsEcho::showMsg(wsLang::getLang('system_fun_error').$fun);
		}
	}
}
