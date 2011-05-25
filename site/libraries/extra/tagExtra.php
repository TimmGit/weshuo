<?php
class tagExtra
{
	public function getTopicTag($title)
	{
		preg_match_all("/#([\w+\d+-&$*@]|[\x{4e00}-\x{9fa5}]+)#/ui",$title,$matches);
		if(!empty($matches[0]))
		{
			return $matches[0];
		}
		return FALSE;
	}
}