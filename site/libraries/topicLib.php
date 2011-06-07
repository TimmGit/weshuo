<?php
class topicLib
{
	/**
	 * 
	 * @var topicMod
	 */
	private $topicMod;
	
	function __construct()
	{
		$this->topicMod=new topicMod();
	}
	
	public function getInfo($topicId)
	{
		return $this->topicMod->getTopicInfo($topicId);
	}
	
	public function getTopicByUserId($userId,$limit=10)
	{
		return $this->topicMod->getTopicByLimit($userId,$limit);
	}
	
	public function getTopicCount()
	{
		return $this->topicMod->getTopicCount();
	}
	
	public function getTopisList($page=1,$limit)
	{
		$start=($page-1)*$limit;
		return $this->topicMod->getTopisList($start,$limit);
	}
	
	public function addTopic($title,$userId,$groupId,$parentId,$tagName,$status,$share,$client,$home,$address)
	{
		if(empty($title) || empty($address))
		{
			return false;
		}
		$lastTime=date("Y-m-d H:i:s");
		return $this->topicMod->addTopic($title,$userId,$groupId,$parentId,$tagName,$status,$share,$client,$home,$address,time(),$lastTime);
	}
}