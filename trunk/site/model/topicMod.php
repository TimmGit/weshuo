<?php
class topicMod
{
	/**
	 * @var mysqlPdo
	 */
	private $db;
	private $table="topic";
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getTopicInfo($topicId)
	{
		return $this->db->findData($this->table,array('topicId'=>$topicId));
	}
	
	public function getTopicCount()
	{
		return $this->db->getOne("select count(*) from ".wsModel::dbPrefix().$this->table);
	}
	
	public function getTopisList($start,$limit)
	{
		$limit=$start.','.$limit;
		return $this->db->selectData($this->table,'','lastTime desc',$limit);
	}
	
	public function getTopicByLimit($userId,$limit=10)
	{
		return $this->db->selectData($this->table,array('userId'=>$userId),'time desc',$limit);
	}
	
	public function addTopic($title,$userId,$groupId,$parentId,$tagName,$zhuan,$status,$share,$client,$home,$address,$time,$lastTime)
	{
		return $this->db->insertData($this->table,
				array('title'=>$title,'userId'=>$userId,'time'=>$time,'groupId'=>$groupId,'parentId'=>$parentId,
				'zhuan'=>$zhuan,'tagName'=>$tagName,'status'=>$status,'share'=>$share,'client'=>$client,
				'home'=>$home,'address'=>$address,'lastTime'=>$lastTime)
			);
	}
}