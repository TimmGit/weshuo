<?php
class commentMod
{
	/**
	 * 
	 * @var mysqlPdo
	 */
	private $db;
	private $table='comment';
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function addComment($data)
	{
		$data['time']=time();
		return $this->db->insertData($this->table, $data);
	}
	
	public function getComment($where,$limit=FALSE)
	{
		return $this->db->selectData($this->table, $where,'commentId asc',$limit);
	}
	
	public function delComment($where)
	{
		return $this->db->deleteData($this->table, $where);
	}
}