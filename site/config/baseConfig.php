<?php
/**
 * 设置系统运行模式
 */
define("DEBUG_MODE",0);
/**
 * 设置系统URL风格
 */
define("URL_MODE",1);
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
 * 载入语言包
 */
$autoLang=array('form');