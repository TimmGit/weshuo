<?php
class userSessionLib
{	
	
	private static $key="weshuo";
	
	private static function setSession($keyName,$value)
	{
		$_SESSION[self::$key][$keyName]=$value;
	}
	
	private static function getSession($keyName)
	{
		return isset($_SESSION[self::$key][$keyName]) ?$_SESSION[self::$key][$keyName] :false;
	}
	
	public static function setAdmUser($flog=FALSE)
	{
		self::setSession('admin', $flog);
	}
	
	public static function getAdmUsre()
	{
		return self::getSession('admin');
	}
	
	/**
	 * 设置用户ID 
	 * @param int $userId
	 * @return void
	 */
	public static function setUserId($userId)
	{
		self::setSession('userId',$userId);
	}
	
	/**
	 * 
	 * 获取用户ID
	 * @return int
	 */
	public static function getUserId()
	{
		return self::getSession('userId');
	}
	
	/**
	 * 设置用户基本信息
	 * @param array $info
	 */
	public static function setUserInfo($info)
	{
		self::setSession('info', $info);
	}
	
	/**
	 * 
	 * 获取用户基本信息
	 * @return array
	 */
	public static function getUserInfo()
	{
		return self::getSession('info');
	}
	
	/**
	 * 设置用户是否登录
	 * @param boolean $login
	 * @return void
	 */
	public static function setLogin($login)
	{
		self::setSession('isLogin',$login);
	}
	
	/**
	 * 获取用户登录状态
	 * @return boolean
	 */
	public static function getLogin()
	{
		return self::getSession('isLogin');
	}
	
	/**
	 * 设置用户扩展信息
	 * @param array $extInfo
	 * @return void
	 */
	public static function setUserExt($extInfo)
	{
		return self::setSession('extInfo', $extInfo);
	}
	
	/**
	 * 
	 * 获取用户扩展信息
	 * @return array
	 */
	public static function getUserExt()
	{
		return self::getSession('extInfo');
	}
	
	public function __destruct()
	{
		session_unset();
    	session_destroy();
	}
}