<?php
class PublicAction extends CommonAction
{
	public function index()
	{
		$this->register();
	}
	
	public function admLogin()
	{
		$this->isLogin();
		$this->loadView('adm_login');
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
		$formCheck=import("formCheck",true);
		$userLib=new userLib();
		$password=$this->checkForm("passwd","POST","请输入密码6-16位",array(wsForm::$string,6,16));
		if(stripos($_POST['mail'],'@')!==false)
		{
			$mail=$this->checkForm("mail","POST","请输入email地址",array(wsForm::$string,5,72),array($formCheck,'isMail','email格式错误'));
			$loginOk=$userLib->checkUserLogin($mail, $password);
		}
		else 
		{
			$userName=$this->checkForm("mail","POST","请输入帐号5-16位",array(wsForm::$string,5,16,true),array($formCheck,'isHome','登陆帐号不要输入特殊字符'));
			$loginOk=$userLib->checkUserLogin($userName,$password,'userName');
		}
		if($loginOk)
		{
			$this->setLogin($userLib,$loginOk);
			$this->redirect($loginOk['homePage']);
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
			hook('success_register_user',array($homePage,$mail,$userName,$userId));
			$loginfInfo=$userLib->getUserInfo($homePage);
			$this->setLogin($userLib,$loginfInfo);
			$this->success('恭喜您注册成功！','public/find');
		}
		else 
		{
			$this->error('注册失败,请稍后重试！');
		}
	}
	
	private function setLogin($userLib,$loginfInfo)
	{
		userSessionLib::setLogin(true);
		userSessionLib::setUserId($loginfInfo['userId']);
		userSessionLib::setUserInfo($loginfInfo);
		userSessionLib::setUserExt($userLib->getUserExtInfo($loginfInfo['userId']));
	}
}