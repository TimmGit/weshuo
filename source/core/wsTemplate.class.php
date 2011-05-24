<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb
*/ 
class wsTemplate
{
	private function __construct(){}
	
	public static function loadTemplate($tpl,$var=false)
	{
		$file=self::loadFile($tpl);
		if($file)
		{
			if($var)
			{
				@extract($var);
			}
			ob_start();
			require_once $file;
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
			require_once $file;
		}
	}
	
	private static function loadFile($tplName)
	{
		$file=WS_ROOT.APP_PATH.'/theme/'.setting::getTheme().'/'.$tplName.'.tpl.php';
		if(!file_exists($file) && setting::getTheme()!='default')
		{
			$file=WS_ROOT.APP_PATH.'/theme/default/'.$tplName.'.tpl.php';
			if(!file_exists($file))
			{
				return FALSE;
			}
		}
		return $file;
	}
}
