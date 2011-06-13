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
	
	public static function loadPlug()
	{
		self::$plug=array('friend');
	}
	
	public static function getPlugin()
	{
		if(!self::$plug)
		{
			self::loadPlug();
		}
		return self::$plug;
	}
	
	public static function readPlugInfo($plugPath)
	{
		$plugInfo=array('name'=>'','description'=>'','link'=>'','version'=>'','author'=>'');
		$content=file_get_contents(PLUG_PATH.'/'.$plugPath);
		if(preg_match("/@name\s\w+/i", $content,$name))
		{
			$plugInfo['name']=$name[0];
		}
		if(preg_match("/@description\s\w+/i", $content,$description))
		{
			$plugInfo['description']=$description[0];
		}
		if(preg_match("/@link\s\w+/i", $content,$link))
		{
			$plugInfo['link']=$link[0];
		}
		if(preg_match("/@version\s\w+/i", $content,$version))
		{
			$plugInfo['version']=$version[0];
		}
		if(preg_match("/@author\s\w+/i", $content,$author))
		{
			$plugInfo['author']=$author[0];
		}
		return $plugInfo;
	}
}