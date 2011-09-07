<?php
class attachmentMod
{
	/**
	 * 
	 * @var mysqlPdo
	 */
	private $db;
	private $table='attachment';
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function addAbout($data)
	{
		return $this->db->insertData($this->table, $data);
	}
	
	public function getAttachment($where,$limit=8,$order='attId desc')
	{
		return $this->db->selectData($this->table, $where,$order,$limit);
	}
	
	public function checkExit($topicId,$userId)
	{
		return $this->db->findData($this->table, array('topicId'=>$topicId,'userId'=>$userId));
	}
}