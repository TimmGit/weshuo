<?php
class aboutMod
{
	/**
	 * 
	 * @var mysqlPdo
	 */
	private $db;
	private $table='aboutme';
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function addAbout($data)
	{
		return $this->db->insertData($this->table, $data);
	}
	
	public function checkExit($topicId,$userId)
	{
		return $this->db->findData($this->table, array('topicId'=>$topicId,'userId'=>$userId));
	}
}