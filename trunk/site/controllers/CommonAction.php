<?php
class CommonAction extends wsAction
{
	function __construct()
	{
		if(userSessionLib::getLogin())
		{
			$this->data=array(
					'login'=>userSessionLib::getLogin(),'info'=>userSessionLib::getUserInfo(),
					'extInfo'=>userSessionLib::getUserExt(),'userId'=>userSessionLib::getUserId()
			);
		}
		hook("ws_load");
		$this->checkCache();
	}
	
	protected function setTitle($title='',$des='',$keyWord='')
	{
		$info=c("site");
		$title=$title ?$title.'-'.$info['title'] :$info['title'];
		$des=$des ?$des :$info['description'];
		$keyWord=$keyWord ?$keyWord.'-'.$info['keyword'] :$info['keyword'];
		
		$this->data=array('title'=>$title,'fTitle'=>$info['fTitle'],'des'=>$des,'keyord'=>$keyWord);
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