<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb http://www.ciphp.com
*/ 
class wsForm
{
	public static $int=1; //整数
	public static $string=2;//字符
	public static $intArr=3;//int数组
	public static $stringArr=4;//字符数组
	public static $intMax=PHP_INT_MAX;
	private static $value='';
	
	/**
	 * 检测字段长度和其他属性
	 * @param string $name
	 * @param string $post
	 * @param string $msg
	 * @param array $checkLen
	 * @param array $oterhFun
	 * @param boolean $double
	 * @throws Exception
	 */
	public static function formField($name,$post,$msg,$checkLen,$oterhFun=false,$ajax=false)
	{
		if(!is_array($post))
		{
			$post=strtoupper($post);
		}
		if($post=="POST")
		{
			self::$value=isset($_POST[$name])?$_POST[$name]:'';
		}
		elseif ($post=="GET")
		{
			self::$value=isset($_GET[$name])?$_GET[$name]:'';
		}
		elseif (is_int($post))
		{
			self::$value=wsRoute::segment($post);
		}
		else 
		{
			self::$value=wsRoute::segment($post[0],$post[1]);
		}
		if(self::checkValueLen($msg, $checkLen)===false)
		{
			if($ajax)
			{
				echo $msg;exit;
			}
			throw new Exception($msg);
		}
		if($oterhFun)
		{
			list($class,$fun,$funMsg)=$oterhFun;
			if(!$class->$fun(self::$value))
			{
				if($ajax)
				{
					echo $funMsg;exit;
				}
				throw new Exception($funMsg);
			}
		}
		return self::$value;
	}
	
	private static function checkValueLen($msg,$checkLen)
	{
		$double=FALSE;
		list($valueType,$min,$max)=$checkLen;
		$double=(count($checkLen)==4) ?true:FALSE;
		if($valueType==self::$int)
		{
			return self::checkIntLen($min, $max);
		}
		elseif ($valueType==self::$string)
		{
			return self::checkStringLen($min, $max, $double);
		}
		else 
		{
			return self::checkArray($valueType,$min,$max);
		}
	}
	
	private static function checkArray($valueType,$min,$max)
	{
		if(is_array(self::$value))
		{
			foreach (self::$value as $k=>$v)
			{
				if($valueType==self::$intArr)
				{
					if(self::checkIntLen($min, $max,$v)===false)
					{
						return false;
						break;
					}
				}
				else 
				{
					if(self::checkStringLen($min, $max, $double,$v)===false)
					{
						return false;
						break;
					}
				}
			}
			return true;
		}
		return false;
	}
	
	private static function checkIntLen($min,$max,$value=false)
	{
		$intValue=$value ?$value :self::$value;
		$intValue=empty($intValue) ?0:$intValue;
		if($intValue>=$min && $max>=$intValue)
		{
			return true;
		}
		return false;
	}
	
	private static function checkStringLen($min,$max,$double,$value=false)
	{
		$stringValue=$value ?$value :self::$value;
		$valueLen=0;
		if($double)
		{
			$length = strlen(preg_replace('/[\x00-\x7F]/', '', $stringValue));
		    if ($length)
		    {
		        $valueLen=strlen($stringValue) - $length + intval($length / 3) * 2;
		    }
		    else
		    {
		        $valueLen=strlen($stringValue);
		    }
		}
		else 
		{
			if(function_exists("mb_strlen"))
		        $valueLen=mb_strlen($stringValue,CHARSET);
		    elseif(function_exists('iconv_strlen'))
		        $valueLen=iconv_strlen($stringValue,CHARSET);
			else
				$valueLen=self::getstrlen($stringValue);
		}
		if($valueLen>=$min && $max>=$valueLen)
		{
			return true;
		}
		return false;
	}
	
	private static function getstrlen($str)
	{
	    $length = strlen(preg_replace('/[\x00-\x7F]/', '', $str));
	    if ($length)
	    {
	        return strlen($str) - $length + intval($length / 3);
	    }
	    else
	    {
	        return strlen($str);
	    }
	}
}