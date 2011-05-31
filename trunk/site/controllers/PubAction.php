<?php
class PubAction extends commonAction
{
	function __construct()
	{
		$this->isLogin();
	}
	public function index()
	{
		$topicLib=new topicLib();
		$page=$this->checkForm("page",array(3,1),'',array(wsForm::$int,0,wsForm::$intMax));
		$limit=10;
		$list=$topicLib->getTopisList($page,$limit);
		$this->loadView('pub_index',array('list'=>$list));
	}
}