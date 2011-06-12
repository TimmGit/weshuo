<?php
class UcpAction extends admCommonAction
{
	
	public function info()
	{
		$userExtLib=new userExtLib();
		$userLib=new userLib();
		if($_POST)
		{
			$userAdmLib=new userAdmLib();
			$userId=$_POST['userId'];
			$userName=$this->checkForm("userName", "post",'用户长度错误4-20', array(wsForm::$string,4,20,TRUE));
			$homePage=$this->checkForm("homePage", "post",'主页长度错误4-30', array(wsForm::$string,4,30,TRUE));
			$mail=$this->checkForm("mail", "post",'电子邮件长度错误4-50', array(wsForm::$string,4,50));
			$nickName=$this->checkForm("nickName", "post",'昵称长度错误', array(wsForm::$string,4,10,TRUE));
			$checkInfo=$userLib->checkExit('userName', $userName);
			if($checkInfo && $checkInfo['userId']!=$userId)
			{
				$this->error('用户名已经存在！');
			}
			$checkInfo=$userLib->checkExit("homePage", $homePage);
			if($checkInfo && $checkInfo['userId']!=$userId)
			{
				$this->error('主页已经存在！');
			}
			$checkInfo=$userLib->checkExit("mail", $mail);
			if($checkInfo && $checkInfo['userId']!=$userId)
			{
				$this->error('mail已经存在！');
			}
			$checkInfo=$userLib->checkExit("nickName", $nickName);
			if($checkInfo && $checkInfo['userId']!=$userId)
			{
				$this->error('昵称已经存在！');
			}
			$data['userName']=$userName;
			$data['mail']=$mail;
			$data['homePage']=$homePage;
			$data['nickName']=$nickName;
			$data['groupId']=$this->checkForm("groupId", "post", "组ID错误", array(wsForm::$int,0,9));
			$data['roleId']=$this->checkForm("roleId", "post", "角色ID错误", array(wsForm::$int,0,9));
			$data['status']=$this->checkForm("status", "post", "状态值错误", array(wsForm::$int,1,2));
			$data['tags']=$this->checkForm("tags", "post", "标签错误", array(wsForm::$string,0,200));
			$data['province']=$this->checkForm("province", "post", "省错误", array(wsForm::$string,0,10));
			$data['city']=$this->checkForm("city", "post", "市错误", array(wsForm::$string,0,10));
			$data['sex']=$this->checkForm("sex", "post", "性别值错误", array(wsForm::$int,1,2));
			$data['memo']=$this->checkForm("memo", "post", "介绍错误", array(wsForm::$string,0,100));
			if($userAdmLib->setUserInfo($data, $userId))
			{
				$info['sinaId']=$this->checkForm("sinaId", "post", "新浪微博帐号错误", array(wsForm::$string,0,20));
				$info['gmailId']=$this->checkForm("gmailId", "post", "gmail帐号错误", array(wsForm::$string,0,35));
				$info['oicqId']=$this->checkForm("oicqId", "post", "qq帐号错误", array(wsForm::$int,0,wsForm::$intMax));
				$info['theme']=$this->checkForm("theme", "post", "主题错误", array(wsForm::$string,0,20));
				if($userExtLib->setUserExtInfo($info, $userId))
				{
					$this->success();
				}
			}
			$this->error();
		}
		else 
		{
			$userId=$this->checkForm("userId", array(3,1), "用户ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$info=$userLib->getUserInfo($userId,'id');
			if(!$info)
			{
				$this->error('不存在的用户');
			}
			$this->loadView('ucp_info',array('info'=>$info,'ext'=>$userExtLib->getUserExtInfo($info['userId'])));
		}
	}
	
	public function user()
	{
		$userAdmLib=new userAdmLib();
		if($_POST)
		{
			$checkId=$this->checkForm("checkId","post","选择的ID错误", array(wsForm::$intArr,0,wsForm::$intMax));
			foreach ($checkId as $userId)
			{
				if($userId && is_numeric($userId))
				{
					$userAdmLib->delUser("id", $userId);
				}
			}
			$this->success();
		}
		else 
		{
			$nowPage=$this->checkForm("page", array(3,1), "分页ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$allCount=$userAdmLib->getUserAllCount();
			$pageSize=25;
			$pageTool=new pageTool($nowPage, $allCount, $pageSize);
			$data=array();
			$data['list']=$userAdmLib->getUserAllList($nowPage, $pageSize);
			$data['page']=$pageTool->show('ucp/user');
			$this->loadView("user_list",$data);
		}
	}
}