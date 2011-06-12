<?php
class userExtLib
{
	private $mod;
	function __construct()
	{
		$this->mod=new userExtMod();
	}
	
	public function getUserExtInfo($userId)
	{
		return $this->mod->getUserExtInfo($userId);
	}
	
	public function setUserExtInfo($data,$userId)
	{
		return $this->mod->setUserExtInfo($data,$userId);
	}
}