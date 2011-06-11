<?php
class siteExtLib
{
	private $mod;
	
	function __construct()
	{
		$this->mod=new siteExtMod();
	}
	
	public function getInfo()
	{
		return $this->mod->getInfo();
	}
	
	public function setInfo($data)
	{
		$info=$this->getInfo();
		return $this->mod->setInfo($data, $info['siteExtId']);
	}
}