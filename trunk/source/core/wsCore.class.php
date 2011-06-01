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
	public $data=array();
	
	function __construct()
	{
		require_once WS_ROOT.'source/core/wsForm.class.php';
		if(DEBUG_MODE==0)
		{
			runTime::$time=runTime::getSecondTime();
			runTime::$memory=runTime::getNowMem();
		}
	}
	
	
	protected function isLogin($ajax=FALSE)
	{
		if(!userSessionLib::getLogin())
		{
			if($ajax)
			{
				echo "请登陆系统";exit;
			}
			else 
			{
				$this->redirect("public/login");
			}
		}
	}
	
	/**
	 * 载入视图
	 * @param string $tpl
	 * @param array $array
	 * @param boolean $return
	 */
	protected function loadView($tpl,$array=array(),$return=false)
	{
		$laodTemp=wsTemplate::loadTemplate($tpl,$array,$this->data);
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
			if(DEBUG_MODE==0)
			{
				echo $this->showDebugInfo();
			}
			exit;
		}
	}
	
	private function showDebugInfo()
	{
		$time=runTime::getSecondTime()-runTime::$time;
		$mem=runTime::getNowMem()-runTime::$memory;
		$info="<div id='runTime' style='border:1px solid #ccc;padding:5px;'>runTime:".round($time,4)."s,Memory:".round($mem,2)."KB<br/>".runTime::$sql."</div>";
		return $info;
	}
	
	/**
	 * 载入成功模版
	 * @param string $msg
	 * @param string $url
	 */
	protected function success($msg,$url)
	{
		$this->loadView("success",array('message'=>$msg,'url'=>$url));
	}
	
	/**
	 * 载入错误处理模版
	 * @param string $msg
	 */
	protected function error($msg='系统发生错误，操作失败!请稍后重试！')
	{
		$this->loadView("error",array('message'=>$msg));
	}
	
	protected function redirect($url='')
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
	protected function checkForm($name,$post,$msg,$checkLen,$oterhFun=false,$ajax=false)
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
