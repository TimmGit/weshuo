<?php
class groupLib
{
	/**
	 * @var groupMod
	 */
	private $mod;
	
	function __construct()
	{
		$this->mod=new groupMod();
	}
	
	public function getInfoByName($name)
	{
		return $this->mod->getGroupInfoByName($name);
	}
	
	public function updateGroup($data,$id)
	{
		return $this->mod->updateGroup($data,$id);
	}
	
	public function getGroupInfo($groupId)
	{
		return $this->mod->getGroupInfo($groupId);
	}
	
	public function getGroupInfoByName($name)
	{
		return $this->mod->getGroupInfoByName($name);
	}
	
	public function getGroupCount($userId=FALSE)
	{
		if(!$userId)
		{
			return $this->mod->getGroupCount();
		}
		else 
		{
			return $this->mod->getGroupCountByUserId($userId);
		}
	}
		
	public function getGroupList($userId=FALSE,$limit=FALSE)
	{
		if($userId===false)
		{
			return $this->mod->getGroup($limit);
		}
		else 
		{
			return $this->mod->getGroupByUserId($userId,$limit);
		}
	}
}