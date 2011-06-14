<?php
class PluginAction extends wsAction
{
	public function _ws()
	{
		$className=segment(2);
		$fun=segment(3);
		if($className && $fun)
		{
			$path=str_replace('_', '/',$className).'_ws.php';
			if(file_exists(PLUG_PATH.$path))
			{
				require_once PLUG_PATH.$path;
				$className=new $className();	
				if(method_exists($className, $fun))
				{
					$className->$fun();
				}			
			}
			return false;
		}
		return false;
	}
	
	protected function addVar($key,$value)
	{
		$className=segment(2);
		if($className && $key)
		{
			$pluginVarLib=new pluginVarLib();
			if(!$pluginVarLib->checkVarExit($className, $key))
			{
				return $pluginVarLib->addVar($className, $key, $value);
			}
			else 
			{
				return $pluginVarLib->updateVar($className, $key, $value);
			}
		}
		return FALSE;
	}
	
	protected function getVar($key)
	{
		$className=segment(2);
		if($className && $key)
		{
			$pluginVarLib=new pluginVarLib();
			$info=$pluginVarLib->checkVarExit($className,$key);
			return !$info ?'' :$info['varContent'];
		}
		return false;
	}
	
	protected function delVar($key)
	{
		$className=segment(2);
		if($className && $key)
		{
			$pluginVarLib=new pluginVarLib();
			return $pluginVarLib->delVar($className,$key);
		}
		return false;
	}
		
	protected function loadView($tpl,$array=array(),$return=false)
	{
		$tpl=PLUG_PATH.'template/'.$tpl;
		parent::loadView($tpl,$array,$return);
	}
}