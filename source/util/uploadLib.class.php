<?php
class uploadLib
{
	private $path='';
	private $errInfo='';
	private $fileSize='2097152';
	private $allowExt=array('jpg','gif','png','rar','zip','7z');
	private $allow=false;
	private $ext='';
	public $isImg=false;
	
	function __construct($path=false)
	{
		$this->path=WS_ROOT.'static/upload/'.$path.'/';
	}
	
	public function setInfo($fileSize=false,$fileExt=false)
	{
		if($fileSize)
		{
			$this->fileSize=$fileSize;
		}
		if($fileExt && is_array($fileExt))
		{
			$this->allowExt=$fileExt;
		}
	}
	
	public function debug()
	{
		return $this->errInfo;
	}
	
	private function checkFileType($type)
	{
		switch ($type)
		{
			case "application/x-zip-compressed":
				$this->allow=true;
				$this->ext='zip';
				break;
			case "application/zip":
				$this->allow=true;
				$this->ext='zip';
				break;
			case  "image/pjpeg":
		  		$this->allow =true;
		  		$this->ext='jpg';
		  		break;
		  	case  "image/jpeg":
		  		$this->allow =true;
		  		$this->ext='jpg';
		  		break;
		  	case  "image/jpg":
		  		$this->allow =true;
		  		$this->ext='jpg';
		  		break;
		  	case "image/gif":
		  		$this->allow =true;
		  		$this->ext='gif';
		  		break;
		  	case  "image/x-png":
		  		$this->allow =true;
		  		$this->ext='png';
		  		break;
		  	case "application/x-rar-compressed":
		  		$this->allow=true;
		  		$this->ext='rar';
		  		break;
		  	case "application/x-7z-compressed":
		  		$this->allow=true;
		  		$this->ext='7z';
		  		break;
		  	default:
		  		$this->allow =false;
		}
	}
	
	private function checkFileExtIsOk()
	{
		$isOk=false;
		foreach ($this->allowExt as $v)
		{
			if($this->ext==$v)
			{
				$isOk=true;
				break;
			}
		}
		return $isOk;
	}
	
	public function uploadImg($dir='upload')
	{
		if (!isset($_FILES[$dir]))
		{
			$this->errInfo='1005';
			return false;
		}
		if (is_uploaded_file($_FILES["$dir"]["tmp_name"]))
		{
			$file_type=$_FILES[$dir]['type'];
			$this->checkFileType($file_type);
			if($this->checkFileExtIsOk()==false || $this->allow==false)
			{
				$this->errInfo='1000';
				return false;
			}
			if($_FILES["$dir"]['size']<1)
			{
				$this->errInfo='1001';
				return false;
			}
			if($_FILES["$dir"]['size']>$this->fileSize)
			{
				$this->errInfo='1002';
				return false;
			}
			$newName=date("YmdHis").mt_rand(10,9999).'.'.$this->ext;
			$newPath=$this->path.$newName;
			move_uploaded_file($_FILES [$dir]['tmp_name'],$newPath);
			if ($_FILES[$dir]['error']==0)
			{
				if(@getimagesize($newPath)!==false)
				{
					$this->isImg=true;
				}
				return $newName;
			}
			else
			{
				$this->errInfo='1003';
				return false;
			}
		}
		else
		{
			$this->errInfo=$_FILES[$dir]['error'];
			return false;
		}
	}
}