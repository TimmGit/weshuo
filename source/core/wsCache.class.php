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
	private $path;
	private static $cache=array();
	
	function __construct($path)
	{
		$this->path=$path;
	}
	/**
	 * 
	 * 操作配置文件
	 * @param string $name
	 */
	public static function wrConfig($name)
	{
		require_once WS_ROOT.APP_PATH.'/config/'.$name.'.config.php';
	}
	
	/**
	 * 
	 * 读写缓存
	 * @param string $name
	 * @param string $value
	 * @param string $path
	 */
	public static function rwCache($name,$value=false,$path=false)
	{
		$path=$path?$path:CACHE_PATH;
		$fileName=$path.'/'.$name.'.php';
		if(is_null($value))
		{
			return @unlink($fileName);
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
        file_put_contents($fileName,"<?php\nreturn ".var_export($value,true).";\n?>");
        @chmod($fileName,0777);
        return TRUE;
	}
}