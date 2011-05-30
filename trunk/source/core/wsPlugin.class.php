<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb
*/ 
class wsPlugin
{
	private static $plug=false;
	
	public static function loadPlug()
	{
		self::$plug=array('friend');
	}
	
	public static function wsHeader($str)
	{
		return $str;
	}
	
	public static function wsFooter($str)
	{
		return $str;
	}
	
	public static function getPlugin()
	{
		if(!self::$plug)
		{
			self::loadPlug();
		}
		return self::$plug;
	}
}