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
}