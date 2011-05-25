<?php
class topicLib
{
	function __construct()
	{
		require MODEL_PATH.'topicMod.php';
	}
	
	public function getTopicByUserId($userId,$limit=10)
	{
		$topic=new topicMod();
		return $topic->getTopicByLimit($userId,$limit);
	}
	
	public function addTopic($title,$userId,$groupId,$parentId,$tagName,$zhuan,$status,$share,$client,$home,$address)
	{
		if(empty($title) || empty($address))
		{
			return false;
		}
		$topic=new topicMod();
		$lastTime=date("Y-m-d H:i:s");
		return $topic->addTopic($title,$userId,$groupId,$parentId,$tagName,$zhuan,$status,$share,$client,$home,$address,time(),$lastTime);
	}
}