<?php
class userExtMod
{
	/**
	 * 
	 * @var mysqlPdo
	 */
	private $db;
	private $table="userExt";
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getUserExtInfo($userId)
	{
		return $this->db->findData($this->table,array('userId'=>$userId));
	}
	
	public function getHostUserList($limit=10)
	{
		return $this->db->selectData($this->table,'','loginTime desc',10);
	}
	
	public function setUserExtInfo($data,$userId)
	{
		return $this->db->updateData($this->table, $data, array('userId'=>$userId));
	}
}
