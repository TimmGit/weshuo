<?php
class plugMod
{
	/**
	 * 
	 * @var mysqlPdo
	 */
	private $db;
	private $table="plugin";
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getAllPlug()
	{
		return $this->db->selectData($this->table, '','plugId desc');
	}
	
	public function checkPlugExit($path)
	{
		return $this->db->findData($this->table, array('plugPath'=>$path));
	}
	
	public function addPlug($data)
	{
		return $this->db->insertData($this->table, $data);
	}
}