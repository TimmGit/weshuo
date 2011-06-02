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
		$url=$content['url'];
		$short=$content['short'];
		//过滤 计算短网址 计算长度 提取TAG 替换短网址 处理ABOUTME 写入微博
		$tagExtra=new tagExtra();
		$tag='';
		$content= $tagExtra->getTopicTag($content['content']);
		if(is_array($content))
		{
			$tag= $content['tag'];
			$content= $content['content'];
		}
		if($url)
		{
			$content=$topicExtra->replaceSortUrl($content, $short);
		}
		$content=$topicExtra->aboutMe($content);
		$userArr=array();
		if(is_array($content))
		{
			$userArr=$content['sendUser'];
			$content=$content['content'];
		}
		$address=$sendUser['province'].$sendUser['city'];
		$ipAddress='127.0.0.1';
		$topicId=false;
		$topicId=$topicExtra->sendWeibo($content, $sendUser['userId'], $group, $parentId, $tag, 0,1,0,'web', $sendUser['homePage'],$address,$ipAddress);
		if($topicId && $url)
		{
			$linkLib=new linkLib();
			$linkLib->addLink($content['url'],$content['short']);
		}
		if(!empty($userArr) && $topicId)
		{
			$messageLib=new messageLib();
			foreach ($userArr as $userId=>$nickName)
			{
				$title=$sendUser['nickName'].'的微博提到你';
				$messageLib->addMsg(0,$userId, $title);
			}
		}
		if(!empty($tag) && $topicId)
		{
			$tagLib=new tagLib();
			foreach ($tag as $value)
			{
				$tagLib->addTag($value, $sendUser['userId'],$sendUser['homePage'], $topicId);
			}
		}
		echo $topicId?$topicId:0;
	}
}