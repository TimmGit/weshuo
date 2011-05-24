<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.com
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb http://www.ciphp.com
*/ 
class setting
{
	private static $theme='';
	private static $lang='';
	private static $dbConfig=array();
	
	public static function setDb($dbConfig)
	{
		self::$dbConfig=$dbConfig;
	}
	
	public static function getDb()
	{
		return self::$dbConfig;
	}
	
	public static function setTheme($theme)
	{
		self::$theme=$theme ?$theme :'default';
	}
	
	public static function getTheme()
	{
		return self::$theme;
	}
	
	public static function setLang($lang)
	{
		if(init::getUserLang()!==FALSE)
		{
			self::$lang=init::getUserLang();
		}
		else
		{
			self::$lang=$lang ?$lang :'chinese';
		}
	}
	
	public static function getLang()
	{
		return self::$lang;
	}
}