<?php
class weShuoLib
{
	/**
	 * 
	 * 发布微博
	 * @param string $content
	 * @param string $url
	 * @param string $short
	 * @param string $ipAddress
	 * @param array $sendUser
	 * @param string $client
	 * @param int $parentId
	 * @param int $share
	 * @param int $status
	 */
	public function sendWeibo($content,$url,$short,$ipAddress,$sendUser,$client='web',$parentId=0,$share=0,$status=1)
	{
		$returnWb=$this->sendWbLib($content, $url, $short, $ipAddress, $sendUser,$client,$parentId,$share,$status);
		if(!empty($returnWb['aboutMe']) && $returnWb['topicId'])
		{
			$this->aboutMe($returnWb['aboutMe'], $returnWb['topicId']);
		}
		return $returnWb['topicId'];
	}
	
	private function aboutMe($userArr,$topicId)
	{
		$aboutLib=new aboutLib();
		foreach ($userArr as $userId=>$nickName)
		{
			$aboutLib->addAbout($userId, $topicId);
		}
	}
	
	/**
	 * 
	 * 发布微博核心功能
	 * @param string $content
	 * @param string $url
	 * @param string $short
	 * @param string $ipAddress
	 * @param array $sendUser
	 * @param string $client
	 * @param int $zhuan
	 * @param int $share
	 * @param int $status
	 */
	private function sendWbLib($content,$url,$short,$ipAddress,$sendUser,$client='web',$parentId=0,$share=0,$status=1)
	{
		$topicExtra=new topicExtra();
		$tagExtra=new tagExtra();
		$tag='';
		$content= $tagExtra->getTopicTag($content);
		if(is_array($content))
		{
			$tag= $content['tag'];
			$content= $content['content'];
		}
		if($url)
		{
			$content=$topicExtra->replaceSortUrl($content, $short);
		}
		$content=$topicExtra->aboutMe($content);
		$userArr=array();
		if(is_array($content))
		{
			$userArr=$content['sendUser'];
			$content=$content['content'];
		}
		$address=$sendUser['province'].$sendUser['city'];
		$topicId=false;
		$topicId=$topicExtra->sendWeibo($content, $sendUser['userId'], $group, $parentId, $tag,$status,$share,$client, $sendUser['homePage'],$address,$ipAddress);
		if($topicId && $url)
		{
			$this->addShortUrl($url, $short);
		}
		if(!empty($tag) && $topicId)
		{
			$this->addTag($tag);
		}
		return array('topicId'=>$topicId,'aboutMe'=>$userArr);
	}
	
	private function addTag($tag)
	{
		$tagLib=new tagLib();
		foreach ($tag as $value)
		{
			$tagLib->addTag($value, $sendUser['userId'],$sendUser['homePage'], $topicId);
		}
	}
	
	private function addShortUrl($url,$short)
	{
		$linkLib=new linkLib();
		$linkLib->addLink($url,$short);
	}
	
	public function replayWeibo($content,$url,$short,$ipAddress,$sendUser,$parentId,$topicId,$status=1)
	{
		$topicExtra=new topicExtra();
		if($url)
		{
			$content=$topicExtra->replaceSortUrl($content, $short);
		}
		$content=$topicExtra->aboutMe($content);
		$userArr=array();
		if(is_array($content))
		{
			$userArr=$content['sendUser'];
			$content=$content['content'];
		}
		$address=$sendUser['province'].$sendUser['city'];
		$address=$address ?$address :$ipAddress;
		$commentLib=new commentLib();
		$commentId=$commentLib->addComment($sendUser['userId'], $content, $parentId, $topicId, $sendUser['homePage'], $address);
		if($commentId && $url)
		{
			$this->addShortUrl($url, $short);
		}
		if(!empty($userArr) && $commentId)
		{
			$this->aboutMe($userArr, $topicId);
		}
		return $commentId;
	}
}