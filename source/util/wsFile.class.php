<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class wsFile
{	
	/**
	 * 创建目录
	 * @param string $path
	 */
	public static function mkPath($path)
	{
		if(!is_dir($path))
		{
			mkdir($path,0777);
			chmod($path,0777);
		}
	}
	
	/**
	 * 判断文件名是否合格
	 * @param $name
	 */
	public static function checkFileNameIsUpload($name)
	{
		$name=strtolower($name);
		if(preg_match("/^[a-zA-Z0-9_]+\.[a-z]{2,4}$/i", $name))
		{
			return true;
		}
		return false;
	}
	
	/**
	 * 循环读取目录
	 * @param string $path
	 * @param int $deep
	 */
	public static function readPath($path,$deep=3)
	{
		static $return=array();
		if($path && $deep)
		{
			$deep--;
			$hander=opendir($path);
			while (($file = readdir($hander)) !== false) 
			{
				if(substr($file,0,1)!='.')
				{
					
					if(is_dir($path.'/'.$file))
					{
						self::readPath($path.'/'.$file,$deep);
					}
					else 
					{
						$return[]=$path.'/'.$file;
					}
				}
			}
		}
		return $return;
	}
	
	
	/**
	 * 引入一个类文件
	 * @param string $class
	 * @param string $folder
	 * @param boolean $obj
	 */
	public static function import($class,$obj=false,$folder='util')
	{
		require_once WS_ROOT.'source/'.$folder.'/'.$class.'.class.php';
		if($obj)
		{
			$class=new $class;
			return $class;
		}
	}
	
	/**
	 * 载入JS 或者 CSS 文件
	 * @param string $file
	 * @return string
	 */
	public static function loadStaticFile($file)
	{
		$fileArr=explode(".",$file);
		if(strtoupper($fileArr[count($fileArr)-1])=="JS")
		{
			return "<script src=\"".baseUrl()."static/".$file."\" type=\"text/javascript\"></script>\r\n";
		}
		else 
		{
			return "<link href=\"".baseUrl()."static/".$file."\" rel=\"stylesheet\" type=\"text/css\" />\r\n";
		}
	}
}
