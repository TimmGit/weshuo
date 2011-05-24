<?php
class userAdmLib
{
	function __construct()
	{
		require MODEL_PATH.'attentionMod.php';
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