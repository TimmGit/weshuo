<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.com
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb http://www.ciphp.com
*/
class cache
{
	private $path;
	
	function __construct($path)
	{
		$this->path=$path;
	}
	
	public static function wrConfig($name)
	{
		require_once WS_ROOT.APP_PATH.'/'.$name.'.config.php';
	}
	
	public static function wrFile($name,$value)
	{
		
	}
}