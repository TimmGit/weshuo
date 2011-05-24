<?php
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.com
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb
*/ 
define("WS_ROOT",substr(__FILE__,0,-9));
/**
 * 定义项目目录
 */
define("APP_PATH","site");
/**
 * 载入站点配置文件
 */
require WS_ROOT.'source/init/config.php';
/**
 * 载入基本类库
 */
require WS_ROOT.'source/init/base.php';
/**
 * 系统初始化
 */
require WS_ROOT.'source/init/init.php';
/**
 * 载入核心类
 */
require WS_ROOT.'source/core/wsCore.class.php';
$wsCore=new wsCore();
$wsCore->start();