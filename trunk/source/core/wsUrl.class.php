<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class wsUrl
{
	function __construct(){}
	
	public static function baseUrl()
	{
		$baseUrl = str_replace('\\','/',dirname($_SERVER['SCRIPT_NAME']));
		$baseUrl = trim($baseUrl,'/');
		$server  = $_SERVER['SERVER_NAME']? $_SERVER['SERVER_NAME']: $_SERVER['REMOTE_ADDR'];
		$server .= ($_SERVER['SERVER_PORT']=="80")?'':':'.$_SERVER['SERVER_PORT'];
		return  empty($baseUrl) ? 'http://'.$server.'/' : 'http://'.$server."/$baseUrl/";
	}
	
	public static function siteUrl($url='')
	{
		$urlPath='';
		if(empty($url))
		{
			$urlPath=self::baseUrl();
		}
		else 
		{
			if(URL_MODE==0)
			{
				$urlPath=self::baseUrl().$url;
			}
			else 
			{
				if(URL_MODE==1)
				{
					$urlPath=self::baseUrl().'index.php/'.$url;
				}
				else 
				{
					$urlPath=self::baseUrl().'index.php?p='.$url;
				}
			}
		}
		return $urlPath;
	}
}
