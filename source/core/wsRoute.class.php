<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class wsRoute
{
	private static $path=FALSE;
	
	public static function routePath()
	{
		$path=FALSE;
		if(URL_MODE==1)
		{
			$path=isset($_SERVER['PATH_INFO']) ?$_SERVER['PATH_INFO'] :FALSE;
		}
		elseif(isset($_GET['p'])) 
		{
			$path=isset($_GET['p']) ?$_GET['p'] :FALSE;
		}
		else 
		{
			if(isset($_GET['m']))
			{
				$path=$_GET['m'].'/'.isset($_GET['c']) ?$_GET['c'] :'index';
			}
		}
		$path=$path && (substr($path,0,1)=="/") ?substr($path,1) :$path;
		self::checkPath($path);
	}
	
	private static function checkPath($path=TRUE)
	{
		if($path)
		{
			if(preg_match("/^[a-zA-Z0-9\-_?$#&\/\.@]+$/i", $path))
			{
				$path=explode("/", $path);
				if(!isset($path[1]) || empty($path[1]))
				{
					$path[1]='index';
				}
				self::$path=$path;
			}
			else 
			{
				self::$path=FALSE;
			}
		}
		else 
		{
			self::$path=array('index','index');
		}
	}
	
	public static function getPath()
	{
		return self::$path;
	}
	
	public static function segment($int,$default=0)
	{
		$int=$int-1;
		return isset(self::$path[$int]) ?self::$path[$int] :$default;
	}
}
