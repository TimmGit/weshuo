<?php
class topicExtra
{
	public function shorturl($input) {
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