<?php
class userGroupLib
{
	/**
	 * @var userGroupMod
	 */
	private $groupMod;
	
	function __construct()
	{
		$this->groupMod=new userGroupMod();
	}
	
	public function getUserListByGroupId($id)
	{
		$list=$this->groupMod->getUserListByGroupId($id);
		$userLib=new userLib();
		foreach ($list as $k=>$v)
		{
			$userInfo=$userLib->getUserInfo($v['userId'],'id');
			$list[$k]['home']=$userInfo['homePage'];
			$list[$k]['name']=$userInfo['nickName']?$userInfo['nickName']:$userInfo['userName'];
		}
		return $list;
	}
	
	public function getUserPowerByGroupId($uerId,$groupId)
	{
		if($uerId && $groupId)
		{
			return $this->groupMod->getUserPowerByGroupId($uerId, $groupId);
		}
		return false;
	}
}