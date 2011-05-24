<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb
*/ 
class checkRun
{
	private static $phpVersion;
	
	private function __construct(){}
	
	private static function getPHP()
	{
		$phpVersion=phpversion();
		self::$phpVersion=$phpVersion{0}*100+$phpVersion{2}*10+$phpVersion{4};
	}
	
	public static function checkPHP()
	{
		self::getPHP();
		if(self::$phpVersion<520)
		{
			throw new Exception(wsLang::getLang('system_php_is_lower'));
		}
	}
}
