<?php
class ExtAction extends admCommonAction
{
	public function index()
	{
		$a=$this->getLocalPlug();
		$this->loadView("ext_index");
	}
	
	private function getLocalPlug()
	{
		$plugArray=array();
		$fileInfo=wsFile::readPath(PLUG_PATH);
		if($fileInfo)
		{
			foreach ($fileInfo as $file)
			{
				if(substr($file,strlen($file)-7)=='_ws.php')
				{
					$plugArray[]=$file;
				}
			}
		}
		return $plugArray;
	}
}