<?php
class IndexAction extends commonAction
{
	public function index()
	{
		require_once MODEL_PATH.'userMod.php';
		$this->loadView('index',array('a'=>'weshuo.org'));
	}
	
	public function test()
	{
		header("Content-type:text/html;charset=utf-8");
		import("imageLib");
		$imgLib=new imageLib(UPLOAD_PATH.'/Prettybeauty026.jpg');
		$imgLib->textImage('http://t.weshuo.org/admin',9);
	}
}
