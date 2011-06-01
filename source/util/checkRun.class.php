<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class checkRun
{
	
	private static function getPHP()
	{
		$phpVersion=phpversion();
		return $phpVersion{0}*100+$phpVersion{2}*10+$phpVersion{4};
	}
	
	public static function checkPHP()
	{
		if(self::getPHP()<520)
		{
			throw new Exception(wsLang::getLang('system_php_is_lower'));
		}
	}
	
	public static function checkGd()
	{
		$info=@gd_info();
		if(is_array($info))
		{
			return $info['GD Version'];
		}
		return FALSE;
	}
}
