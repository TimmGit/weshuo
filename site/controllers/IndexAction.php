<?php
class IndexAction extends CommonAction
{
	public function index()
	{
		if(userSessionLib::getLogin())
		{
			$userInfo=userSessionLib::getUserInfo();
			$home=isset($userInfo['homePage']) ?$userInfo['homePage'] :'pub';
			$this->redirect($home);
		}
		else 
		{
			$this->loadView('public_login');
		}
		//$this->loadView('index',array('a'=>'weshuo.org'));
	}
	
	public function test()
	{
		header("Content-type:text/html;charset=utf-8");
		import("imageLib");
		$imgLib=new imageLib(UPLOAD_PATH.'/Prettybeauty026.jpg');
		$imgLib->textImage('http://t.weshuo.org/admin',9);
	}
}
