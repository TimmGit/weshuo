<?php
class userGroupMod
{
	/**
	 * @var mysqlPdo
	 */
	private $db;
	private $table="usergroup";
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getUserListByGroupId($id)
	{
		return $this->db->selectData($this->table, array('groupId'=>$id),'ugId desc');
	}
}