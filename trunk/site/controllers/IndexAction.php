<?php
class IndexAction extends CommonAction
{
	public function index()
	{
		if(userSessionLib::getLogin())
		{
			$userInfo=userSessionLib::getUserInfo();
			$home=isset($userInfo['homePage']) ?$userInfo['homePage'] :'pub';
			$this->redirect($home);
		}
		else 
		{
			parent::setTitle('用户登录');
			$this->loadView('public_login');
		}
		//$this->loadView('index',array('a'=>'weshuo.org'));
	}
	
	public function test()
	{
		header("Content-type:text/html;charset=utf-8");
		set_time_limit(0);
		$db=wsModel::getInstance();
		$list=$db->querySql("select userId from iw_user order by userId desc");
		foreach ($list as $v)
		{
			$wbcount=0;
			$wbcount=$db->getOne("select count(*) from iw_topic where userId=".$v[0]);
			$gzcount=0;
			$gzcount=$db->getOne("select count(*) from iw_attention where userId=".$v[0]);
			$fscount=0;
			$fscount=$db->getOne("select count(*) from iw_attention where objUser=".$v[0]);
			$sql="INSERT INTO `iw_userExt`(`userId` ,`wbCount` ,`gzCount` ,`fsCount` ,`loginTime` ,`loginIp` ,`sinaId` ,`gmailId` ,`oicqId` ,`medal` ,`theme`)
				VALUES (".$v[0].",".$wbcount.",".$gzcount.",".$fscount.",  '1000-01-01 00:00:00',  '127.0.0.1',  '0',  '0',  '0',  '',  'default')";
			if(!$db->execSql($sql))
			{
				echo "error<br/>".$sql;
				exit;
				break;
			}
			else 
			{
				echo $v[0].'ok<br/>';
			}
		}
	}
}
