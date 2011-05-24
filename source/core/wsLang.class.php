<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.com
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb http://www.ciphp.com
*/ 
class wsLang
{
	private static $langArr=array();
	
	public static function setLangArr($lang)
	{
		self::$langArr=$lang;
	}
	
	public static function getLang($index)
	{
		return isset(self::$langArr[$index]) ? self::$langArr[$index] :self::$langArr['system_not_exit_lang'];
	}
	
	public static function loadLang($file)
	{
		$filename=LANG_PATH.'/'.setting::getLang().'/'.$file.'Lang.php';
		if(file_exists($filename))
		{
			return $filename;
		}
	}
}
