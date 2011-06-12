<?php
class TcpAction extends admCommonAction
{
	
	public function tagInfo()
	{
		$tagLib=new tagLib();
		if($_POST)
		{
			$tagId=$_POST['tagId'];
			$data['tagName']=$this->checkForm("tagName", "post", "话题名称长度错误5-30", array(wsForm::$string,5,30));
			$data['userId']=$this->checkForm("userId", "post", "创建者长度错误5+", array(wsForm::$int,5,wsForm::$intMax));
			$data['home']=$this->checkForm("home", "post", "主页地址长度错误5-30", array(wsForm::$string,5,30,TRUE));
			$data['count']=$this->checkForm("count", "post", "总计数据错误", array(wsForm::$int,0,wsForm::$intMax));
			$data['topicId']=$_POST['topicId'];
			if($tagLib->setTagInfo($data, $tagId))
			{
				$this->success();
			}
			$this->error();
		}
		else 
		{
			$id=$this->checkForm("tagId", array(3,1), "话题ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$info=$tagLib->getInfo($id);
			if(!$info)
			{
				$this->error('错误的话题ID');
			}
			$this->loadView('tcp_taginfo',array('info'=>$info));
		}
	}
	
	public function tag()
	{
		$tagLib=new tagLib();
		if($_POST)
		{
			$checkId=$this->checkForm("checkId","post","选择的ID错误", array(wsForm::$intArr,0,wsForm::$intMax));
			foreach ($checkId as $tagId)
			{
				if($tagId && is_numeric($tagId))
				{
					$tagLib->delTag($tagId);
				}
			}
			$this->success();
		}
		else 
		{
			$nowPage=$this->checkForm("page", array(3,1), "分页ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$allCount=$tagLib->getTagAllCount();
			$pageSize=25;
			$pageTool=new pageTool($nowPage, $allCount, $pageSize);
			$data=array();
			$data['list']=$tagLib->getTagAllList($nowPage, $pageSize);
			$data['page']=$pageTool->show('tcp/tag');
			$this->loadView("tcp_tag",$data);
		}
	}
}