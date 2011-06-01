<?php
class siteMod
{
	/**
	 * @var mysqlPdo
	 */
	private $db;
	private $table='site';
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getSiteInfo()
	{
		return $this->db->findData($this->table,'');
	}
	
	public function setSiteInfo($data)
	{
		$info=$this->getSiteInfo();
		return $this->db->updateData($this->table, $data, array('siteId'=>$info['siteId']));
	}
}