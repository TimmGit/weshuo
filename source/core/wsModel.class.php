<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class wsModel
{
	protected static $DB=NULL;
	protected static $dbConfig=array();
	
	public static function getInstance()
	{
		self::$dbConfig=setting::getDb();
		if(is_null(self::$DB))
		{
			/**
			 * 载入SQL工具类
			 */
			require_once WS_ROOT.'source/util/sqlTool.class.php';
			/**
			 * 载入数据库接口类
			 */
			require_once WS_ROOT.'source/database/dbInterface.php';
			/**
			 * 载入数据库驱动类
			 */
			require_once WS_ROOT.'source/database/'.self::$dbConfig['dbType'].'.class.php';
			new wsModel();
		}
		return self::$DB;
	}
	
	public static function dbPrefix()
	{
		return self::$dbConfig['dbPrefix'];
	}
	
	function __construct()
	{
		self::$DB=new self::$dbConfig['dbType'];
	}
}