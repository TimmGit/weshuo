<?php
class pluginVarLib
{
	/**
	 * @var pluginVarMod
	 */
	private $mod;
	
	function __construct()
	{
		$this->mod=new pluginVarMod();
	}
	
	public function checkVarExit($name,$key)
	{
		return $this->mod->checkVarExit($name,$key);
	}
	
	public function addVar($name,$key,$value)
	{
		if($name && $key && $value)
		{
			return $this->mod->addVar(array('name'=>$name,'varKey'=>$key,'varContent'=>$value));
		}
		return FALSE;
	}
	
	public function updateVar($name,$key,$value)
	{
		if($name && $key)
		{
			return $this->mod->updateVar($value, $key, $name);
		}
		return false;
	}
	
	public function delVar($name,$key=FALSE)
	{
		if($key==FALSE)
		{
			return $this->mod->delVarByName($name);
		}
		else 
		{
			return $this->mod->delVar($name,$key);
		}
	}
}