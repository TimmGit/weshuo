<?php
class EmptyAction extends CommonAction
{
	public function index()
	{
		$home=wsRoute::segment(1);
		$fun=wsRoute::segment(2);
		require LIB_PATH.'userLib.php';
		require LIB_PATH.'topicLib.php';
		$userLib=new userLib();
		$topicLib=new topicLib();
		if(empty($fun) || $fun=="index" || $fun=='private')
		{
			$userInfo=$userLib->getUserInfo($home);
			if(!$userInfo)
			{
				wsEcho::showMsg("您访问了不存在的地址");
			}
			if(userSessionLib::getLogin())
			{
				if($fun=='private')
				{
					$this->showHome($userLib,$topicLib,$userInfo);
				}
				elseif($userInfo['homePage']==$home)
				{
					$this->showIndex($userLib,$topicLib,$userInfo);
				}
				else 
				{
					$this->showUserHome($userLib,$topicLib,$userInfo);
				}	
			}
			else 
			{
				$this->noLogin($userLib,$topicLib,$userInfo);	
			}
		}
		elseif (is_numeric($fun))
		{
			$this->showInfo($userLib,$topicLib,$fun);
		}
		else 
		{
			wsEcho::showMsg("404");
		}
	}
	
	private function showInfo(userLib $userLib,topicLib $topicLib,$topicId)
	{
		$topicId=intval($topicId);
		$tagLib=new tagLib();
		$commentLib=new commentLib();
		$info=$topicLib->getInfo($topicId);
		$list=$commentLib->getComment($topicId);
		foreach ($list as $k=>$v)
		{
			$list[$k]['userInfo']=$userLib->getUserInfo($v['userId'],'id');
		}
		$data['tInfo']=$info;
		$data['list']=$list;
		$data['userInfo']=$userLib->getUserInfo($info['userId'],'id');
		$data['hotUser']=$userLib->getHotUserList(6);
		$data['hotTag']=$tagLib->getHotTag(8);
		$data['newTopic']=$topicLib->getTopicList(1,8);
		$this->loadView("blog_show",$data);
	}
	
	private function showIndex(userLib $userLib,topicLib $topicLib,$userInfo)
	{
		parent::setTitle("我的主页--");
		$limit=10;
		$page=$this->checkForm("page",array(3,1),'分页ID错误', array(wsForm::$int,1,wsForm::$intMax));
		$start=($page-1)*$limit;
		$topicLib=new topicLib();
		$tag=new tagLib();
		$allCount=$topicLib->getUserHomeCount($userInfo['userId']);
		$pageTool=new pageTool($page, $allCount, $limit);
		$data=array();
		$data['userInfo']=$userInfo;
		$data['userExt']=$userLib->getUserExtInfo($userInfo['userId']);
		$wbList=$topicLib->getUserHomeList($userInfo['userId'],$start,$limit);
		$data['wblist']=$this->parseTopicList($wbList);
		$data['page']=$pageTool->showNum($userInfo['homePage'].'/index');
		$data['tag']=$tag->getHotTag();
		$this->loadView("home_index",$data);
	}
	
	private function parseTopicList($list)
	{
		$userLib=new userLib();
		foreach ($list as $k=>$topic)
		{
			$userInfo=$userLib->getUserInfo($topic['userId'],'id');
			$list[$k]['icon']=$userInfo['icon'];
			$list[$k]['nickName']=$userInfo['nickName'] ?$userInfo['nickName'] :$userInfo['userName'];
		}
		return $list;
	}
	
	private function showHome(userLib $userLib,topicLib $topicLib,$userInfo)
	{
		parent::setTitle("我的微博--");
		$data=array();
		$data['userInfo']=$userInfo;
		$data['userExt']=$userLib->getUserExtInfo($userInfo['userId']);
		$data['wblist']=$this->parseTopicList($topicLib->getTopicByUserId($userInfo['userId']));
		$data['attlist']=$userLib->getUserAttList($userInfo['userId']);
		$this->loadView("home_login",$data);
	}
	
	private function noLogin(userLib $userLib,topicLib $topicLib,$userInfo)
	{
		parent::setTitle($userInfo['nickName']."的微博--");
		$data=array();
		$data['userInfo']=$userInfo;
		$data['userExt']=$userLib->getUserExtInfo($userInfo['userId']);
		$data['wblist']=$this->parseTopicList($topicLib->getTopicByUserId($userInfo['userId']));
		$data['attlist']=$userLib->getUserAttList($userInfo['userId']);
		$this->loadView("home_unlogin",$data);
	}
	
}
