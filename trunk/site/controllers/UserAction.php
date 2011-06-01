<?php
class UserAction extends CommonAction
{
	private $userId=0;
	
	function __construct()
	{
		$this->isLogin();
		$this->userId=userSessionLib::getUserId();
	}
	
	public function groupEdit()
	{
		if($_POST)
		{
			import("string");
			$groupName=$this->checkForm("groupName","post","请输入群组名称长度3-20字符",array(wsForm::$string,3,20));
			$groupName=replaceHtml($groupName);
			$groupId=$this->checkForm("id","post",'id错误',array(wsForm::$int,1,wsForm::$intMax));
			$groupLib=new groupLib();
			$info=$groupLib->getGroupInfoByName($groupName);
			if($info && (( $groupId && $info['groupId']!=$groupId ) || $groupId=0))
			{
				$this->error("群组名称已经存在！请更换名称！");
			}
			elseif ($info && $info['userId']!=$this->userId)
			{
				$this->error('您无权修改此群！');
			}
			else 
			{
				$data=array();
				$data['groupName']=$groupName;
				$uploadFile=new uploadFile('group');
				$img=$uploadFile->uploadImg("icon");
				if($img)
				{
					$data['icon']=$img;
				}
				$isShow=$this->checkForm("isShow","post","请输入数字0-1",array(wsForm::$int,0,1));
				$isSend=$this->checkForm("isSend","post","请输入数字0-1",array(wsForm::$int,0,1));
				$isJoin=$this->checkForm("isJoin","post","请输入数字0-1",array(wsForm::$int,0,1));
				$isReplay=$this->checkForm("isReplay","post","请输入数字0-1",array(wsForm::$int,0,1));
				$data['isShow']=$isShow;
				$data['isSend']=$isSend;
				$data['isJoin']=$isJoin;
				$data['isReplay']=$isReplay;
				if($groupLib->updateGroup($data,$groupId))
				{
					$this->success("群组修改成功!", 'user/group');
				}
				else 
				{
					$this->error();
				}
			}
		}
		else 
		{
			$groupId=segment(3);
			if(is_numeric($groupId))
			{
				$groupLib=new groupLib();
				$info=$groupLib->getGroupInfo($groupId);
				$this->loadView("group_edit",array('info'=>$info));
			}
			$this->error('错误的输入');
		}
	}
	
	public function groupAdm()
	{
		$groupId=segment(3);
		if(is_numeric($groupId))
		{
			$groupLib=new groupLib();
			$info=$groupLib->getGroupInfo($groupId);
			if($info['userId']!=$this->userId)
			{
				$this->error('您无权执行次操作！');
			}
			$userGroupLib=new userGroupLib();
			$list=$userGroupLib->getUserListByGroupId($groupId);
			$this->loadView("group_adm",array('list'=>$list));
		}
		$this->error('错误的输入');
		$this->loadView("group_adm");
	}
	
	public function groupDel()
	{
		
	}
	
	public function groupAdd()
	{
		$this->loadView("group_add");		
	}
	
	public function groupSave()
	{
		
	}
	
	public function tagDel()
	{
		
	}
	
	public function group()
	{
		$groupLib=new groupLib();
		$list=$groupLib->getGroupList($this->userId);
		$this->loadView("user_group",array('list'=>$list));
	}
	
	public function safeinfo()
	{
		if($_POST)
		{
			$formCheck=import('formCheck',true);
			$oldPwd=$this->checkForm("oldpwd","POST","请输入旧密码6-16位",array(wsForm::$string,6,16));
			$passwd=$this->checkForm("passwd","POST","请输入新密码6-16位",array(wsForm::$string,6,16));
			$repasswd=$this->checkForm("repasswd","POST","请输入确认密码6-16位",array(wsForm::$string,6,16));
			if($passwd!=$repasswd)
			{
				$this->error('两次的新密码必须一致！');
			}
			require LIB_PATH.'userLib.php';
			$userLib=new userLib();
			if(!$userLib->checkUserOldPwd($this->userId,$oldPwd))
			{
				$this->error('您的旧密码错误');
			}
			if(!$userLib->updateUserInfo(array('password'=>md5($passwd)), $this->userId))
			{
				$this->error('系统发生错误，更新失败！');
			}
			$this->success('恭喜您密码更新成功！','user/index');
		}
		else 
		{
			$this->loadView('user_safe');
		}
	}
	
	public function saveinfo()
	{
		import('string');
		$formCheck=import('formCheck',true);
		$nickName=$this->checkForm("nickname","post",'昵称长度4-12位',array(wsForm::$string,4,12,true),array($formCheck,'isHome','不要输入特殊字符'));
		$province=$this->checkForm("province","post",'请选择省份',array(wsForm::$string,2,8),array($formCheck,'isChinese','请输入中文'));
		$capital=$this->checkForm("capital",'post','请选择市', array(wsForm::$string,2,12),array($formCheck,'isChinese','请输入中文'));
		$sex=$this->checkForm('sex','post','请选择您的性别', array(wsForm::$int,1,3));
		$tag=$this->checkForm('tag','post', '请输入您的爱好，多个用逗号隔开', array(wsForm::$string,2,20));
		$content=$this->checkForm('content','post','请输入自我介绍',array(wsForm::$string,5,140));
		$tag=replaceHtml($tag);
		$content=replaceHtml($content);
		require LIB_PATH.'userLib.php';
		$userLib=new userLib();
		if($userLib->checkNickNameIsExit($this->userId, $nickName))
		{
			$this->error('昵称已经存在，请更换！');
		}
		if($province=='省份' || $capital=='市县')
		{
			$this->error('请选择省份和城市');
		}
		if(!$userLib->updateUserInfo(array('nickName'=>$nickName,'province'=>$province,'city'=>$capital,'sex'=>$sex,'tags'=>$tag,
									'memo'=>$content),$this->userId))
		{
			$this->success('恭喜你修改成功！', 'user/index');
		}
		else 
		{
			$this->error('系统错误');
		}
	}
	
	public function index()
	{
		require LIB_PATH.'userLib.php';
		$userLib=new userLib();
		$data['userInfo']=$userLib->getUserInfo($this->userId,'id');
		$this->loadView("user_index",$data);
	}
	
	public function icon()
	{
		require LIB_PATH.'userLib.php';
		$userLib=new userLib();
		$data['userInfo']=$userLib->getUserInfo($this->userId,'id');
		$this->loadView("user_icon",$data);
	}
	
	public function avatar()
	{
		if (!empty($_POST['cut_pos']))
		{
			import("imageLib");
			$imgName=$_POST['imgname'];
			if(!wsFile::checkFileNameIsUpload($imgName))
			{
				$this->error('保存文件出错！');
			}
			$imgPath=UPLOAD_PATH.'/temp/'.$imgName;
			if(!file_exists($imgPath))
			{
				$this->error('文件不存在');
			}
			$imageLib=new imageLib($imgPath);
			$posary = explode(',', $_POST['cut_pos']);
			if(count($posary)!=4)
			{
				$this->redirect('user/icon');
			}
			foreach ($posary as $k=>$v)
			{
				$posary[$k]=intval($v);
			}
			if ($posary[2] > 0 && $posary[3] > 0)
			{
				 $imageLib->resize($posary[2], $posary[3]);
			}
			$imgNewName=time().mt_rand(1,999);
			$imageLib->cutImg(UPLOAD_PATH.'/face/ws_'.$imgNewName,120, 120,$posary[0],$posary[1]);
			$imageLib->resize(UPLOAD_PATH.'/face/ws_60_'.$imgNewName,50,50);
			$imageLib->resize(UPLOAD_PATH.'/face/ws_30_'.$imgNewName,30,30,true);
			unlink($imgPath);
			$imgNewName.='.'.$imageLib->getExt();
			if(!file_exists(UPLOAD_PATH.'/face/ws_'.$imgNewName))
			{
				$this->error('文件处理失败!');
			}
			else 
			{
				require LIB_PATH.'userLib.php';
				$userLib=new userLib();
				$userInfo=$userLib->getUserInfo($this->userId,'id');
				if(is_array($userInfo) && $userInfo['icon'] && $userInfo['icon']!=='default_icon')
				{
					@unlink(UPLOAD_PATH.'/face/'.$userInfo['icon']);
					@unlink(UPLOAD_PATH.'/face/ws_60_'.$userInfo['icon']);
					@unlink(UPLOAD_PATH.'/face/ws_50_'.$userInfo['icon']);
					@unlink(UPLOAD_PATH.'/face/ws_30_'.$userInfo['icon']);
				}
				$userLib->setUserIcon($imgNewName,$this->userId);
				$this->redirect($userInfo['homePage']);
			}
		}
		else
		{
			$this->redirect('user/icon');
		}
	}
	
	public function cutimg()
	{
		import("uploadLib");
		$uploadLib=new uploadLib('temp');
		$imgName=$uploadLib->uploadImg('newico');
		if($imgName)
		{
			$this->loadView('user_cutimg',array('imgName'=>$imgName));
		}
		else 
		{
			$this->error('文件上传错误');
		}
	}
}