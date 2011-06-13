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
	
	public static function checkPlugCache($reWrite=FALSE)
	{
		$filename=CACHE_PATH.'plug.php';
		if(!@file_get_contents($filename) || $reWrite)
		{
			$plugArr=array();
			$plugLib=new plugLib();
			$info=$plugLib->getAllPlug();
			if(!$info)
			{
				return true;
			}
			foreach ($info as $plug)
			{
				$plugPath=str_replace('_ws.php','', $plug['plugPath']);
				$index=stripos($plugPath, "/");
				if($index!==FALSE)
				{
					$plugPath=substr($plugPath,$index);
				}
				$plugArr[]=str_replace('/', '', $plugPath);
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