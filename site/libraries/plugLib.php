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
	
	public function delPlugById($id)
	{
		return $this->mod->delPlugById($id);
	}
	
	public function updatePlubInfo($data,$id)
	{
		return $this->mod->updatePlubInfo($data,$id);
	}
	
	public function getPlugInfoByPath($path)
	{
		return $this->mod->getPlugInfoByPath($path);
	}
	
	public function getAllPlug($status=1)
	{
		if($status==1)
		{
			return $this->mod->getAllOnPlug();
		}
		elseif($status==2)
		{
			return $this->mod->getAllOffPlug();
		}
		else 
		{
			return $this->mod->getAllPlug();
		}
		
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