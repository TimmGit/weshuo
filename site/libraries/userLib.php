<?php
class userLib
{
	/**
	 * @var userMod
	 */
	private $user;
	
	function __construct()
	{
		require MODEL_PATH.'userMod.php';
		require MODEL_PATH.'userExtMod.php';
		require MODEL_PATH.'attentionMod.php';
		$this->user=new userMod();
	}
	
	public function checkUserOldPwd($userId,$userPwd)
	{
		return $this->user->checkUserLogin($userId, $userPwd);
	}
	
	public function updateUserInfo($data,$userId)
	{
		return $this->user->updateUserInfo($userId,$data);
	}
	
	public function checkExit($field,$mail)
	{
		return $this->user->checkExit($field,$mail);
	}
	
	public function checkNickNameIsExit($userId,$nickName)
	{
		return $this->user->checkNickNameIsExit($userId,$nickName);
	}
	
	public function getUserInfo($home,$type='home')
	{
		$type=strtolower($type);
		if($type=="home")
		{
			return $this->user->getUserInfoByHome($home);
		}
		elseif($type=="name")
		{
			return $this->user->getUserInfoByName($home);
		}
		elseif ($type=='id')
		{
			return $this->user->getUserInfoById($home);
		}
		else 
		{
			return $this->user->getUserInfoByMail($home);
		}
	}
	
	public function setUserIcon($icon,$userId)
	{
		return $this->user->updateUserInfo($userId,array('icon'=>$icon));
	}
	
	public function getUserAttList($userId,$limit=8)
	{
		$arr=array();
		$attMod=new attentionMod();
		$list=$attMod->getUserAttenList($userId, $limit);
		foreach ($list as $k=>$v)
		{
			$userInfo=$this->getUserInfo($v['objUser'],'id');
			$arr[$k]['nickName']=$userInfo['nickName'];
			$arr[$k]['homePage']=$userInfo['homePage'];
			$arr[$k]['icon']=$userInfo['icon'];
		}
		return $arr;
	}
	
	public function getUserExtInfo($userId)
	{
		$userExt=new userExtMod();
		return $userExt->getUserExtInfo($userId);
	}
	
	public function getHotUserList($limit=10)
	{
		$userExt=new userExtMod();
		return $userExt->getHostUserList($limit);
	}
	
	public function getUserByRand($limit=10)
	{
		return $this->user->getUserByRand($limit);
	}
}