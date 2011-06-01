<?php
class AjaxAction extends CommonAction
{
	public function checkNick()
	{
		$this->isLogin(true);
		$formCheck=import('formCheck',true);
		$nickName=$this->checkForm("nickname","post",'昵称长度4-12位',array(wsForm::$string,4,12,true),array($formCheck,'isHome','不要输入特殊字符'),true);
		$userLib=new userLib();
		if($userLib->checkNickNameIsExit(userSessionLib::getUserId(), $nickName))
		{
			echo "昵称已经存在，请更换！";exit;
		}
		echo "可以使用!";
	}
	
	public function checkMail()
	{
		$formCheck=import('formCheck',true);
		$mail=$this->checkForm("mail","post",'请输入电子邮件',array(wsForm::$string,4,50),array($formCheck,'isMail','电子邮件格式错误'),true);
		$userLib=new userLib();
		if($userLib->checkExit('mail',$mail))
		{
			echo "电子右键已经存在，请更换！";exit;
		}
		echo "可以使用!";
	}
	
	public function send()
	{
		$this->isLogin(true);
		$formCheck=import('formCheck',true);
		$group=$this->checkForm("group","post",'群组ID错误',array(wsForm::$int,0,wsForm::$intMax),false,true);
		$tag=$this->checkForm("tag","post",'话题长度错误',array(wsForm::$string,0,30),false,true);
		$content=replaceHtml($_POST['content']);
		echo $content;
	}
}