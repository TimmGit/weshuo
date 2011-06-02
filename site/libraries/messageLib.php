<?php
class messageLib
{
	private $mod;
	
	function __construct()
	{
		$this->mod=new messageMod();
	}
	
	public function getMsgOne($id)
	{
		return $this->mod->getMsgOne($id);
	}
	
	public function getMsgOneSub($id,$limit=FALSE)
	{
		return $this->mod->getMsgOneSub($id,$limit);
	}
	
	public function addMsg($send,$receive,$title,$parentId=0)
	{
		if(empty($title))
		{
			return false;
		}
		$send=empty($send)?0:$send;
		$receive=empty($receive)?0:$receive;
		$parentId=empty($parentId)?0:$parentId;
		if($send==0 && $receive==0)
		{
			return FALSE;
		}
		$data=array();
		$data['send']=$send;
		$data['receive']=$receive;
		$data['sendStatus']=0;
		$data['receiveStatus']=0;
		$data['title']=$title;
		$data['time']=time();
		$data['parentId']=$parentId;
		return $this->mod->addMsg($data);
	}
	
	public function updateMsgSendStatus($id)
	{
		return $this->mod->updateMsgStatus('sendStatus',$id);
	}
	
	public function updateMsgReceiveStatus($id)
	{
		return $this->mod->updateMsgStatus('receiveStatus',$id);
	}
	
	public function delMsg($id)
	{
		return $this->mod->delMsg($id);
	}
}