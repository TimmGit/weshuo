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
	
	public function addTag($tag,$userId,$home,$topicId)
	{
		if(!$this->tagMod->checkTagExit($tag))
		{
			return $this->tagMod->addTag($tag, $userId, $home, $topicId, time());
		}
	}
}