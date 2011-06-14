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
	
	public function delPlugById($id)
	{
		return $this->db->delPlugById($id);
	}
	
	public function updatePlubInfo($data,$id)
	{
		return $this->db->updateData($this->table, $data, array('plugId'=>$id));
	}
	
	public function getPlugInfoByPath($path)
	{
		return $this->db->findData($this->table, array('plugPath'=>$path));
	}
	
	public function getAllOnPlug()
	{
		return $this->db->selectData($this->table,array('status'=>1),'plugId desc');
	}
	
	public function getAllOffPlug()
	{
		return $this->db->selectData($this->table,array('status'=>2),'plugId desc');
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