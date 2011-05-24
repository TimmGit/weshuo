<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb
*/ 
/**
 * 定义语言包路径
 */
define("LANG_PATH",WS_ROOT.APP_PATH.'/language/');
/**
 * 定义模型路径
 */
define("MODEL_PATH", WS_ROOT.APP_PATH.'/model/');
/**
 * 定义视图路径
 */
define("VIEW_PATH", WS_ROOT.APP_PATH.'/view/');
/**
 * 定义日志路径
 */
define("LOG_PATH", WS_ROOT.APP_PATH.'/log/');
/**
 * 定义缓存路径
 */
define("CACHE_PATH",WS_ROOT.APP_PATH.'cache/');
/**
 * 类库路径
 */
define("LIB_PATH", WS_ROOT.APP_PATH.'/libraries/');
/**
 * 定义插件的路径
 */
define("PLUG_PATH", WS_ROOT.APP_PATH.'/plugin/');
/**
 * 定义文件上传路径
 */
define("UPLOAD_PATH",WS_ROOT.'static/upload/');
/**
 * 载入数据库信息
 */
require WS_ROOT.APP_PATH.'/config/dbConfig.php';
/**
 * 载入基本配置信息
 */
require WS_ROOT.APP_PATH.'/config/baseConfig.php';

