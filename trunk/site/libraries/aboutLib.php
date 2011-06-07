<?php
class aboutLib
{
	private $mod;
	
	function __construct()
	{
		$this->mod=new aboutMod();
	}
	
	public function addAbout($userId,$topicId)
	{
		if(!$this->mod->checkExit($topicId, $userId))
		{
			return $this->mod->addAbout(array('topicId'=>$topicId,'userId'=>$userId));
		}
		return TRUE;
	}
}