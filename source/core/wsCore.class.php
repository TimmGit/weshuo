<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class wsCore
{	
		
	function __construct()
	{
		if(DEBUG_MODE==0)
		{
			runTime::$time=runTime::getSecondTime();
			runTime::$memory=runTime::getNowMem();
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
		elseif (method_exists($className,'_ws'))
		{
			$className->_ws();
		}
		else 
		{
			wsEcho::showMsg(wsLang::getLang('system_fun_error').$fun);
		}
	}
}
