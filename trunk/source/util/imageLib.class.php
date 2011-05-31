<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  Mozilla Public License (MPL 1.1)
* @author iceweb
*/
class imageLib
{
	private $imgObj=null;
	private $width;
	private $height;
	private $type;
	private $imgName;
	
	function __construct($imgName)
	{
		$this->imgName=$imgName;
		$this->createImage();
	}
	
	public function getExt()
	{
		return $this->type;
	}
	
	public function createImage()
	{
		list($this->width,$this->height,$type,$attr) = getimagesize($this->imgName);
		switch ($type)
		{
			case 1:
				$this->type='gif';
				if (function_exists('imagecreatefromgif'))	$this->imgObj=imagecreatefromgif($this->imgName);
				break;
			case 2:
				$this->type='jpg';
				$this->imgObj=imagecreatefromjpeg($this->imgName);
				break;
			case 3:
				$this->type='png';
				$this->imgObj=imagecreatefrompng($this->imgName);
				break;
			default:
				$this->type='png';
				$this->imgObj=imagecreatefromstring($this->imgName);
				break;
		}
	}
	
	
	public function waterImage($waterImg,$pos=9)
	{
		list($width,$height,$type,$attr) = getimagesize($waterImg);
		if($width>$this->width || $height>$this->height)
		{
			return false;
		}
		$tmpimg = imagecreatefrompng($waterImg);
		$imgPos=$this->getWaterPos($pos, $width, $height);
		ImageAlphaBlending($this->imgObj,true);
		imagecopy($this->imgObj,$tmpimg,$imgPos[0],$imgPos[1],0,0,$width,$height);
		$this->saveImg(str_replace('.'.$this->getExt(),'',$this->imgName),true);
	}
	
	
	public function textImage($text,$pos=9,$path=false)
	{
		$path=$path ?$path :WS_ROOT.'static/font/CONSOLA.TTF';
		$arr=imagettfbbox(12,0,$path,$text);
		if(count($arr)==8)
		{
			$width=$arr[4]-$arr[6];
			$height=$arr[7]-$arr[0]>0 ?$arr[7]-$arr[0] :($arr[7]-$arr[0])*-1;
			$posArr=$this->getWaterPos($pos, $width, $height);
			$white = imagecolorallocate($this->imgObj, 255, 255, 255);
			imagettftext($this->imgObj,12,0,$posArr[0],$posArr[1],$white,$path,$text);
			$this->saveImg(str_replace('.'.$this->getExt(),'',$this->imgName),true);
			return true;
		}
		return false;
	}
	
	private function getWaterPos($pos,$width,$height)
	{
		$x=0;
		$y=0;
		switch ($pos)
		{
			case 1:
				$x=0;
				$y=0;
				break;
			case 2:
				$x=($this->width-$width)/2;
				$y=0;
				break;
			case 3:
				$x=$this->width-$width;
				$y=0;
				break;
			case 4:
				$x=0;
				$y=($this->height-$height)/2;
				break;
			case 5:
				$x=($this->width-$width)/2;
				$y=($this->height-$height)/2;
				break;
			case 6:
				$x=$this->width-$width;
				$y=($this->height-$height)/2;
				break;
			case 7:
				$x=0;
				$y=$this->height-$height;
				break;
			case 8:
				$x=($this->width-$width)/2;
				$y=$this->height-$height;
				break;
			default:
				$x=$this->width-$width;
				$y=$this->height-$height;
				break;
		}
		return array($x,$y);
	}
	
	public function cutImg($imgName,$width, $height, $x=0, $y=0,$destroy=false)
	{
		if(!is_resource($this->imgObj) || $x<0 || $y<0)
		{
			return false;	
		}
		$width=$width>$this->width ?$this->width :$width;
		$height=$height>$this->height?$this->height:$height;
		$tmpimg = imagecreatetruecolor($width,$height);
		imagecopy($tmpimg, $this->imgObj, 0, 0, $x, $y, $width, $height);
		$this->destroy();
		$this->imgObj = $tmpimg;
		$this->saveImg($imgName,$destroy);
	}
	
	private function saveImg($imgName, $destroy=false)
	{
		switch($this->type)
		{
			case 'jpg':
				imagejpeg($this->imgObj, $imgName.'.jpg',95);
				break;
			case 'gif':
				imagegif($this->imgObj, $imgName.'.gif');
				break;
			default:
				imagepng($this->imgObj, $imgName.'.png');
				break;
		}
		if($destroy) 
		{
			$this->destroy();
		}
	}
	
	public function resize($imgName,$width, $height,$destroy=false)
	{
		$tmpimg = imagecreatetruecolor($width,$height);
		if(function_exists('imagecopyresampled')) 
		{
			imagecopyresampled($tmpimg, $this->imgObj, 0, 0, 0, 0, $width, $height,imagesx($this->imgObj), imagesy($this->imgObj));
		}
		else
		{
			imagecopyresized($tmpimg, $this->imgObj, 0, 0, 0, 0, $width, $height, imagesx($this->imgObj), imagesy($this->imgObj));
		}
		$this->destroy();
		$this->imgObj = $tmpimg;
		$this->saveImg($imgName,$destroy);
	}
	
	public function destroy()
	{
		if(is_resource($this->imgObj)) imagedestroy($this->imgObj);
	}
	
	public function __destruct()
	{
		$this->destroy();
	}
}