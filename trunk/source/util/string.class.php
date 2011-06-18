<?php
class string
{
	/**
	 * 获取汉字长度 一汉字=2
	 * @param string $string
	 */
	public static function getChinsesLenTwo($string)
	{
		$length = strlen(preg_replace('/[\x00-\x7F]/', '', $string));
	    if ($length)
	    {
	        $length=strlen($string) - $length + intval($length / 3) * 2;
	    }
	    else
	    {
	        $length=strlen($string);
	    }
	    return $length;
	}
	
	/**
	 * 获取汉字的长度 1汉字=1
	 * @param unknown_type $string
	 */
	public static function getChineseLenOne($string)
	{
		$length=0;
		if(function_exists("mb_strlen"))
		{
			$length=mb_strlen($string,CHARSET);
		}
		elseif(function_exists('iconv_strlen'))
		{
			$length=iconv_strlen($string,CHARSET);
		}
		else
		{
			$length=self::getChinsesLibOnePrivate($string);
		}
		return $length;
	}
	
	private static function getChinsesLibOnePrivate($str)
	{
		$length = strlen(preg_replace('/[\x00-\x7F]/', '', $str));
	    if ($length)
	    {
	        return strlen($str) - $length + intval($length / 3);
	    }
	    else
	    {
	        return strlen($str);
	    }
	}
	
	/**
	 * 截取UTF8编码字符串从首字节开始指定宽度(非长度), 适用于字符串长度有限的如新闻标题的等宽度截取
	 * 中英文混排情况较理想. 全中文与全英文截取后对比显示宽度差异最大,且截取宽度远大越明显.
	 * @param string $str	UTF-8 encoding
	 * @param int[option] $width 截取宽度
	 * @param string[option] $end 被截取后追加的尾字符
	 * @param float[option] $x3<p>
	 * 	3字节（中文）字符相当于希腊字母宽度的系数coefficient（小数）
	 * 	中文通常固定用宋体,根据ascii字符字体宽度设定,不同浏览器可能会有不同显示效果</p>
	 *
	 * @return string
	 * @author waiting
	 * http://waiting.javaeye.com
	 */
	public static function u8_title_substr($str, $width = 0, $end = '', $x3 = 0) {
		global $CFG; // 全局变量保存 x3 的值
		$e='';
		if ($width <= 0 || $width >= strlen($str)) {
			return $str;
		}
		$arr = str_split($str);
		$len = count($arr);
		$w = 0;
		$width *= 10;

		// 不同字节编码字符宽度系数
		$x1 = 11;	// ASCII
		$x2 = 16;
		$x3 = $x3===0 ? ( $CFG['cf3']  > 0 ? $CFG['cf3']*10 : $x3 = 21 ) : $x3*10;
		$x4 = $x3;

		// http://zh.wikipedia.org/zh-cn/UTF8
		for ($i = 0; $i < $len; $i++) {
			if ($w >= $width) {
				$e = $end;
				break;
			}
			$c = ord($arr[$i]);
			if ($c <= 127) {
				$w += $x1;
			}
			elseif ($c >= 192 && $c <= 223) {	// 2字节头
				$w += $x2;
				$i += 1;
			}
			elseif ($c >= 224 && $c <= 239) {	// 3字节头
				$w += $x3;
				$i += 2;
			}
			elseif ($c >= 240 && $c <= 247) {	// 4字节头
				$w += $x4;
				$i += 3;
			}
		}

		return implode('', array_slice($arr, 0, $i) ). $e;
	}
	
	public static function safeHtml($text, $tags = null){
		$text	=	trim($text);
		//完全过滤注释
		$text	=	preg_replace('/<!--?.*-->/','',$text);
		//完全过滤动态代码
		$text	=	preg_replace('/<\?|\?'.'>/','',$text);
		//完全过滤js
		$text	=	preg_replace('/<script?.*\/script>/','',$text);

		$text	=	str_replace('[','&#091;',$text);
		$text	=	str_replace(']','&#093;',$text);
		$text	=	str_replace('|','&#124;',$text);
		//过滤换行符
		$text	=	preg_replace('/\r?\n/','',$text);
		//br
		$text	=	preg_replace('/<br(\s\/)?'.'>/i','[br]',$text);
		$text	=	preg_replace('/(\[br\]\s*){10,}/i','[br]',$text);
		//过滤危险的属性，如：过滤on事件lang js
		while(preg_match('/(<[^><]+)( lang|on|action|background|codebase|dynsrc|lowsrc)[^><]+/i',$text,$mat)){
			$text=str_replace($mat[0],$mat[1],$text);
		}
		while(preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i',$text,$mat)){
			$text=str_replace($mat[0],$mat[1].$mat[3],$text);
		}
		if(empty($tags)) {
			$tags = 'table|td|th|tr|i|b|u|strong|img|p|br|div|strong|em|ul|ol|li|dl|dd|dt|a';
		}
		//允许的HTML标签
		$text	=	preg_replace('/<('.$tags.')( [^><\[\]]*)>/i','[\1\2]',$text);
		//过滤多余html
		$text	=	preg_replace('/<\/?(html|head|meta|link|base|basefont|body|bgsound|title|style|script|form|iframe|frame|frameset|applet|id|ilayer|layer|name|script|style|xml)[^><]*>/i','',$text);
		//过滤合法的html标签
		while(preg_match('/<([a-z]+)[^><\[\]]*>[^><]*<\/\1>/i',$text,$mat)){
			$text=str_replace($mat[0],str_replace('>',']',str_replace('<','[',$mat[0])),$text);
		}
		//转换引号
		while(preg_match('/(\[[^\[\]]*=\s*)(\"|\')([^\2=\[\]]+)\2([^\[\]]*\])/i',$text,$mat)){
			$text=str_replace($mat[0],$mat[1].'|'.$mat[3].'|'.$mat[4],$text);
		}
		//过滤错误的单个引号
		while(preg_match('/\[[^\[\]]*(\"|\')[^\[\]]*\]/i',$text,$mat)){
			$text=str_replace($mat[0],str_replace($mat[1],'',$mat[0]),$text);
		}
		//转换其它所有不合法的 < >
		$text	=	str_replace('<','&lt;',$text);
		$text	=	str_replace('>','&gt;',$text);
		$text	=	str_replace('"','&quot;',$text);
	 //反转换
		$text	=	str_replace('[','<',$text);
		$text	=	str_replace(']','>',$text);
		$text	=	str_replace('|','"',$text);
		//过滤多余空格
		$text	=	str_replace('  ',' ',$text);
		return $text;
	}
	
	public static function RemoveXSS($val) {
		// remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
		// this prevents some character re-spacing such as <java\0script>
		// note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
		$val = preg_replace('/([\x00-\x08\x0b-\x0c\x0e-\x19])/', '', $val);
		// straight replacements, the user should never need these since they're normal characters
		// this prevents like <IMG SRC=@avascript:alert('XSS')>
		$search = 'abcdefghijklmnopqrstuvwxyz';
		$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$search .= '1234567890!@#$%^&*()';
		$search .= '~`";:?+/={}[]-_|\'\\';
		for ($i = 0; $i < strlen($search); $i++) {
			// ;? matches the ;, which is optional
			// 0{0,7} matches any padded zeros, which are optional and go up to 8 chars

			// @ @ search for the hex values
			$val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
			// @ @ 0{0,7} matches '0' zero to seven times
			$val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
		}

		// now the only remaining whitespace attacks are \t, \n, and \r
		$ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
		$ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
		$ra = array_merge($ra1, $ra2);

		$found = true; // keep replacing as long as the previous round replaced something
		while ($found == true) {
			$val_before = $val;
			for ($i = 0; $i < sizeof($ra); $i++) {
				$pattern = '/';
				for ($j = 0; $j < strlen($ra[$i]); $j++) {
					if ($j > 0) {
						$pattern .= '(';
						$pattern .= '(&#[xX]0{0,8}([9ab]);)';
						$pattern .= '|';
						$pattern .= '|(&#0{0,8}([9|10|13]);)';
						$pattern .= ')*';
					}
					$pattern .= $ra[$i][$j];
				}
				$pattern .= '/i';
				$replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
				$val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
				if ($val_before == $val) {
					// no replacements were made, so exit the loop
					$found = false;
				}
			}
		}
		return $val;
	}
}