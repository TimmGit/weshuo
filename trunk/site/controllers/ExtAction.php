<?php
class ExtAction extends admCommonAction
{
	public function index()
	{
		$plugLib=new plugLib();
		$data['list']=$plugLib->getAllPlug(3);
		$data['local']=$this->getLocalPlug();
		$this->loadView("ext_index",$data);
	}
	
	public function uninstll()
	{
		$id=$this->checkForm("id", array(3,0), "操作ID错误", array(wsForm::$int,1,2));
		$path=$this->checkForm("path", array(4,0), "插件路径错误", array(wsForm::$string,1,100));
		$plugLib=new plugLib();
		$plugInfo=$plugLib->getPlugInfoByPath($path);
		if(!$plugInfo)
		{
			$this->error('不存在的插件');
		}
		if($id==1)
		{
			$status=$plugInfo['status']==1 ?2:1;
			if($plugInfo && $plugLib->updatePlubInfo(array('status'=>$status), $plugInfo['plugId']))
			{
				wsPlugin::checkPlugCache(TRUE);
				$this->success();
			}
			$this->error();
		}
		elseif ($id==2)
		{
			$plugLib->delPlugById($plugInfo['plugId']);
			wsPlugin::checkPlugCache(TRUE);
			wsPlugin::delPluginVal($plugInfo['plugPath']);
			$this->success();
		}
		$this->error('不存在的操作ID');
	}
	
	public function plugInstall()
	{
		$plugPath=segment(3,0);
		$plugPathSub=segment(4,0);
		$plugPath=$plugPathSub ?$plugPath.'/'.$plugPathSub :$plugPath;
		if(!$plugPath)
		{
			$this->error('插件路径获取失败');
		}
		if(!file_get_contents(PLUG_PATH.$plugPath))
		{
			$this->error('插件不存在');
		}
		$plugInfo=wsPlugin::readPlugInfo(PLUG_PATH.$plugPath);
		$plugPath=substr($plugPath,0,1)=='/'?substr($plugPath,1):$plugPath;
		$plugLib=new plugLib();
		if($plugLib->checkPlugExit($plugPath))
		{
			$this->error('插件已经安装！');
		}
		if($plugLib->addPlug($plugInfo, $plugPath))
		{
			wsPlugin::plugInstall($className, PLUG_PATH.$plugPath);
			wsPlugin::checkPlugCache(true);
			$this->success('插件安装成功！');
		}
		$this->error('插件安装失败');
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
					$info=wsPlugin::readPlugInfo($file);
					$info['file']=str_replace(PLUG_PATH,"",$file);
					$plugArray[]=$info;
				}
			}
		}
		return $plugArray;
	}
}