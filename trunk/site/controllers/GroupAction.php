<?php
class GroupAction extends CommonAction
{
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
}