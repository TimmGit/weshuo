<?php
class wsAction
{
	public $data=array();
	public static $plug=array();
	
	function __construct()
	{
		require_once WS_ROOT.'source/core/wsForm.class.php';
	}
	
	protected function isAdmin($ajax=FALSE)
	{
		if(!userSessionLib::getAdmUsre())
		{
			if($ajax)
			{
				echo "请登录管理中心";exit;
			}
			else 
			{
				$this->loadView("adm_unlogin");
			}
		}
	}
	
	protected function isLogin($ajax=FALSE)
	{
		if(!userSessionLib::getLogin())
		{
			if($ajax)
			{
				echo "请登录系统";exit;
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
			$tpl=str_replace(PLUG_PATH.'template/','', $tpl);
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
	protected function success($msg,$url=FALSE)
	{
		$url=$url===FALSE ?$_SERVER['HTTP_REFERER'] :siteUrl($url);
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
	
	protected function checkFormItem($checkType,$post="post")
	{
		$formCheck=import("formCheck",TRUE);
		$checkType=strtolower($checkType);
		switch ($checkType)
		{
			case "homePage":
				return $this->checkForm("homePage",$post, "主页地址长度错误5-30", array(wsForm::$string,5,30),array($formCheck,'isHome','主页地址不能输入特殊符号'));
				break;
			case "mail":
				return $this->checkForm("mail",$post, "电子邮件长度错误5-50", array(wsForm::$string,5,50),array($formCheck,'isMail','电子邮件不合格！'));; 
				break;
			case "nickName":
				return $this->checkForm("nickName",$post, "昵称长度错误4-10", array(wsForm::$string,4,10),array($formCheck,'isHome','昵称不能输入特殊符号'));
				break;
			default:
				return $this->checkForm("userName",$post, "帐号长度错误5-20", array(wsForm::$string,5,20),array($formCheck,'isHome','帐号不能输入特殊符号'));
				break;
		}
		
	}
}