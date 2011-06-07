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