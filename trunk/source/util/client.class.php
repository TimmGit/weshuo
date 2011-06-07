<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
/**
 * 获取客户端真实IP
 */
class client
{
	public static function getClientIp()
	{
		$ip='';
		if (getenv('HTTP_CLIENT_IP'))
		{
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif (getenv('HTTP_X_FORWARDED_FOR'))
		{
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_X_FORWARDED'))
		{
			$ip = getenv('HTTP_X_FORWARDED');
		}
		elseif (getenv('HTTP_FORWARDED_FOR'))
		{
			$ip = getenv('HTTP_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_FORWARDED'))
		{
			$ip = getenv('HTTP_FORWARDED');
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		if(preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/i",$ip))
		{
			return $ip;
		}
		return '127.0.0.1';
	}
	
	public static function getIPaddress($ip=false)
	{
		require_once LIB_PATH.'vendor/iplocation.class.php';
		$ip=$ip ?$ip :self::getClientIp();
		$format = "text";//默认text,json,xml,js
		$charset = CHARSET; //默认utf-8,gbk或gb2312
		$ipLocation=new ipLocation(WS_ROOT.'/static/ipData/QQWry.Dat');
		$address=$ipLocation->getaddress($ip);
		$address["area1"] = iconv('GB2312',$charset,$address["area1"]);
		$address["area2"] = iconv('GB2312',$charset,$address["area2"]);
		$add=$address["area1"].$address["area2"];
		if($add=="本机地址 ")
		{
			$add="银河";
		}
		return  $add;
	}
}