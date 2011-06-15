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
	
	public function setCommentById($data,$id)
	{
		return $this->db->updateData($this->table, $data, array('commentId'=>$id));
	}
	
	public function getCommentInfo($id)
	{
		return $this->db->findData($this->table, array('commentId'=>$id));
	}
	
	public function delCommentById($id)
	{
		return $this->db->deleteData($this->table, array('commentId'=>$id));
	}
	
	public function getCommentCount()
	{
		return $this->db->getCount($this->table);
	}
	
	public function getCommentCountByUserId($userId)
	{
		return $this->db->getCount($this->table,array('userId'=>$userId));
	}
	
	public function addComment($data)
	{
		$data['time']=time();
		return $this->db->insertData($this->table, $data);
	}
	
	public function getComment($where,$limit=FALSE,$order="commentId asc")
	{
		return $this->db->selectData($this->table, $where,$order,$limit);
	}
}