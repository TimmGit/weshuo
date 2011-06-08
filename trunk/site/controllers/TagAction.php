<?php
class TagAction extends CommonAction
{
	public function index()
	{
		$page=$this->checkForm("page",array(3,1), '分页ID错误', array(wsForm::$int,1,wsForm::$intMax));
		$tagLib=new tagLib();
		$limit=50;
		$start=($page-1)*$limit;
		$allCount=$tagLib->getAllTagCount();
		$pageTool=new pageTool($page, $allCount,$limit);
		$data['page']=$pageTool->showNum('tag');
		$data['list']=$tagLib->getAllTag($start, $limit);
		$this->loadView('tag_index',$data);
	}
	
	public function _ws()
	{
		$this->loadView("tag_show");
	}
}