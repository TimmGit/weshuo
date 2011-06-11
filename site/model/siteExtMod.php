<?php
class siteExtMod
{
	/**
	 * 
	 * @var mysqlPdo
	 */
	private $db;
	private $table='siteext';
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getInfo()
	{
		return $this->db->findData($this->table,'');
	}
	
	public function setInfo($data,$id)
	{
		return $this->db->updateData($this->table, $data, array('siteExtId'=>$id));
	}
}