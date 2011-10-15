<?php
class topicExtra
{
	public static function getTime($time)
	{
		$re="";
		if($time)
		{
			$sec=time()-$time;
			if($sec>=2*24*3600)
				$re=date("Y-m-d H:i",$time);
			else if(($sec>=24*3600)&&($sec<2*24*360))
				$re="1天前";
			else if($sec>3600)
				$re=intval($sec/3600).'小时前';
			else if($sec>120)
				$re=intval($sec/60).'分钟前';
			else
				$re=$sec.'秒前';
		}
		return $re;
	}
	
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
	
	public function sendWeibo($content,$userId,$group,$parentId,$tag,$status,$share,$client,$home,$address,$ipAddress)
	{
		$topicLib= new topicLib();
		$tagStr= !empty($tag)?implode(',', $tag):'';
		$address=$ipAddress?$ipAddress:$address;
		if(empty($address))
		{
			return false;
		}
		return $topicLib->addTopic($content, $userId,$group,$parentId,$tagStr, $status, $share, $client, $home, $address);
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
		if(!$content) return array('content'=>FALSE);
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
		if(preg_match('/回复@(\S+):/i', $content,$mat))
		{
			$userName=$mat[1];
			$str='回复@'.$userName.':';
			$content=str_replace($str,'@'.$userName.' ',$content);
		}
		preg_match_all('/@(\S+)\s/i',$content,$me);
		$aboutme=$me[1];
		if(!empty($aboutme))
		{
			$userLib=new userLib();
			$sendMsg=array();
			$oldme=array();
			foreach ($aboutme as $k=>$userNick)
			{
				$oldme[$k]='@'.$userNick;
				$info=$userLib->getUserInfo($userNick,'nick');
				if(!$info)
					$aboutme[$k]='@'.$userNick.' ';
				else 
				{
					$sendMsg[$info['userId']]=$userNick;
					$tmp="<a href='".siteUrl($info['homePage'])."' target='_blank' class='aboutme'>@".$userNick."</a>";
					$aboutme[$k]=addslashes($tmp);
				}
			}
			return array('content'=>str_replace($oldme,$aboutme,$content),'sendUser'=>$sendMsg);
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
	
	public static function getBlogCommon($content)
	{
		$content=preg_replace ("/\((.+?)\.gif\)/i","<img src='".baseUrl('static/icon/')."/$1.gif' /> ", $content);
		$content=preg_replace ("/@@(http:\/\/www\.tudou\.com\S+)\.swf(.+?)@@/i","<div><a href='#flash' onclick=\"showFlash(this,'$1.swf$2')\"><img src='".baseUrl()."/static/images/flash.gif' title='点击查看视频' /></a></div>", $content);//tudou.com musick
		$content=preg_replace ("/@@(http:\/\/www\.tudou\.com\/\S\/\S+)@@/i","<div><a href='#flash' onclick=\"showFlash(this,'$1')\"><img src='".baseUrl()."/static/images/flash.gif' title='点击查看视频' /></a></div>", $content);//tudou.com swf
		$content=preg_replace ("/@@(.+?)\.swf@@/i","<div><a href='#flash' onclick=\"showFlash(this,'$1.swf')\"><img src='".baseUrl()."/static/images/flash.gif' title='点击查看视频' /></a></div>", $content);//处理分享swf
		$content=preg_replace ("/@@(.+?)\.mp3@@/i","<object type=\"application/x-shockwave-flash\" data=\"".baseUrl()."static/dewplayer.swf?son=$1.mp3\" width=\"200\" height=\"20\"><param name=\"movie\" value=\"".baseUrl()."static/dewplayer.swf?son=$1.mp3\" /></object>", $content);
		$content=preg_replace ("/@@http:(.+?)\.(jpg|png|gif|jpeg)@@/i","<a class=\"miniImg artZoom\" href=\"http:$1.$2\" rel=\"http:$1.$2\"><img src='http:$1.$2' width='80' /></a>", $content);//处理分享图片
		$content=preg_replace ("/@@(.+?)\.swf(.+?)@@/i","<div><a href='#flash' onclick=\"showFlash(this,'$1.swf$2')\"><img src='".baseUrl()."/static/images/flash.gif' title='点击查看视频' /></a></div>", $content);//cc swf
		$content=preg_replace ("/@@(http:\/\/\S+\.\S+\.\S+\/)url\/(.+?)@@/i","<a href='$1url/$2' target='_blank'>url/$2</a>", $content);//处理分享url
		$content=preg_replace ("/@@(http:\/\/.+?)@@/i","<a href='$1'>$1</a>", $content);//处理分享url
		return $content;
	}
}