<?php
class siteLib
{
	private $mod;
	
	function __construct()
	{
		$this->mod=new siteMod();
	}
	
	public function getSiteInfo()
	{
		return $this->mod->getSiteInfo();
	}
	
	public function setSiteInfo($data)
	{
		return $this->mod->setSiteInfo($data);
	}
}