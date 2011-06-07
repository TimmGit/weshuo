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
	
	public function replay()
	{
		$this->isLogin(true);
		$sendUser=userSessionLib::getUserInfo();
		$formCheck=import('formCheck',true);
		$group=$this->checkForm("group","post",'群组ID错误',array(wsForm::$int,0,wsForm::$intMax),false,true);
		$tag=$this->checkForm("tag","post",'话题长度错误',array(wsForm::$string,0,30),false,true);
		$zhuan=$this->checkForm("zhuan","post","转发ID错误", array(wsForm::$int,0,1),false,true);
		$ping=$this->checkForm("ping","post","评论ID错误", array(wsForm::$int,0,1),false,true);
		$tome=$this->checkForm("tome","post","转播ID错误", array(wsForm::$int,0,1),false,true);
		$topicId=$this->checkForm("topicId","post",'微博ID错误',array(wsForm::$int,0,wsForm::$intMax),false,true);
		$topicLib=new topicLib();
		$info=$topicLib->getInfo($topicId);
		if(empty($info))
		{
			echo "错误的微博ID";exit;
		}
		$content=replaceHtml($_POST['content']);
		$topicExtra=new topicExtra();
		$content=$topicExtra->getWbContent($content);
		if(empty($content['content']))
		{
			echo "微博内容不能为空！";exit;
		}
		$wsLib=new weShuoLib();
		$ipAddress=client::getIPaddress(client::getClientIp());
		if($zhuan || $tome)
		{
			$newContent=$content['content']."<div class='wbShare'>".$info['title']."</div>";
			echo $wsLib->sendWeibo($newContent, $content['url'], $content['short'], $ipAddress, $sendUser);
		}
		if($ping)
		{
			$parentId=0;
			echo $wsLib->replayWeibo($content['content'], $content['url'], $content['short'], $ipAddress, $sendUser,$parentId,$topicId);
		}
	}
	
	public function send()
	{
		$this->isLogin(true);
		$sendUser=userSessionLib::getUserInfo();
		$formCheck=import('formCheck',true);
		$group=$this->checkForm("group","post",'群组ID错误',array(wsForm::$int,0,wsForm::$intMax),false,true);
		$tag=$this->checkForm("tag","post",'话题长度错误',array(wsForm::$string,0,30),false,true);
		$content=replaceHtml($_POST['content']);
		$parentId=0;
		$topicExtra=new topicExtra();
		$content=$topicExtra->getWbContent($content);
		if(empty($content['content']))
		{
			echo "微博内容不能为空！";exit;
		}
		$wsLib=new weShuoLib();
		$ipAddress=client::getIPaddress(client::getClientIp());
		echo $wsLib->sendWeibo($content['content'], $content['url'], $content['short'], $ipAddress, $sendUser);
	}
}