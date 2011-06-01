<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
class mailApi
{
	private $sendType=1;
	public  $errInfo;
	private $config=array();

	function __construct()
	{
		$this->config=include WS_ROOT.APP_PATH.'/config/mailConfig.php';
	}
	
	public function sendMail($mail,$title,$body)
	{
		if($this->config['sendType']==1)
		{
			$headers='MIME-Version:1.0'."\r\n";   
			$headers.='Content-type:text/html;charset=utf-8'."\r\n";
			$headers.='From:'.$this->config['auth_username'].''."\r\n".'Reply-To:'.$this->config['auth_username'].''."\r\n";
			return mail($mail,$title,$body,$headers);
		}
		else 
		{
			return $this->sendMail($mail, $title, $body);
		}
	}
	
	private function sendMailBySmtp($tomail,$mailsubject,$mailbody)
	{
		$mailcfg=$this->config;
		$mailcfg['auth'] = 1; 
		unset($mailcfg['sendType']);
		$stmp=new stmp($mailcfg); 
		$mail=array('to'=>$tomail,'subject'=>$mailsubject,'content'=>$mailbody); 
		if(!$stmp->send($mail))
		{ 
			$this->errInfo=$stmp->get_error(); 
			return FALSE;
		}
		return true;
	}
}