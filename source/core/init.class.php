<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb
*/ 
class init
{
	private function __construct(){}
	
	public static function initInput()
	{
		if(isset($_GET['GLOBALS'])) unset($_GET['GLOBALS']);
		if(isset($_POST['GLOBALS'])) unset($_POST['GLOBALS']);
		if(isset($_COOKIE['GLOBALS'])) unset($_COOKIE['GLOBALS']);
		if(isset($_FILES['GLOBALS'])) unset($_FILES['GLOBALS']);
				
		if(!self::getGPC())
		{
			$_GET = self::daddslashes($_GET);
			$_POST = self::daddslashes($_POST);
			$_COOKIE = self::daddslashes($_COOKIE);
		}
	}
	
	public static function getGPC()
	{
		return function_exists('get_magic_quotes_gpc')?get_magic_quotes_gpc():0;
	}
	
	public static function daddslashes(&$string)
	{
		return is_array($string) ? array_map(array('init','daddslashes'), $string) : addslashes($string);
	}
	
	public static function setHeader($type="text/html")
	{
		header("Content-type:".$type."; charset:".CHARSET);
	}
	
	public static function getUserLang()
	{
		$lang=isset($_GET['lang']) ?$_GET['lang'] :false;
		if(!$lang)
		{
			$lang=isset($_COOKIE['weshuoLang']) ?$_COOKIE['weshuoLang'] :false;
		}
		else
		{
			setcookie("weshuoLang",$lang, time()+3600*24*7);
		}
		if($lang && preg_match("/^[a-zA-z]+$/i", $lang))
		{
			return $lang;
		}
		return false;
	}
}
