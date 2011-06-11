<?php
class CpAction extends admCommonAction
{	
	public function index()
	{
		$this->loadView("index");
	}
	
	public function top()
	{
		$this->loadView("top");
	}
	
	public function left()
	{
		$this->loadView("left");
	}
	
	public function welcome()
	{
		$this->loadView("welcome");
	}
}