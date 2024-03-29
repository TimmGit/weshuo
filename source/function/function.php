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
function baseUrl($url='')
{
	return wsUrl::baseUrl().$url;
}

/**
 * 导入一个文件
 * @param string $file
 * @param boolean $boj
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
	return wsPlugin::exexPlugFun($hookName, $param);
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
/**
 * 获取URL中的一段
 * @param int $int
 * @param string $defult
 */
function segment($int=1,$defult='')
{
	return wsRoute::segment($int,$defult);
}
/**
 * 读写缓存
 * @param string $name
 * @param string $value
 * @param string $path
 */
function c($name,$value=false,$path=false)
{
	return wsCache::rwCache($name,$value,$path);
}

/**
 * 来源ThinkPHP
 +----------------------------------------------------------
 * 对查询结果集进行排序
 +----------------------------------------------------------
 * @access public
 +----------------------------------------------------------
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 +----------------------------------------------------------
 * @return array
 +----------------------------------------------------------
 */
function list_sort_by($list,$field, $sortby='asc') {
   if(is_array($list)){
       $refer = $resultSet = array();
       foreach ($list as $i => $data)
           $refer[$i] = &$data[$field];
       switch ($sortby) {
           case 'asc': // 正向排序
                asort($refer);
                break;
           case 'desc':// 逆向排序
                arsort($refer);
                break;
           case 'nat': // 自然排序
                natcasesort($refer);
                break;
       }
       foreach ( $refer as $key=> $val)
           $resultSet[] = &$list[$key];
       return $resultSet;
   }
   return false;
}