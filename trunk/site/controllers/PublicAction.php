<?php
class PublicAction extends wsCore
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
		if(isset($_SESSION['login']))
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
		require MODEL_PATH.'userMod.php';
		$user=new userMod();
		$password=$this->checkForm("passwd","POST","请输入密码6-16位",array(wsForm::$string,6,16));
		if(stripos($_POST['mail'],'@')!==false)
		{
			$mail=$this->checkForm("mail","POST","请输入email地址",array(wsForm::$string,5,72),array($formCheck,'isMail','email格式错误'));
			$loginOk=$user->checkLoginByMail($mail,$password);
		}
		else 
		{
			$userName=$this->checkForm("mail","POST","请输入帐号5-16位",array(wsForm::$string,5,16,true),array($formCheck,'isHome','登陆帐号不要输入特殊字符'));
			$loginOk=$user->checkLoginByUserName($userName,$password);
		}
		if($loginOk)
		{
			$_SESSION['login']=$loginOk['userId'];
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
		require MODEL_PATH.'userMod.php';
		$user=new userMod();
		if($user->checkHome($homePage))
		{
			$this->error('个性主页地址已经存在请更换！');
		}
		if($user->checkUserIsExit($mail))
		{
			$this->error('电子邮件地址已经存在，请更换！');
		}
		if($user->checkUserName($userName))
		{
			$this->error('帐号已经存在，请更换！');
		}
		hook('ready_register_user',array($homePage,$mail,$userName));
		$data=array('userName'=>$userName,'mail'=>$mail,'password'=>md5($password),'icon'=>'','createTime'=>time(),
					'createIp'=>client::getClientIp(),'groupId'=>0,'roleId'=>0,'score'=>0,'nickName'=>$userName,'status'=>1
					,'tags'=>'','province'=>'','city'=>'','homePage'=>$homePage);
		$userId=$user->addUser($data);
		if($userId)
		{
			hook('success_register_user',array($homePage,$mail,$userName,$userId));
			$_SESSION['login']=$mail;
			$this->success('恭喜您注册成功！','public/find');
		}
		else 
		{
			$this->error('注册失败,请稍后重试！');
		}
	}
}