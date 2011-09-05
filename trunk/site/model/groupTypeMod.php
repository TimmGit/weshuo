<?php
class groupTypeMod
{
	/**
	 * 
	 * @var mysqlPdo
	 */
	private $db;
	private $table='groupType';
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function addGroupType($data)
	{
		return $this->db->insertData($this->table, $data);
	}
	
	public function getGroupType($order='sort desc')
	{
		return $this->db->selectData($this->table,'',$order);
	}
	
	public function getTypeInfo($name)
	{
		if($name)
		{
			return $this->db->findData($this->table, array('name'=>$name));
		}
	}
	
	public function delGroupType($id)
	{
		if($id)
		{
			return $this->db->deleteData($this->table, array('id'=>$id));
		}
	}
}