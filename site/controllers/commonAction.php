<?php
class commonAction extends wsCore
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
		else 
		{
			
		}
	}
}