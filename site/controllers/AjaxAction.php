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
		$content=$_POST['content'];
		$topicExtra=new topicExtra();
		$content=$topicExtra->getWbContent($content);
		if(empty($content['content']))
		{
			echo "微博内容不能为空！";exit;
		}
		$wsLib=new weShuoLib();
		$ipAddress=client::getIPaddress(client::getClientIp());
		$echoId=0;
		if($zhuan || $tome)
		{
			$userLib=new userLib();
			$userInfo=$userLib->getUserInfo($info['userId'],'id');
			$topicLib->setPingZhuanCount($topicId,TRUE);
			$newContent=$content['content']."//@".$userInfo['nickName']." <span class=\'wbShare\'>".$info['title']."</span>";
			$echoId=$wsLib->sendWeibo(addslashes($newContent), $content['url'], $content['short'], $ipAddress, $sendUser);
		}
		if($ping)
		{
			$parentId=0;
			$topicLib->setPingZhuanCount($topicId);
			$echoId=$wsLib->replayWeibo($content['content'], $content['url'], $content['short'], $ipAddress, $sendUser,$parentId,$topicId);
		}
		echo $echoId;
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
	
	public function getComment()
	{
		$topicId=$this->checkForm("topicId","post",'微博ID错误',array(wsForm::$int,0,wsForm::$intMax),false,true);
		$commentLib=new commentLib();
		$list=$commentLib->getCommentList(array('topicId'=>$topicId));
		if($list)
		{
			$userLib=new userLib();
			$html='<ul>';
			foreach ($list as $k=>$v)
			{
				$userInfo=$userLib->getUserInfo($v['userId'],'id');
				$html.="<li><img src='".baseUrl('static/upload/face').'/ws_30_'.$userInfo['icon']."' />
				<span><a href='".siteUrl($userInfo['homePage'])."'>".$userInfo['nickName']."</a>&nbsp;&nbsp;".$v['content']."
				<em>".topicExtra::getTime($v['time'])."</em></span>&nbsp;
				<a href='javascript:void(0)' onclick=\"return replaySomeBady('".$userInfo['nickName']."',$topicId);\">回复</a></li>";
			}	
			$html.='</ul>';
			echo $html;
		}
	}
}