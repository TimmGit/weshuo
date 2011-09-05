<?php
class GroupAction extends CommonAction
{
	function __construct()
	{
		parent::__construct();
		$this->isLogin();
	}
	
	public function index()
	{
		$page=$this->checkForm("page",array(3,1),'分页ID错误', array(wsForm::$int,1,wsForm::$intMax));
		$limit=12;
		$groupLib=new groupLib();
		$allCount=$groupLib->getGroupCount();
		$pageTool=new pageTool($page, $allCount, $limit);
		$data['list']=$groupLib->getGroupList(false,$page,$limit);
		$data['page']=$pageTool->showNum('group/index');
		$this->loadView('group_index',$data);
	}
	
	public function _ws()
	{
		$groupName=segment(2,FALSE);
		$groupLib=new groupLib();
		$info=$groupLib->getInfoByName($groupName);
		if(!$info)
		{
			$this->error('不存在的群组');
		}
		$userId=userSessionLib::getUserId();
		$userGroup=new userGroupLib();
		$freeGroup=$userGroup?1:0;
		$userInfo=userSessionLib::getUserInfo();
		if($userInfo['roleId']==9)
		{
			$freeGroup=1;
		}
		$topicLib=new topicLib();
		$pageSize=10;
		$nowPage=$this->checkForm("page", array(3,1), "分页ID错误", array(wsForm::$int,1,wsForm::$intMax));
		$allCount=$topicLib->getCountByGroup($info['groupId']);
		$pageTool=new pageTool($nowPage, $allCount, $pageSize);
		$data['list']=$topicLib->getListByGroup($info['groupId'], $nowPage, $pageSize);
		$data['page']=$pageTool->showNum('group/index');
		$data['free']=$freeGroup;
		$this->loadView('group_show',$data);
	}
}