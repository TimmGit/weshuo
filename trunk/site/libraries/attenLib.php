<?php
class attenLib
{
	private $mod;
	function __construct()
	{
		$this->mod=new attentionMod();
	}
	
	public function getUserAtt($userId)
	{
		return $this->mod->getUserAttenList($userId);
	}
}