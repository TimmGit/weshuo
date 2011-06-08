<?php
class attentionMod
{
	private $db;
	private $table="attention";
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getUserAttenList($userId,$limit=FALSE)
	{
		return $this->db->selectData($this->table,array('userId'=>$userId),'actionTime desc',$limit);
	}
	
	public function getUserObjUser($userId,$objUser)
	{
		return $this->db->findData($this->table,array('userId'=>$userId,'objUser'=>$objUser));
	}
	
	public function addUserAttention($userId,$objUser)
	{
		return $this->db->insertData($this->table,array('userId'=>$userId,'objUser'=>$objUser,'actionTime'=>time()));
	}
}