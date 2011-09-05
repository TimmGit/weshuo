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
	
	public function getHotTag($limit=10)
	{
		return $this->tagMod->getHotTag($limit);
	}
	
	public function setTagInfo($data,$tagId)
	{
		return $this->tagMod->setTagInfo($data,$tagId);
	}
	
	public function delTag($tagId)
	{
		return $this->tagMod->delTag($tagId);
	}
	
	public function getTagAllCount()
	{
		return $this->tagMod->getTagAllCount();
	}
	
	public function getTagAllList($page,$limit)
	{
		$userLib=new userLib();
		$start=($page-1)*$limit;
		$limit=$start.','.$limit;
		$list=$this->tagMod->getTagAllList($limit);
		foreach ($list as $k=>$v)
		{
			$userInfo=$userLib->getUserInfo($v['userId'],'id');
			$list[$k]['userName']=$userInfo['userName'];
			$list[$k]['time']=date("Y-m-d",$v['time']);
		}
		return $list;
	}
	
	public function getInfoByName($tagName)
	{
		return $this->tagMod->getInfoByName($tagName);
	}
	
	public function getInfo($tagId)
	{
		return $this->tagMod->getInfo($tagId);
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