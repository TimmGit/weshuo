<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class wsEcho
{
	private static $httpCode=array('200'=>'OK','301'=>'Moved Permanently','302'=>'Found','304'=>'Not Modified',
									 '400'=>'Bad Request','403'=>'Forbidden','404'=>'Not Found','500'=>'Internal Server Error',);

	public function setHttpCode($code)
	{
		 if(isset(self::$httpCode[$code]))
		 {
		 	header('HTTP/1.1 ' . $code . ' ' . self::$httpCode[$code], true, $code);
		 }
	}
	
	public static function showMsg($msg,$code='404')
	{
		self::setHttpCode($code);
		header("Content-type:text/html;charset=".CHARSET);
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">';
		echo '<html><head><title>'.$code.' '.self::$httpCode[$code].'</title><style type="text/css">body{width:800px;margin:0 auto}</style></head><body>
		    <h2>'.self::$httpCode[$code].'</h2><p>'.nl2br($msg).'</p><hr/>微说开源微博系统  http://www.weshuo.org</body></html>';
		exit;
	}
	
	public static function redirectPage($code=301,$location)
	{
		self::setHttpCode($code);
		header('Location:'.$location,false,$code);
		header("Content-type:text/html;charset=".CHARSET);
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">';
		echo '<html><head><title>'.$code.' '.self::$httpCode[$code].'</title></head><body><h2>'.self::$httpCode[$code].'</h2>';
		echo '<p>The document has moved <a href="' . $location . '">here</a>.</p></body></html>';
		exit;
	}
}