<?php
class EmptyAction extends wsCore
{
	public function index($home)
	{
		require LIB_PATH.'userLib.php';
		require LIB_PATH.'topicLib.php';
		$userLib=new userLib();
		$topicLib=new topicLib();
		$userInfo=$userLib->getUserInfo($home);
		if(!$userInfo)
		{
			wsEcho::showMsg("您访问了不存在的地址");
		}
		if(isset($_SESSION['login']))
		{
			$this->showIndex($userLib,$topicLib,$userInfo);
		}
		else 
		{
			$this->noLogin($userLib,$topicLib,$userInfo);	
		}
	}
	
	private function showIndex(userLib $userLib,topicLib $topicLib,$userInfo)
	{
		$data=array();
		$data['userInfo']=$userInfo;
		$data['userExt']=$userLib->getUserExtInfo($userInfo['userId']);
		$data['wblist']=$topicLib->getTopicByUserId($userInfo['userId']);
		$data['attlist']=$userLib->getUserAttList($userInfo['userId']);
		$this->loadView("home_login",$data);
	}
	
	private function noLogin(userLib $userLib,topicLib $topicLib,$userInfo)
	{
		$data=array();
		$data['userInfo']=$userInfo;
		$data['userExt']=$userLib->getUserExtInfo($userInfo['userId']);
		$data['wblist']=$topicLib->getTopicByUserId($userInfo['userId']);
		$data['attlist']=$userLib->getUserAttList($userInfo['userId']);
		$this->loadView("home_unlogin",$data);
	}
	
}
