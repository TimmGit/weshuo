<?php
class messageExtra
{
	public function sendAboutMe($userArr,$topicId)
	{
		$messageLib=new messageLib();
		$sendUser=userSessionLib::getUserInfo();
		foreach ($userArr as $userId=>$nickName)
		{
			$title=$sendUser['nickName'].'在微博提到你<a href="'.siteUrl($sendUser['homePage'].'/').'" target="_blank">点击查看</a>';
			$messageLib->addMsg(0, $userId, $title);
		}
	}
}