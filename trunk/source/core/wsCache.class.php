<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class wsCache
{
	private static $cache=array();
	
	public static function rwCache($name,$value=false,$path=false)
	{
		$path=$path?$path:CACHE_PATH;
		$fileName=$path.'/'.$name.'.php';
		if(is_null($value))
		{
			return unlink($fileName);
		}
		if($value===false)
		{
			$value=isset(self::$cache[$name]) ?self::$cache[$name] :false;
			if(!$value && file_exists($fileName))
			{
				$value=include $fileName;
			}
			return $value;
		}
		$dir=dirname($fileName);
        if(!is_dir($dir)) mkdir($dir);
        self::$cache[$name]=$value;
        return file_put_contents($fileName,"<?php\nreturn ".var_export($value,true).";\n?>");
	}
}