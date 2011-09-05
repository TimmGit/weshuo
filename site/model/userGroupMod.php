<?php
class userGroupMod
{
	/**
	 * @var mysqlPdo
	 */
	private $db;
	private $table="userGroup";
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getUserListByGroupId($id)
	{
		return $this->db->selectData($this->table, array('groupId'=>$id),'ugId desc');
	}
	
	public function getUserPowerByGroupId($uerId,$groupId)
	{
		return $this->db->findData($this->table, array('userId'=>$uerId,'groupId'=>$groupId));
	}
}