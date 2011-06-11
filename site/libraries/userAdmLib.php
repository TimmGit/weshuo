<?php
class userAdmLib
{
	private $userMod;
	
	function __construct()
	{
		$this->userMod=new userMod();
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