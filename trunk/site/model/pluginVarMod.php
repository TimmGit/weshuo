<?php
class pluginVarMod
{
	/**
	 * @var mysqlPdo
	 */
	private $db;
	private $table="pluginVar";
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function checkVarExit($name,$key)
	{
		return $this->db->findData($this->table, array('name'=>$name,'varKey'=>$key));
	}
	
	public function addVar($data)
	{
		return $this->db->insertData($this->table, $data);
	}
	
	public function updateVar($value,$key,$name)
	{
		return $this->db->updateData($this->table, array('varContent'=>$value), array('varKey'=>$key,'name'=>$name));
	}
	
	public function delVar($key,$name)
	{
		return $this->db->deleteData($this->table, array('varKey'=>$key,'name'=>$name));
	}
	
	public function delVarByName($name)
	{
		return $this->db->deleteData($this->table, array('name'=>$name));
	}
}