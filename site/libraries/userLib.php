<?php
class userLib
{
	/**
	 * @var userMod
	 */
	private $user;
	
	function __construct()
	{
		$this->user=new userMod();
	}
	
	/**
	 * 
	 * 增加用户
	 * @param string $userName
	 * @param string $mail
	 * @param string $password
	 * @param string $userName
	 * @param string $homePage
	 */
	public function addUser($userName,$mail,$password,$userName,$homePage)
	{
		if($userName && $mail && $homePage && $userName)
		{
			$data=array('userName'=>$userName,'mail'=>$mail,'password'=>md5($password),'icon'=>'','createTime'=>time(),
						'createIp'=>client::getClientIp(),'groupId'=>0,'roleId'=>0,'score'=>0,'nickName'=>$userName,
						'status'=>1,'tags'=>'','province'=>'','city'=>'','homePage'=>$homePage);
			return $this->user->addUser($data);
		}
		return  FALSE;
	}
	
	/**
	 * 检查用户旧密码
	 * @param int $userId
	 * @param string $userPwd
	 */
	public function checkUserOldPwd($userId,$userPwd)
	{
		return $this->user->checkUserLogin($userId, $userPwd);
	}
	
	/**
	 * 更新用户信息
	 * @param array $data
	 * @param int $userId
	 */
	public function updateUserInfo($data,$userId)
	{
		return $this->user->updateUserInfo($userId,$data);
	}
	
	/**
	 * 
	 * 检测某个字段对应的值是否存在
	 * @param string $field
	 * @param string $content
	 */
	public function checkExit($field,$content)
	{
		return $this->user->checkExit($field,$content);
	}
	/**
	 * 
	 * 检测昵称是否可用
	 * @param int $userId
	 * @param string $nickName
	 */
	public function checkNickNameIsExit($userId,$nickName)
	{
		return $this->user->checkNickNameIsExit($userId,$nickName);
	}
	/**
	 * 
	 * 获取用户信息
	 * @param string $home
	 * @param string $type
	 */
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
		elseif ($type=='nick')
		{
			return $this->user->getUserInfoByNick($home);
		}
		else 
		{
			return $this->user->getUserInfoByMail($home);
		}
	}
	/**
	 * 
	 * 设置用户头像信息
	 * @param string $icon
	 * @param string $userId
	 */
	public function setUserIcon($icon,$userId)
	{
		return $this->user->updateUserInfo($userId,array('icon'=>$icon));
	}
	
	/**
	 * 获取用户关注的用户信息
	 * @param int $userId
	 * @param string $limit
	 */
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
	
	/**
	 * 获取用户的扩展信息
	 * @param int $userId
	 * @return array
	 */
	public function getUserExtInfo($userId)
	{
		$userExt=new userExtMod();
		return $userExt->getUserExtInfo($userId);
	}
	
	/**
	 * 
	 * 获取最近登录用户 活跃用户
	 * @param int $limit
	 * @return array
	 */
	public function getHotUserList($limit=10)
	{
		$userExt=new userExtMod();
		return $userExt->getHostUserList($limit);
	}
	/**
	 * 
	 * 获取随机用户
	 * @param int $limit
	 * @return array
	 */
	public function getUserByRand($limit=10)
	{
		return $this->user->getUserByRand($limit);
	}
	
	/**
	 * 检测用户登录
	 * @param string $user
	 * @param string $pwd
	 * @param string $loginType
	 */
	public function checkUserLogin($user,$pwd,$loginType='mail')
	{
		$loginType=strtolower($loginType);
		if($loginType=='mail')
		{
			return $this->checkLoginByMail($user, $pwd);
		}
		else 
		{
			return $this->checkLoginByUser($user, $pwd);
		}
	}
	
	/**
	 * 根据mail登录
	 * @param string $mail
	 * @param string $password
	 */
	private function checkLoginByMail($mail,$password)
	{
		return $this->user->checkLoginByMail($mail, $password);
	}
	
	/**
	 * 
	 * 根据帐号登录
	 * @param string $userName
	 * @param string $password
	 */
	private function checkLoginByUser($userName, $password)
	{
		return $this->user->checkLoginByUserName($userName, $password);
	}
}