<?php
class topicExtra
{
	
	public static function getUrlByContent($content)
	{
		if(preg_match("/(http:\/\/[\w:\/\.\?=&-_]+)/i", $content,$matches))
		{
			return $matches[0];
		}
		return FALSE;
	}
	
	public function replaceSortUrl($content,$short)
	{
		return str_replace($short,"<a href=\"".siteUrl('url/'.$short)."\">http://".$short."</a>", $content);
	}
	
	public function sendWeibo($content,$userId,$group,$parentId,$tag,$zhuan,$status,$share,$client,$home,$address,$ipAddress)
	{
		$topicLib= new topicLib();
		$tagStr= !empty($tag)?implode(',', $tag):'';
		$address=$ipAddress?$ipAddress:$address;
		if(empty($address))
		{
			return false;
		}
		return $topicLib->addTopic($content, $userId,$group,$parentId,$tagStr, $zhuan, $status, $share, $client, $home, $address);
	}
	
	/**
	 * 获取微博的内容 处理URL
	 * @param string $content
	 * @param int $length
	 * @return array
	 */
	public function getWbContent($content,$length=140)
	{
		$shortUrl=FALSE;
		$content=replaceHtml($content);
		$url=$this->getUrlByContent($content);
		if($url)
		{
			$shortUrl=$this->shorturl($url);
			$content=str_replace($url,$shortUrl,$content);
			$start=stripos($content,$shortUrl);
			if($start>$length)
			{
				$shortUrl=FALSE;
				$url=FALSE;
			}
			else 
			{
				$strLen=$start+strlen($shortUrl);
				$length=$strLen > $length ?$strLen :$length;
			}
		}
		$content=$length ?mb_substr($content,0,$length,CHARSET) :$content;
		return array('content'=>$content,'url'=>$url,'short'=>$shortUrl);
	}
	
	
	
	/**
	 * 
	 * 处理《提到我的》的内容
	 * @param string $content
	 * @return array or string
	 */
	public function aboutMe($content)
	{
		preg_match_all('/@(\S+)\s/i',$content,$me);
		$aboutme=$me[1];
		if(!empty($aboutme))
		{
			$oldme=array();
			$sendMsg=array();
			$userLib=new userLib();
			foreach ($aboutme as $k=>$userNick)
			{
				$oldme[$k]='/@'.$userNick.'/';
				$info=$userLib->getUserInfo($userNick,'nick');
				if(!$info)
					$aboutme[$k]='@'.$userNick.' ';
				else 
				{
					$sendMsg[$info['userId']]=$userNick;
					$aboutme[$k]="<a href='".siteUrl($info['homePage'])."' target='_blank' class='aboutme'>@".$userNick."</a>";
				}
			}
			return array('content'=>preg_replace($oldme,$aboutme,$content),'sendUser'=>$sendMsg);
		}
		return $content;
	}
	
	public function shorturl($input)
	{
		$base32 = array (
	    'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
	    'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
	    'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
	    'y', 'z', '0', '1', '2', '3', '4', '5',
	    '6', '7', '8', '9'
	    );
	
	    $hex = md5($input);
	    $hexLen = strlen($hex);
	    $subHexLen = $hexLen / 8;
	    $output =array();
	
	    for ($i = 0; $i < $subHexLen; $i++)
	    {
	    	$subHex = substr ($hex, $i * 8, 8);
	    	$int = 0x3FFFFFFF & (1 * ('0x'.$subHex));
	    	$out = '';
	
	    	for ($j = 0; $j < 6; $j++)
	    	{
			    $val = 0x0000001F & $int;
			    $out .= $base32[$val];
			    $int = $int >> 5;
	    	}
	
	    	$output[] = $out;
	    }
	
	    return $output[mt_rand(0,3)];
	}
}