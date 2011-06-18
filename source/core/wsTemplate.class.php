<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class wsTemplate
{
	private static $data=array();
	public static function loadTemplate($tpl,$var=array(),$data=array())
	{
		$file=self::loadFile($tpl);
		if($file)
		{
			$var=array_merge($data,$var);
			if($var)
			{
				self::$data=$var;
				@extract($var);
			}
			ob_start();
			require $file;
			$buffer = ob_get_contents();
			@ob_end_clean();
			return $buffer;
		}
		else 
		{
			return false;
		}
	}
	
	public static function loadSubTemplate($tpl)
	{
		$file=self::loadFile($tpl);
		if($file)
		{
			@extract(self::$data);
			require $file;
		}
	}
	
	private static function loadFile($tplName)
	{
		$file='';
		if(stripos($tplName, PLUG_PATH)!==false)
		{
			$file=$tplName.'.tpl.php';
		}
		else 
		{
			$file=WS_ROOT.APP_PATH.'/theme/'.setting::getTheme().'/'.$tplName.'.tpl.php';
			if(!file_exists($file) && setting::getTheme()!='default')
			{
				$file=WS_ROOT.APP_PATH.'/theme/default/'.$tplName.'.tpl.php';
			}
		}
		if(!file_exists($file))
		{
			return FALSE;
		}
		return $file;
	}
}
