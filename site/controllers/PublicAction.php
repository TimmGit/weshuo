<?php
class PublicAction extends CommonAction
{
	public function index()
	{
		$this->register();
	}
		
	public function admLogin()
	{
		if($_POST)
		{
			$amdPwd=$this->checkForm("admpwd","post","密码长度错误",array(wsForm::$string,6,16));
			$userPwd=userSessionLib::getUserInfo();
			$userPwd=$userPwd['password'];
			if(md5($amdPwd)!=$userPwd)
			{
				$this->error('密码错误,登录失败！');
			}
			else 
			{
				userSessionLib::setAdmUser(TRUE);
				$this->redirect('cp');
			}
		}
		else 
		{
			$this->isLogin();
			$this->loadView('adm_login');
		}
	}
	
	public function saveFind()
	{
		$this->isLogin();
		$userArr=$this->checkForm("userid","post","用户ID必须是数字",array(wsForm::$intArr,1,PHP_INT_MAX));
		require LIB_PATH.'userAdmLib.php';
		$userAdmLib=new userAdmLib();
		$userAdmLib->addAttention($_SESSION['login'], $userArr);
		$this->redirect('user/icon');
	}
	
	public function find()
	{
		$this->isLogin();
		require LIB_PATH.'userLib.php';
		$userLib=new userLib();
		$data=array();
		$data['hotUser']=$userLib->getHotUserList();
		$data['randUser']=$userLib->getUserByRand();
		$this->loadView("find_user",$data);
	}
	
	public function register()
	{
		$this->loadView('public_register');
	}
	
	public function login()
	{
		if(userSessionLib::getLogin())
		{
			$this->redirect();
		}
		else 
		{
			$this->loadView('public_login');
		}
	}
	
	public function onlogin()
	{
		$loginOk=false;
		$loginName='';
		$formCheck=import("formCheck",true);
		$userLib=new userLib();
		$password=$this->checkForm("loginPassword","POST","请输入密码6-16位",array(wsForm::$string,6,16));
		if(stripos($_POST['loginMail'],'@')!==false)
		{
			$loginName=$this->checkForm("loginMail","POST","请输入email地址",array(wsForm::$string,5,72),array($formCheck,'isMail','email格式错误'));
			$loginOk=$userLib->checkUserLogin($loginName, $password);
		}
		else 
		{
			$loginName=$this->checkForm("loginMail","POST","请输入帐号5-16位",array(wsForm::$string,5,16,true),array($formCheck,'isHome','登陆帐号不要输入特殊字符'));
			$loginOk=$userLib->checkUserLogin($loginName,$password,'userName');
		}
		$loginPlug=hook("user_login",array($loginName,$password,$loginOk));
		$loginOk=$loginOk ?$loginOk :$loginPlug;
		if($loginOk)
		{
			$userLib->setLogin($loginOk);
			$loginInfo=hook("login_success",array($loginOk,$password));
			$this->loadView('login_success',array('homePage'=>$loginOk['homePage'],'loginInfo'=>$loginInfo));
		}
		$this->error('登陆失败,请检查帐号信息');
	}
	
	public function save()
	{
		$formCheck=import("formCheck",true);
		$mail=$this->checkForm("mail","POST","请输入email地址",array(wsForm::$string,5,72),array($formCheck,'isMail','email格式错误'));
		$userName=$this->checkForm("username","POST","请输入帐号6-16位",array(wsForm::$string,6,16,true),array($formCheck,'isHome','登陆帐号不要输入特殊字符'));
		$homePage=$this->checkForm("homepage","POST","请输入个性地址5-16位",array(wsForm::$string,5,16,true),array($formCheck,'isHome','个性地址不要输入特殊字符'));
		$password=$this->checkForm("passwd","POST","请输入密码6-16位",array(wsForm::$string,6,16));
		$repassword=$this->checkForm("repasswd","POST","请输入确认密码6-16位",array(wsForm::$string,6,16));
		if($password!=$repassword)
		{
			$this->error('两次密码不一致！');
		}
		$userLib=new userLib();
		if($userLib->checkExit("homePage",$homePage))
		{
			$this->error('个性主页地址已经存在请更换！');
		}
		if($userLib->checkExit('mail',$mail))
		{
			$this->error('电子邮件地址已经存在，请更换！');
		}
		if($userLib->checkExit('userName', $userName))
		{
			$this->error('帐号已经存在，请更换！');
		}
		hook('ready_register_user',array($homePage,$mail,$userName));
		$userId=$userLib->addUser($userName, $mail, $password, $userName, $homePage);
		if($userId)
		{
			hook('success_register_user',array($homePage,$mail,$userName,$userId,$password));
			$loginfInfo=$userLib->getUserInfo($userId,'id');
			$userLib->setLogin($loginfInfo);
			$this->success('恭喜您注册成功！','public/find');
		}
		else 
		{
			$this->error('注册失败,请稍后重试！');
		}
	}
	
	public function loginOut()
	{
		userSessionLib::unsetSession();
		$this->redirect();
	}
}