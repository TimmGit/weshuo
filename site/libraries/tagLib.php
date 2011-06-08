<?php
class tagLib
{
	/**
	 * @var tagMod
	 */
	private $tagMod;
	
	function __construct()
	{
		$this->tagMod=new tagMod();
	}
	
	public function checkTagExit($tagName)
	{
		return $this->tagMod->checkTagExit($tagName);
	}
	
	public function getAllTagCount()
	{
		return $this->tagMod->getAllTagCount();
	}
	
	public function getAllTag($start,$limit)
	{
		$limit=$start.','.$limit;
		return $this->tagMod->getAllTag($limit);
	}
	
	public function addTag($tagName,$userId,$home,$topicId)
	{
		if(empty($tagName) || empty($userId) || empty($home))
		{
			return false;
		}
		$info=$this->checkTagExit($tagName);
		if(!$info)
		{
			return $this->tagMod->addTag($tagName, $userId, $home, $topicId, time());
		}
		else 
		{
			$newTopicId=$info['topicId'].','.$topicId;
			$this->tagMod->updateTag($info['tagId'], $newTopicId);
			$count=is_numeric($info['count'])?$info['count']+1:1;
			return $this->tagMod->updateCount($count, $info['tagId']);
		}
		
	}
}