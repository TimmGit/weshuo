<?php
class SysAction extends admCommonAction
{
	
	public function other()
	{
		$siteExtLib=new siteExtLib();
		if($_POST)
		{
			$data['openReg']=$this->checkForm("openReg","post","必须数数字", array(wsForm::$int,1,2));
			$data['inviteReg']=$this->checkForm("inviteReg","post","必须数数字", array(wsForm::$int,1,2));
			$data['commentOpen']=$this->checkForm("commentOpen","post","必须数数字", array(wsForm::$int,1,2));
			$data['textLen']=$this->checkForm("textLen","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['fileSize']=$this->checkForm("fileSize","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['isClose']=$this->checkForm("isClose","post","必须数数字", array(wsForm::$int,1,2));
			$data['closeInfo']=$this->checkForm("closeInfo","post","关闭原因长度0-200字", array(wsForm::$string,0,200));
			if($siteExtLib->setInfo($data))
			{
				$info=$siteExtLib->getInfo();
				c("siteExt",null);
				c("siteExt",$info);
				$this->success();
			}
			else 
			{
				$this->error();
			}
		}
		else 
		{
			$data=$siteExtLib->getInfo();
			$this->loadView('sys_other',array('data'=>$data));
		}
	}
	
	public function score()
	{
		$siteExtLib=new siteExtLib();
		if($_POST)
		{
			$data['scoreStart']=$this->checkForm("score_start","post","必须数数字", array(wsForm::$int,1,2));
			$data['loginScore']=$this->checkForm("loginScore","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['createGet']=$this->checkForm("createGet","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['replayGet']=$this->checkForm("replayGet","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['createDel']=$this->checkForm("createDel","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['replayDel']=$this->checkForm("replayDel","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['createGroup']=$this->checkForm("createGroup","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['sendImg']=$this->checkForm("sendImg","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['downloadScore']=$this->checkForm("downloadScore","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['uploadScore']=$this->checkForm("uploadScore","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['inviteScore']=$this->checkForm("inviteScore","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['userScore']=$this->checkForm("userScore","post","必须数数字", array(wsForm::$int,1,wsForm::$intMax));
			$data['scoreLog']=$this->checkForm("scoreLog","post","必须数数字", array(wsForm::$int,1,2));
			if($siteExtLib->setInfo($data))
			{
				$info=$siteExtLib->getInfo();
				c("siteExt",null);
				c("siteExt",$info);
				$this->success();
			}
			else 
			{
				$this->error();
			}
		}
		else 
		{
			$data=$siteExtLib->getInfo();
			$this->loadView('sys_score',array('data'=>$data));
		}
	}
	
	public function mail()
	{
		$siteLib=new siteLib();
		if($_POST)
		{
			$data['mailType']=$this->checkForm("mailType", "post", "邮局类型ID错误", array(wsForm::$int,1,2));
			$data['smtp']=$this->checkForm("smtp","post","smtp长度错误0-30", array(wsForm::$string,0,30));
			$data['smtpUser']=$this->checkForm("smtpUser","post","smtpUser长度错误0-20", array(wsForm::$string,0,20));
			$data['smtpPwd']=$this->checkForm("smtpPwd","post","smtpPwd长度错误0-20", array(wsForm::$string,0,20));
			$data['receive']=$this->checkForm("receive","post","receive长度错误5-40", array(wsForm::$string,5,40));
			$data['mailText']=$_POST['mailText'];
			if($siteLib->setSiteInfo($data))
			{
				c("site",null);
				c("site",$siteLib->getSiteInfo());
				$this->success();
			}
			else 
			{
				$this->error();
			}
		}
		else 
		{
			$data=$siteLib->getSiteInfo();
			$this->loadView('sys_mail',array('data'=>$data));
		}
	}
	
	public function cache()
	{
		if($_POST)
		{
			$wsFile=new wsFile();
			$fileList=$wsFile->readPath(CACHE_PATH,1);
			foreach ($fileList as $file)
			{
				if($file !='.' && $file!='..')
				{
					unlink($file);
				}
			}
			wsPlugin::checkPlugCache();
			$this->success();
		}
		else 
		{
			$this->loadView('sys_cache');
		}
	}
	
	public function weshuo()
	{
		$siteLib=new siteLib();
		if($_POST)
		{
			$formCheck=import("formCheck",true);
			$data['title']=$this->checkForm("title","post","标题长度错误5-255", array(wsForm::$string,5,255));
			$data['subTitle']=$this->checkForm("subTitle", "post", "副标题长度错误1-20", array(wsForm::$string,1,20));
			$data['keyword']=$this->checkForm("keyword", "post", "关键字长度错误1-255", array(wsForm::$string,1,255));
			$data['description']=$this->checkForm("description","post", "微博描述长度错误", array(wsForm::$string,1,255));
			$data['noUser']=$_POST['noUser'];
			$data['replaceWord']=$_POST['replaceWord'];
			$data['icp']=$this->checkForm("icp","post","备案信息长度错误1-20",array(wsForm::$string,1,20));
			$data['home']=$this->checkForm("home","post","微博主页错误", array(wsForm::$string,1,20),array($formCheck,'isIndex','微博主页必须是字母'));
			$data['copyright']=$_POST['copyright'];
			if($siteLib->setSiteInfo($data))
			{
				c("site",null);
				c("site",$siteLib->getSiteInfo());
				$this->success("更新成功!");
			}
			else 
			{
				$this->error();
			}
		}
		else 
		{
			$data=$siteLib->getSiteInfo();
			$this->loadView('sys_weshuo',array('data'=>$data));
		}
	}
	
	public function info()
	{
		$info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
			'mysql数据库'=>$this->showResult(function_exists("mysql_close")),
			'SMTP'=>$this->showResult(get_magic_quotes_gpc("smtp")),
			'GD Library'=>$this->showResult(function_exists("imageline")),
			'XML'=>$this->showResult(get_magic_quotes_gpc("XML Support")),
			'FTP'=>$this->showResult(get_magic_quotes_gpc("FTP support")),
			'站点物理路径'=>realpath("../"),
			'Sendmail'=>$this->showResult(get_magic_quotes_gpc("Internal Sendmail Support for Windows 4")),
			'上传文件大小限制'=>get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件",
			'显示错误信息'=>$this->showResult(get_cfg_var("display_errors")),
			'POST提交内容限制'=>get_cfg_var("post_max_size"),
			'allow_url_fopen'=>$this->showResult(get_cfg_var("allow_url_fopen")),
			'Zlib'=>$this->showResult(function_exists("gzclose")),
			'内存限制'=>get_cfg_var("memory_limit")?get_cfg_var("memory_limit"):"无",
			'Zend支持'=>$this->showResult(function_exists("zend_version")),
			'服务器端口'=>$_SERVER["SERVER_PORT"],
			'程序版本'=>'<a href="http://www.weshuo.org" target="_blank">V1.0 beta</a>'
		);
		$this->loadView('sys_info',array('info'=>$info));
	}
	
	private function showResult($flag)
	{
		if($flag)
		{
			return '<font color=\'green\' size=3><b>√</b></font>';
		}
		else
		{
			return '<font color=\'#ff000\' size=3><b>×</b></font>';
		}
	}
}