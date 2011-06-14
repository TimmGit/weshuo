<?php
class admCommonAction extends wsAction
{
	function __construct()
	{
		$this->isAdmin();
	}
	
	protected function loadView($tpl,$data=array(),$return=FALSE)
	{
		$tpl='cp/'.$tpl;
		return parent::loadView($tpl,$data,$return);
	}
	
	protected function success($msg='操作成功!',$url=FALSE)
	{
		parent::success($msg,$url);
	}
}