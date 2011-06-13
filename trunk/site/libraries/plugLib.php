<?php
class plugLib
{
	/**
	 * @var plugMod
	 */
	private $mod;
	
	function __construct()
	{
		$this->mod=new plugMod();
	}
	
	public function getAllPlug()
	{
		return $this->mod->getAllPlug();
	}
	
	public function checkPlugExit($path)
	{
		$path=substr($path,0,1)=='/'?substr($path,1):$path;
		return $this->mod->checkPlugExit($path);
	}
	
	public function addPlug($plugInfo,$path)
	{
		if(is_array($plugInfo) && $path)
		{
			$plugInfo['plugPath']=$path;
			$plugInfo['status']=1;
			$plugInfo['plugName']=$plugInfo['name'];
			unset($plugInfo['name']);
			return $this->mod->addPlug($plugInfo);
		}
		return false;
	}
}