<?php
class topicMod
{
	private $db;
	private $table="topic";
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getTopicByLimit($userId,$limit=10)
	{
		return $this->db->selectData($this->table,array('userId'=>$userId),'time desc',$limit);
	}
}