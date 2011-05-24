<?php
class userExtMod
{
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
}
