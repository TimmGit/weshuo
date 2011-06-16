<?php

define('UC_CONNECT', 'mysql');
define('UC_DBHOST', '127.0.0.1');
define('UC_DBUSER', 'root');
define('UC_DBPW', '');
define('UC_DBNAME', 'ucdadeng');
define('UC_DBCHARSET', 'utf8');
define('UC_DBTABLEPRE', '`ucdadeng`.uc_');
define('UC_DBCONNECT', '0');
define('UC_KEY', 'fds0f230kfekf9suf9skdf');
define('UC_API', 'http://local.uc.weshuo.org');
define('UC_CHARSET', 'utf-8');
define('UC_IP', '127.0.0.1');
define('UC_APPID', '2');
define('UC_PPP', '20');


$dbhost = 'localhost';			// 数据库服务器
$dbuser = '';			// 数据库用户名
$dbpw = '';				// 数据库密码
$dbname = '';			// 数据库名
$pconnect = 0;				// 数据库持久连接 0=关闭, 1=打开
$tablepre = 'iw_';   		// 表名前缀, 同一数据库安装多个论坛请修改此处
$dbcharset = 'utf8';			// MySQL 字符集, 可选 'gbk', 'big5', 'utf8', 'latin1', 留空为按照论坛字符集设定


//同步登录 Cookie 设置
$cookiedomain = ''; 			// cookie 作用域
$cookiepath = '/';			// cookie 作用路径
