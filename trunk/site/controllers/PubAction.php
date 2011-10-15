<?php
class PubAction extends CommonAction
{
	function __construct()
	{
		parent::__construct();
		$this->isLogin();
	}
	public function index()
	{
		parent::setTitle("微博广场--");
		$userLib=new userLib();
		$topicLib=new topicLib();
		$tagLib=new tagLib();
		$page=$this->checkForm("page",array(3,1),'分页标记错误',array(wsForm::$int,0,wsForm::$intMax));
		$limit=10;
		$allCount=$topicLib->getTopicCount();
		$pageTool=new pageTool($page, $allCount, $limit);
		$list=$topicLib->getTopicList($page,$limit,false,'topicId desc');
		$pageInfo=$pageTool->showNum('pub/index');
		$data['list']=$list;
		$data['pageInfo']=$pageInfo;
		$data['hotUser']=$userLib->getHotUserList(6);
		$data['hotTag']=$tagLib->getHotTag(8);
		$data['newTopic']=$topicLib->getTopicList(1,8);
		$this->loadView('pub_index',$data);
	}
}