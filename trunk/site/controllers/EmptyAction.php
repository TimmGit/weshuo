<?php
class EmptyAction extends commonAction
{
	public function index()
	{
		$home=wsRoute::segment(1);
		$fun=wsRoute::segment(2);
		require LIB_PATH.'userLib.php';
		require LIB_PATH.'topicLib.php';
		$userLib=new userLib();
		$topicLib=new topicLib();
		$userInfo=$userLib->getUserInfo($home);
		if(!$userInfo)
		{
			wsEcho::showMsg("您访问了不存在的地址");
		}
		if(empty($fun) || $fun=="index")
		{
			if(isset($_SESSION['login']))
			{
				$this->showIndex($userLib,$topicLib,$userInfo);
			}
			else 
			{
				$this->noLogin($userLib,$topicLib,$userInfo);	
			}
		}
		elseif (is_numeric($fun))
		{
			$this->showInfo($fun);
		}
		else 
		{
			wsEcho::showMsg("404");
		}
	}
	
	private function showInfo($topicId)
	{
		$topicLib=new topicLib();
		$info=$topicLib->getInfo($topicId);
		$this->loadView("blog_show",array('info'=>$info));
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
