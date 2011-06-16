<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class wsPlugin
{
	private static $plug=false;
	
	public static function getPlugin()
	{
		if(!self::$plug)
		{
			self::$plug=wsCache::rwCache('plug');
		}
		return self::$plug;
	}
	
	public static function exexPlugFun($hookName,$param)
	{
		$plugObj=FALSE;
		$plugFile=self::getPlugin();
		if($plugFile && $hookName)
		{
			foreach ($plugFile as $file)
			{
				if(!isset(wsAction::$plug[$file]))
				{
					$fileName=PLUG_PATH.self::getPlugPath($file).'_ws.php';
					if(file_exists($fileName))
					{
						include_once $fileName;
						$plugObj=& new $file();
						wsAction::$plug[$file]=$plugObj;
					}
				}
				else 
				{
					$plugObj=wsAction::$plug[$file];
				}
				if($plugObj && method_exists($plugObj,$hookName))
				{
					return $plugObj->$hookName($param);
				}
			}
			
		}
	}
	
	public static function plugInstall($className,$path)
	{
		require_once PLUG_PATH.$path;
		$className=self::getPlugClass($className);
		$className=new $className();
		if(method_exists($className,'install'))
		{
			$className->install();
		}
	}
	
	public static function plugUninstall($className,$path)
	{
		require_once PLUG_PATH.$path;
		$className=self::getPlugClass($className);
		$className=new $className();
		if(method_exists($className,'uninstall'))
		{
			$className->uninstall();
		}
	}
	
	public static function getPlugPath($class)
	{
		return str_replace('_', '/', $class);
	}
	
	private static function getPlugClass($plugPath)
	{
		$plugPath=str_replace('_ws.php','', $plugPath);
		$plugPath=substr($plugPath,0,1)=='/' ?substr($plugPath,1) :$plugPath;
		return str_replace('/', '_', $plugPath);
	}
	
	public static function delPluginVal($plugPath)
	{
		$pluginVarLib=new pluginVarLib();
		$pluginVarLib->delVar(self::getPlugClass($plugPath));
	}
	
	public static function checkPlugCache($reWrite=FALSE)
	{
		$filename=CACHE_PATH.'plug.php';
		if(!@file_get_contents($filename) || $reWrite)
		{
			if($reWrite)
			{
				wsCache::rwCache("plug",null);
			}
			$plugArr=array();
			$plugLib=new plugLib();
			$info=$plugLib->getAllPlug();
			if(!$info)
			{
				return true;
			}
			foreach ($info as $plug)
			{
				$plugArr[]=self::getPlugClass($plug['plugPath']);
			}
			wsCache::rwCache('plug',$plugArr);
		}
	}
	
	public static function readPlugInfo($plugPath)
	{
		$plugInfo=array('name'=>'','description'=>'','link'=>'','version'=>'','author'=>'');
		$content=file_get_contents($plugPath);
		if(preg_match("/@name\s(\w+)/i", $content,$name))
		{
			$plugInfo['name']=$name[1];
		}
		if(preg_match("/@description\s(\w+)/i", $content,$description))
		{
			$plugInfo['description']=$description[1];
		}
		if(preg_match("/@link\s(\w+)/i", $content,$link))
		{
			$plugInfo['link']=$link[1];
		}
		if(preg_match("/@version\s(\w+)/i", $content,$version))
		{
			$plugInfo['version']=$version[1];
		}
		if(preg_match("/@author\s(\w+)/i", $content,$author))
		{
			$plugInfo['author']=$author[1];
		}
		return $plugInfo;
	}
}