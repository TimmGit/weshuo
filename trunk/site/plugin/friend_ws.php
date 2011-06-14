<?php
/**
 * 
 * @name friend
 * @description test plug
 * @link http://www.weshuo.org
 * @version 1.0
 * @author iceweb
 *
 */
class friend extends PluginAction
{
	public function footer()
	{
		echo "xxxx";
	}
	
	public function adminMenu()
	{
		echo "<a href=".siteUrl('plugin/friend/config').">设置</a>";
	}
	
	public function config()
	{
		if($_POST)
		{
			$mytime=$_POST['mytime'];
			$this->addVar("mytime", $mytime);
		}
		$data['mytime']=$this->getVar("mytime");
		$this->loadView('friend_config',$data);
	}
	
}