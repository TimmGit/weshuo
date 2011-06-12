<?php
class userAdmLib
{
	private $userMod;
	
	function __construct()
	{
		$this->userMod=new userMod();
	}
	
	public function setUserInfo($data,$id)
	{
		return $this->userMod->setUserInfo($data,$id);
	}
	
	public function delUser($type,$content)
	{
		$flag=false;
		$type=strtolower($type);
		switch ($type)
		{
			case "id":
				$flag=$this->delUserById($content);
				break;
			case "home":
				$flag=$this->delUserByHome($content);
				break;
			case "user":
				$flag=$this->delUserByName($content);
				break;
			default:
				$flag=$this->delUserByMail($content);
				break;
		}
		return $flag;
	}
	
	private function delUserById($userId)
	{
		return $this->userMod->delUserById($userId);
	}
	
	private function delUserByHome($homePage)
	{
		return $this->userMod->delUserByHome($homePage);
	}
	
	private function delUserByName($userName)
	{
		return $this->userMod->delUserByName($userName);
	}
	
	private function delUserByMail($mail)
	{
		return $this->userMod->delUserByMail($mail);
	}
	
	public function getUserAllCount()
	{
		return $this->userMod->getUserAllCount();
	}
	
	public function getUserAllList($page,$limit)
	{
		$start=($page-1)*$limit;
		$limit=$start.','.$limit;
		return $this->userMod->getUserAllList($limit);
	}
	
	public function addAttention($userId,$userArr)
	{
		$return=true;
		$att=new attentionMod();
		if(is_array($userArr))
		{
			foreach ($userArr as $objUser)
			{
				if($objUser!=$userId && !$att->getUserObjUser($userId, $objUser))
				{
					if(!$att->addUserAttention($userId, $objUser))
					{
						$return=false;
						break;
					}
				}
			}
		}
		return $return;
	}
}