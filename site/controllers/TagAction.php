<?php
class TagAction extends CommonAction
{
	function __construct()
	{
		parent::__construct();
		$this->isLogin();
	}
	
	public function index()
	{
		parent::setTitle("热门话题--");
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
		$tagName=segment(2,FALSE);
		if(!$tagName)
		{
			$this->error('404');
		}
		$tagLib=new tagLib();
		$tagInfo=$tagLib->getInfoByName($tagName);
		if($tagInfo)
		{
			$topidId=str_replace(',,', ',', $tagInfo['topicId']);
			$topidId=(substr($topidId,0,1)==',')?substr($topidId,1):$topidId;
			$topidArr=explode(',', $topidId);
			$count=count($topidArr);
			$topicLib=new topicLib();
			$data['list']=$topicLib->getTopicByTopicId($topidId);
			$data['newTopic']=$topicLib->getTopicList(1,8);
			$this->loadView("tag_show",$data);
		}
		else 
		{
			$this->error('不存在的话题');
		}
	}
}