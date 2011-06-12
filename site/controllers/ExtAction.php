<?php
class ExtAction extends admCommonAction
{
	public function index()
	{
		$this->loadView("ext_index");
	}
}