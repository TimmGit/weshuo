<?php
class EmptyAction extends CommonAction
{
	public function index()
	{
		$home=wsRoute::segment(1);
		$fun=wsRoute::segment(2);
		if(empty($fun) || $fun=="index" || $fun=='private')
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
			if(userSessionLib::getLogin())
			{
				if($fun=='private')
				{
					$this->showHome($userLib,$topicLib,$userInfo);
				}
				else 
				{
					$this->showIndex($userLib,$topicLib,$userInfo);
				}	
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
		$topicId=intval($topicId);
		$topicLib=new topicLib();
		$commentLib=new commentLib();
		$info=$topicLib->getInfo($topicId);
		$list=$commentLib->getComment($topicId);
		$this->loadView("blog_show",array('info'=>$info,'list'=>$list));
	}
	
	private function showIndex(userLib $userLib,topicLib $topicLib,$userInfo)
	{
		$limit=10;
		$page=$this->checkForm("page",array(3,1),'分页ID错误', array(wsForm::$int,1,wsForm::$intMax));
		$start=($page-1)*$limit;
		$topicLib=new topicLib();
		$allCount=$topicLib->getUserHomeCount($userInfo['userId']);
		$pageTool=new pageTool($page, $allCount, $limit);
		$data=array();
		$data['userInfo']=$userInfo;
		$data['userExt']=$userLib->getUserExtInfo($userInfo['userId']);
		$wbList=$topicLib->getUserHomeList($userInfo['userId'],$start,$limit);
		$data['wblist']=$this->parseTopicList($wbList);
		$data['attlist']=$userLib->getUserAttList($userInfo['userId']);
		$data['page']=$pageTool->showNum($userInfo['homePage'].'/index');
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
		$data=array();
		$data['userInfo']=$userInfo;
		$data['userExt']=$userLib->getUserExtInfo($userInfo['userId']);
		$data['wblist']=$this->parseTopicList($topicLib->getTopicByUserId($userInfo['userId']));
		$data['attlist']=$userLib->getUserAttList($userInfo['userId']);
		$this->loadView("home_login",$data);
	}
	
	private function noLogin(userLib $userLib,topicLib $topicLib,$userInfo)
	{
		$data=array();
		$data['userInfo']=$userInfo;
		$data['userExt']=$userLib->getUserExtInfo($userInfo['userId']);
		$data['wblist']=$this->parseTopicList($topicLib->getTopicByUserId($userInfo['userId']));
		$data['attlist']=$userLib->getUserAttList($userInfo['userId']);
		$this->loadView("home_unlogin",$data);
	}
	
}
