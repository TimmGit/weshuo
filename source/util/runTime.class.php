<?php
class runTime
{
	public static $time;
	public static $memory;
	public static $sql;
	
	public static function getSecondTime()
	{
		if(function_exists('gettimeofday'))
		{
			list($usec, $sec) = explode(" ", microtime());
	    	return ((float)$usec + (float)$sec);
		}
		return 0;
	}
	
	public static function getNowMem()
	{
		return function_exists('memory_get_usage')? memory_get_usage()/1024 :0;
	}
}