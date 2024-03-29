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
	
	public function delTopic($id)
	{
		return $this->db->deleteData($this->table, array('topicId'=>$id));
	}
	
	public function getCountByGroup($id)
	{
		return $this->db->getOne("select count(*) from ".wsModel::dbPrefix().$this->table." where groupId=".$id);
	}
	
	public function getListByGroup($id,$limit=FALSE)
	{
		return $this->db->selectData($this->table, array('groupId'=>$id),'lastTime desc,topicId desc',$limit);
	}
	
	public function getTopicBytopicId($topicId)
	{
		$sql="select * from ".wsModel::dbPrefix().$this->table." where instr('".$topicId."',topicId) order by lastTime desc,topicId desc";
		return $this->db->querySql($sql);
	}
	
	public function getTopicCountByAtt($userId,$attUser)
	{
		$sql="select count(*) from ".wsModel::dbPrefix().$this->table." where userId=".$userId." or instr('".$attUser."',userId) ";
		return $this->db->getOne($sql);
	}
	
	public function getTopicListByAtt($userId,$attUser,$limit)
	{
		$sql="select * from ".wsModel::dbPrefix().$this->table." where userId=".$userId." or instr('".$attUser."',userId) order by lastTime desc limit ".$limit;
		return $this->db->querySql($sql);
	}
	
	public function getTopicInfo($topicId)
	{
		return $this->db->findData($this->table,array('topicId'=>$topicId));
	}
	
	public function getTopicCount()
	{
		return $this->db->getOne("select count(*) from ".wsModel::dbPrefix().$this->table);
	}
	
	public function getTopicList($start,$limit,$where=FALSE,$order='lastTime desc')
	{
		$limit=$start.','.$limit;
		return $this->db->selectData($this->table,$where,$order,$limit);
	}
	
	public function getTopicByLimit($userId,$limit=10)
	{
		return $this->db->selectData($this->table,array('userId'=>$userId),'time desc',$limit);
	}
	
	public function setTopic($data,$id)
	{
		return $this->db->updateData($this->table, $data, array('topicId'=>$id));
	}
	
	public function addTopic($title,$userId,$groupId,$parentId,$tagName,$status,$share,$client,$home,$address,$time,$lastTime)
	{
		return $this->db->insertData($this->table,
				array('title'=>$title,'userId'=>$userId,'time'=>$time,'groupId'=>$groupId,'parentId'=>$parentId,
				'tagName'=>$tagName,'status'=>$status,'share'=>$share,'client'=>$client,
				'home'=>$home,'address'=>$address,'lastTime'=>$lastTime)
			);
	}
	
	public function setPingZhuanCount($topicId,$zhuan=FALSE)
	{
		$sql="update ".wsModel::dbPrefix().$this->table." set";
		if($zhuan)
		{
			$sql.=" zhuan=zhuan+1";
		}
		else 
		{
			$sql.=" ping=ping+1";
		}
		$sql.=" where topicId=".$topicId;
		return $this->db->execSql($sql);
	}
}