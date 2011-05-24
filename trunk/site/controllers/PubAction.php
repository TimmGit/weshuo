<?php
class PubAction extends wsCore
{
	function __construct()
	{
		$this->isLogin();
	}
	public function index()
	{
		$this->loadView('pub_index');
	}
}