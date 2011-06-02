<?php
class tagExtra
{
	public function getTopicTag($title)
	{
		preg_match_all("/#([\w+\d+-]+)#/iu",$title,$matches);
		if(!empty($matches[0]))
		{
			$tagArray=array();
			foreach ($matches[0] as $value)
			{
				$urlValue=$this->replaceSharp($value);
				$tagArray[]=$urlValue;
				$title=str_replace($value,"<a href=".siteUrl('tag/'.$urlValue).">$value</a>", $title);
			}
			return array('content'=>$title,'tag'=>$tagArray);
		}
		return $title;
	}
	
	private function replaceSharp($tagName)
	{
		return str_replace('#','', $tagName);
	}
}