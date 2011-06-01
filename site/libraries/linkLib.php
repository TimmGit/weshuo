<?php
class linkLib
{
	private $mod;
	
	function __construct()
	{
		$this->mod=new linkMod();
	}
	
	public function addLink($title,$url,$linkType=3,$image='',$sort=1)
	{
		if($title && $url)
		{
			$data=array('title'=>$title,'url'=>$url,'sort'=>$sort,'linkType'=>$linkType,'image'=>$image);
			return $this->mod->addLink($data);
		}
		return false;
	}
}