<?php
class GroupAction extends CommonAction
{
	function __construct()
	{
		$this->isLogin();
	}
	
	public function index()
	{
		$page=$this->checkForm("page",array(3,1),'分页ID错误', array(wsForm::$int,1,wsForm::$intMax));
		$limit=10;
		$groupLib=new groupLib();
		$allCount=$groupLib->getGroupCount();
		$pageTool=new pageTool($page, $allCount, $limit);
		$start=($page-1)*$limit;
		$limit=$start.','.$limit;
		$data['list']=$groupLib->getGroupList(false,$limit);
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
		$topicLib=new topicLib();
		$pageSize=10;
		$nowPage=$this->checkForm("page", array(3,1), "分页ID错误", array(wsForm::$int,1,wsForm::$intMax));
		$allCount=$topicLib->getCountByGroup($info['groupId']);
		$pageTool=new pageTool($nowPage, $allCount, $pageSize);
		$data['list']=$topicLib->getListByGroup($info['groupId'], $nowPage, $pageSize);
		$data['page']=$pageTool->showNum('group/index');
		$this->loadView('group_show',$data);
	}
}