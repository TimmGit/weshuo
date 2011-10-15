<?php
class CommonAction extends wsAction
{
	function __construct()
	{
		header("Content-Type:text/html; charset=utf-8");
		if(userSessionLib::getLogin())
		{
			$this->data=array(
					'login'=>userSessionLib::getLogin(),'info'=>userSessionLib::getUserInfo(),
					'extInfo'=>userSessionLib::getUserExt(),'userId'=>userSessionLib::getUserId()
			);
		}
		else 
		{
			$this->data=array('login'=>0);
		}
		$this->setTitle();
		hook("ws_load");
		$this->checkCache();
	}
	
	protected function setTitle($title='',$des='',$keyWord='')
	{
		$info=c("site");
		$title=$title ?$title.'-'.$info['title'] :$info['title'];
		$des=$des ?$des :$info['description'];
		$keyWord=$keyWord ?$keyWord.'-'.$info['keyword'] :$info['keyword'];
		
		$this->data=array_merge($this->data,
			array('title'=>$title,'subTitle'=>$info['subTitle'],'des'=>$des,'keyord'=>$keyWord,'copy'=>$info['copyright']));
	}
	
	private function checkCache()
	{
		$info=c("site");
		if($info==false)
		{
			$siteLib=new siteLib();
			$info=$siteLib->getSiteInfo();
			c('site',$info);
		}
		return $info;
	}
}