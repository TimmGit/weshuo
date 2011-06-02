<?php
class messageMod
{
	/**
	 * 
	 * @var mysqlPdo
	 */
	private $db;
	private $table='message';
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getMsgOne($id)
	{
		return $this->db->findData($this->table, array('msgId'=>$id));
	}
	
	public function getMsgOneSub($id,$limit=FALSE)
	{
		return $this->db->selectData($this->table,array('parentId'=>$id),'time desc',$limit);
	}
	
	public function addMsg($data)
	{
		return $this->db->insertData($this->table, $data);
	}
	
	public function updateMsgStatus($field,$id)
	{
		return $this->db->updateData($this->table,array($field=>1), array('msgId'=>$id));
	}
	
	public function delMsg($id)
	{
		return $this->db->deleteData($this->table, array('msgId'=>$id));
	}
}