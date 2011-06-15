<?php
class commentLib
{
	/**
	 * @var commentMod
	 */
	private $mod;
	
	function __construct()
	{
		$this->mod=new commentMod();
	}
	
	public function setCommentById($data,$id)
	{
		return $this->mod->setCommentById($data,$id);
	}
	
	public function getCommentInfo($id)
	{
		return $this->mod->getCommentInfo($id);
	}
	
	public function delComment($id)
	{
		return $this->mod->delCommentById($id);
	}
	
	public function getCommentCount($userId=FALSE)
	{
		if($userId)
		{
			return $this->mod->getCommentCountByUserId($userId);
		}
		return $this->mod->getCommentCount();
	}
	
	public function getComment($topicId)
	{
		return $this->mod->getComment(array('topicId'=>$topicId));
	}
	
	public function getCommentList($userId=FALSE,$page=FALSE,$limit=FALSE,$order='commentId desc')
	{
		if($limit && $page)
		{
			$start=($page-1)*$limit;
			$limit=$start.','.$limit;
		}
		if($userId)
		{
			return $this->mod->getComment(array('userId'=>$userId),$limit,$order);
		}
		return $this->mod->getComment('',$limit,$order);
	}
	
	public function addComment($userId,$title,$parentId,$topicId,$home,$address,$status=1)
	{
		if($userId && $title && $topicId && $home)
		{
			$data=array('userId'=>$userId,'content'=>$title,'parentId'=>$parentId,'topicId'=>$topicId,
						'status'=>$status,'home'=>$home,'address'=>$address);
			return $this->mod->addComment($data);
		}
		return false;
	}
	
}