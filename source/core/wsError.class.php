<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class wsError
{
	private function __construct(){}
	
	public static function setErrorReport()
	{
		switch (DEBUG_MODE)
		{
			case 0:
				@ini_set("display_errors",'On');
				error_reporting(E_ALL);
				break;
			case 1:
				@ini_set("display_errors",'Off');
				set_error_handler(array('wsError','errorLog'));
				set_exception_handler(array('wsError','errorLogExc'));
				break;
			default:
				@ini_set("display_errors",'Off');
				error_reporting(E_ALL & ~ E_NOTICE);
		}
	}
	
	public static function errorLog($errno, $errstr, $errfile, $errline)
	{
		self::writeLog("errNo:".$errno.',errStr:,'.$errstr.',errFile:'.$errfile.',errLine:'.$errline);
	}
	
	public static function errorLogExc(Exception $e)
	{
		self::errorLog($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
	}
	
	private static function writeLog($message)
	{
		$message=client::getClientIp()."|".date("Y-m-d H:i:s").'|'.$message."\r\n";
		!is_dir(LOG_PATH) && wsFile::mkPath(LOG_PATH);
		error_log($message,3,LOG_PATH.'/log_'.date("Y-m-d").'.log');
	}
}