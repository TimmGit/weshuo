<?php
class linkMod
{
	/**
	 * @var mysqlPdo
	 */
	private $db;
	private $table='link';
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function addLink($data)
	{
		return $this->db->insertData($this->table, $data);
	}
	
	public function delLink($data,$where)
	{
		return $this->db->deleteData($this->table, $data, $where);
	}
}