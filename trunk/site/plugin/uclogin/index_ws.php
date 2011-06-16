<?php
class uclogin_index extends wsAction
{
	function __construct()
	{
		include_once WS_ROOT.'/config.inc.php';
        include_once WS_ROOT.'/uc_client/client.php';
	}
	
	public function ws_load()
	{
		if(isset($_COOKIE['Example_auth']) && userSessionLib::getLogin()===FALSE)
		{
			$loginIfo=uc_authcode($_COOKIE['Example_auth']);
			if($loginIfo)
			{
				list($uid,$userName)=explode("\t", $loginIfo);
				$userLib=new userLib();
				$userInfo=$userLib->getUserInfo($userName,'name');
				if($userInfo)
				{
					$userLib->setLogin($userInfo);
				}
			}
		}
	}
	
	public function login_success($param)
	{
		list($info,$password)=$param;
		list($uid, $username, $password, $email)= uc_user_login($info['userName'],$password);
		if($uid)
		{
			return uc_user_synlogin($uid);
		}
	}
	
	public function user_login($param)
	{
		list($loginName,$password,$loginOk)=$param;
		if(!$loginOk)
		{
			//登录失败时尝试UC验证
			if(stripos($loginName, '@')!==FALSE)
			{
				return $loginOk;
			}
			list($uid, $username, $password, $email)= uc_user_login($loginName,$password);
			if($uid > 0)
			{
				$userLib=new userLib();
				$userId=$userLib->addUser($username, $email, $password, $username, '');
				if($userId)
				{
					$loginOk=$userLib->getUserInfo($userId,"id");
				}
			}
		}
		return $loginOk;
	}
	
	public function ready_register_user($param)
	{
		echo "---------1";
		list($homePage,$mail,$userName)=$param;
        if($data = uc_get_user($userName)) 
        {
       	    $this->error("用户名已经存在");
        }
	}
	
	public function success_register_user($param)
	{
		echo "-------------2";exit;
		$msg=false;
		list($homePage,$mail,$userName,$userId,$password)=$param;
		$uid = uc_user_register($userName,$password,$mail);
		if($uid <= 0) {
			if($uid == -1)
			{
				$msg='用户名不合法';
			} 
			elseif($uid == -2) 
			{
				$msg='包含要允许注册的词语';
			} 
			elseif($uid == -3) 
			{
				return '用户名已经存在';
			} 
			elseif($uid == -4) 
			{
				$msg='Email 格式有误';
			} 
			elseif($uid == -5) 
			{
				$msg='Email 不允许注册';
			}
			elseif($uid == -6) 
			{
				$msg='该 Email 已经被注册';
			} 
			else
			{
				$msg='未知错误';
			}
			if($msg===FALSE)
			{
				return true;
			}
			else 
			{
				$this->error($msg);
			}
		}
	}
}