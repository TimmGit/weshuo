<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb
*/ 
/**
 * 返回语言
 * @param string $index
 */
function lang($index)
{
	return wsLang::getLang($index);
}

/**
 * 生成URL地址
 * @param string $url
 */
function siteUrl($url='')
{
	return wsUrl::siteUrl($url);
}
/**
 * 返回根URL地址
 */
function baseUrl()
{
	return wsUrl::baseUrl();
}

/**
 * 导入一个文件
 * @param string $file
 * @param booean $boj
 * @param string $folder
 */
function import($file,$obj=FALSE,$folder='util')
{
	return wsFile::import($file,$obj,$folder);
}
/**
 * 包含子模板
 * @param string $tpl
 */
function subView($tpl)
{
	wsTemplate::loadSubTemplate($tpl);
}
/**
 * 执行插件
 * @param $hookName
 * @param $param
 */
function hook($hookName,$param=array())
{
	foreach (wsPlugin::getPlugin() as $file)
	{
		$fileName=PLUG_PATH.$file.'_ws.php';
		if(file_exists($fileName))
		{
			require_once $fileName;
			$plugObj=new $file;
			if(method_exists($plugObj,$hookName))
			{
				return $plugObj->$hookName();
			}
		}
	}
}

/**
 * 载入JS或者CSS文件
 * @param strig $file
 */
function load($file)
{
	echo wsFile::loadStaticFile($file);
}

/**
 * 
 * 过滤字符
 * @param string $string
 */
function replaceHtml($string)
{
	$string=strip_tags($string);
	$string=string::safeHtml($string);
	return string::RemoveXSS($string);
}

function segment($int=1,$defult='')
{
	return wsRoute::segment($int,$defult);
}