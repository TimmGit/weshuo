<?php
class AjaxAction extends wsCore
{
	public function checkNick()
	{
		$this->isLogin();
		$formCheck=import('formCheck',true);
		$nickName=$this->checkForm("nickname","post",'昵称长度4-12位',array(wsForm::$string,4,12,true),array($formCheck,'isHome','不要输入特殊字符'),true);
		require LIB_PATH.'userLib.php';
		$userLib=new userLib();
		if($userLib->checkNickNameIsExit($_SESSION['login'], $nickName))
		{
			echo "昵称已经存在，请更换！";exit;
		}
		echo "可以使用!";
	}
}