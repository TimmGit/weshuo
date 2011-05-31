<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class formCheck
{
	public function isMail($str) 
	{
      	if (preg_match("/^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/i", $str))
      	{
			return true;
      	}
		return false;
	}
	
	public function isHome($str)
	{
      	if (preg_match("/^([a-z0-9]+|[\x{4e00}-\x{9fa5}]+)$/iu", $str))
      	{
			return true;
      	}
		return false;	
	}
	
	public function isChinese($str)
	{
		if (preg_match("/^([\x{4e00}-\x{9fa5}]+)$/u", $str))
      	{
			return true;
      	}
		return false;
	}
}
