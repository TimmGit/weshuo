<?php
class PubAction extends CommonAction
{
	function __construct()
	{
		$this->isLogin();
	}
	public function index()
	{
		$topicLib=new topicLib();
		$page=$this->checkForm("page",array(3,1),'分页标记错误',array(wsForm::$int,0,wsForm::$intMax));
		$limit=10;
		$allCount=$topicLib->getTopicCount();
		$pageTool=new pageTool($page, $allCount, $limit);
		$list=$topicLib->getTopicList($page,$limit);
		$pageInfo=$pageTool->showNum('pub/index');
		$this->loadView('pub_index',array('list'=>$list,'pageInfo'=>$pageInfo));
	}
}