<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb
*/ 
interface dbInterface
{
	/**
	 * 执行SQL语句 返回数组 用于select
	 * @param string $sql
	 */
	public function querySql($sql);
	/**
	 * 执行SQL语句 返回boolean
	 * @param string $sql
	 */
	public function execSql($sql);
	/**
	 * 返回一行记录
	 * @param string $sql
	 */
	public function getRow($sql);
	/**
	 * 返回指定的字段值
	 * @param string $sql
	 */
	public function getOne($sql,$int=0);
	/**
	 * 插入数据
	 * @param string $table
	 * @param array $data
	 */
	public function insertData($table,$data);
	/**
	 * 更新数据
	 * @param string $table
	 * @param array $data
	 * @param array or string $where
	 */
	public function updateData($table,$data,$where);
	/**
	 * 删除数据
	 * @param string $table
	 * @param array $data
	 * @param string or array $where
	 */
	public function deleteData($table,$data,$where);
	/**
	 * 获取数据
	 * @param string $table
	 * @param string or array $where
	 * @param string $order
	 * @param int $limit
	 */
	public function selectData($table,$where,$order=false,$limit=false);
	/**
	 * 返回一行数据
	 * @param string $table
	 * @param array or string $where
	 */
	public function findData($table,$where,$order=false);
	/**
	 * 返回影响的行数
	 */
	public function rowCount();
	/**
	 * 返回自增ID
	 */
	public function lastInsertId();
	/**
	 * 获取最后执行的SQL语句
	 */
	public function getLastSql();
}
