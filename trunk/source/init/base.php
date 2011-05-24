<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.com
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb http://www.ciphp.com
*/ 
/**
 * 载入设置类
 */
require WS_ROOT.'source/core/setting.class.php';
/**
 * 载入语言类
 */
require WS_ROOT.'source/core/wsLang.class.php';
/**
 * 载入输入类
 */
require WS_ROOT.'source/core/init.class.php';
/**
 * 载入文件操作类
 */
require WS_ROOT.'source/util/wsFile.class.php';
/**
 * 载入客户端函数库
 */
require_once WS_ROOT.'source/util/client.class.php';
/**
 * 载入错误处理类
 */
require WS_ROOT.'source/core/wsError.class.php';
/**
 * 载入环境检测类
 */
require WS_ROOT.'source/util/checkRun.class.php';
/**
 * 载入页面输出类
 */
require WS_ROOT.'source/core/wsEcho.class.php';
/**
 * 载入路由解析类
 */
require WS_ROOT.'source/core/wsRoute.class.php';
/**
 * 载入模版类
 */
require WS_ROOT.'source/core/wsTemplate.class.php';
/**
 * 数据库类
 */
require WS_ROOT.'source/core/wsModel.class.php';
/**
 * 载入URL函数类
 */
require_once WS_ROOT.'source/core/wsUrl.class.php';
/**
 * 载入辅助函数库
 */
require_once WS_ROOT.'source/function/function.php';
/**
 * 载入插件类
 */
require WS_ROOT.'source/core/wsPlugin.class.php';