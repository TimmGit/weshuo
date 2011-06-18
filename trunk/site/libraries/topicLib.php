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
	
	public function delTopic($id)
	{
		return $this->topicMod->delTopic($id);
	}
	
	public function getListByGroup($id,$page,$limit)
	{
		$limit=($page-1)*$limit.','.$limit;
		return $this->topicMod->getListByGroup($id,$limit);
	}
	
	public function getCountByGroup($id)
	{
		return $this->topicMod->getCountByGroup($id);
	}
	
	public function getTopicByTopicId($topicId)
	{
		return $this->topicMod->getTopicBytopicId($topicId);
	}
	
	public function getUserHomeCount($userId)
	{
		$userList=array();
		$att=new attenLib();
		$attUser=$att->getUserAtt($userId);
		foreach ($attUser as $v)
		{
			$userList[]=$v['objUser'];
		}
		$userList=implode(',',$userList);
		return $this->topicMod->getTopicCountByAtt($userId,$userList);	
	}
	
	public function getUserHomeList($userId,$start,$limit)
	{
		$userList=array();
		$att=new attenLib();
		$attUser=$att->getUserAtt($userId);
		foreach ($attUser as $v)
		{
			$userList[]=$v['objUser'];
		}
		$userList=implode(',',$userList);
		$limit=$start.','.$limit;
		return $this->topicMod->getTopicListByAtt($userId,$userList,$limit);
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
	
	public function getTopicList($page,$limit,$order='lastTime desc')
	{
		$start=($page-1)*$limit;
		$list=$this->topicMod->getTopicList($start,$limit,$order);
		$userLib=new userLib();
		foreach ($list as $k=>$topic)
		{
			$userInfo=$userLib->getUserInfo($topic['userId'],'id');
			$list[$k]['icon']=$userInfo['icon'];
			$list[$k]['nickName']=$userInfo['nickName'] ?$userInfo['nickName'] :$userInfo['userName'];
		}
		return $list;
	}
	
	public function setTopic($data,$topicId)
	{
		if(is_array($data) && $topicId)
		{
			return $this->topicMod->setTopic($data,$topicId);
		}
		return FALSE;
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