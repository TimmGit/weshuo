<?php
/**
 * 设置系统运行模式
 * 0:debug 1:online log 2:online
 */
define("DEBUG_MODE",1);
/**
 * 设置系统URL风格
 */
define("URL_MODE",2);
/**
 * 系统编码  UTF8 only
 */
define("CHARSET","UTF-8");
/**
 * 默认主题
 */
$theme='default';
/**
 * 默认语言
 */
$language="chinese";
/**
 * 系统时区
 * http://www.php.net/manual/en/timezones.php
 */
$timeZone='Asia/Chongqing';
/**
 * 语言包数组
 */
$lang=array();
/**
 * 加密KEY 
 */
define("key",'DSFL4%ref');
/**
 * 载入语言包
 */
$autoLang=array('form');