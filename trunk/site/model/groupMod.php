<?php
class groupMod
{
	/**
	 * 
	 * @var mysqlPdo
	 */
	private $db;
	private $tableName="group";
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function updateGroup($data,$id)
	{
		return $this->db->updateData($this->tableName,$data,array('groupId'=>$id));
	}
	
	public function getGroupInfo($groupId)
	{
		return $this->db->findData($this->tableName,array('groupId'=>$groupId));
	}
	
	public function getGroupInfoByName($name)
	{
		return $this->db->findData($this->tableName,array('groupName'=>$name));
	}
	
	public function getGroupByUserId($userId,$limit)
	{
		return $this->db->selectData($this->tableName,array('userId'=>$userId),'groupId desc',$limit);
	}
	
	public function getGroup($limit=FALSE)
	{
		return $this->db->selectData($this->tableName,'','groupId desc',$limit);
	}
	
	
}