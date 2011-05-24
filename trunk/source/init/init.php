<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/ 
/**
 * 设置数据库信息
 * @param array $dbConfig
 */
setting::setDb($dbConfig);
/**
 * 设置系统语言
 * @param string $language
 */
setting::setLang($language);
/**
 * 设置系统主题
 * @param string $theme
 */
setting::setTheme($theme);
/**
 * 初始化输入
 */
init::initInput();
/**
 * 设置错误报告方式
 */
wsError::setErrorReport();
/**
 * session start
 */
session_start();
/**
 * set timezone
 */
date_default_timezone_set($timeZone);
/**
 * 设置页面编码
 */
init::setHeader();
/**
 * 运行环境检测
 */
checkRun::checkPHP();
/**
 * 载入基本语言文件
 */
require LANG_PATH.'/'.setting::getLang().'/baseLang.php';
/**
 * 载入语言文件
 */
foreach ($autoLang as $v)
{
	if($v)
	{
		require wsLang::loadLang($v);
	}
}
/**
 * 载入语言包
 */
wsLang::setLangArr($lang);