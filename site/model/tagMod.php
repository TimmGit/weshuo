<?php
class tagMod
{
	/**
	 * @var mysqlPdo
	 */
	private $db;
	private $table="tag";
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getInfoByName($tagName)
	{
		return $this->db->findData($this->table, array('tagName'=>$tagName));
	}
	
	public function getInfo($tagId)
	{
		return $this->db->findData($this->table,array('tagId'=>$tagId));
	}
	
	public function getAllTag($limit)
	{
		return $this->db->selectData($this->table,'','tagId desc',$limit);
	}
	
	public function getAllTagCount()
	{
		return $this->db->getOne("select count(*) from".wsModel::dbPrefix().$this->table);
	}
	
	public function checkTagExit($tagName)
	{
		return $this->db->findData($this->table,array('tagName'=>$tagName));
	}
	
	public function addTag($tag,$userId,$home,$topicId,$time)
	{
		return $this->db->insertData($this->table,
				array('tagName'=>$tag,'userId'=>$userId,'home'=>$home,'topicId'=>$topicId,'time'=>$time));
	}

	public function updateCount($count,$tagId)
	{
		return $this->db->updateData($this->table, array('count'=>$count), array('tagId'=>$tagId));
	}
	
	public function updateTag($tagId,$newTopicId)
	{
		return $this->db->updateData($this->table,array('topicId'=>$newTopicId),array('tagId'=>$tagId));
	}
}