<?php
class TcpAction extends admCommonAction
{
	
	public function commentInfo()
	{
		$commentLib=new commentLib();
		if($_POST)
		{
			$data=$_POST;
			$id=$this->checkForm("commentId","post", "评论ID错误", array(wsForm::$int,1,wsForm::$intMax));
			unset($data['commentId']);
			unset($data['button']);
			if($commentLib->setCommentById($data, $id))
			{
				$this->success();
			}
			$this->error();
		}
		else 
		{
			$id=$this->checkForm("commtentId", array(3,1), "评论ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$info=$commentLib->getCommentInfo($id);
			if(!$info)
			{
				$this->error('错误的微博ID');
			}
			$this->loadView('tcp_commentinfo',array('info'=>$info));
		}
	}
	
	public function comment()
	{
		$commentLib=new commentLib();
		if($_POST)
		{
			$checkId=$this->checkForm("checkId","post","选择的ID错误", array(wsForm::$intArr,0,wsForm::$intMax));
			foreach ($checkId as $commentId)
			{
				if($commentId && is_numeric($commentId))
				{
					$commentLib->delComment($commentId);
				}
			}
			$this->success();
		}
		else 
		{
			$nowPage=$this->checkForm("page", array(3,1), "分页ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$allCount=$commentLib->getCommentCount();
			$pageSize=25;
			$pageTool=new pageTool($nowPage, $allCount, $pageSize);
			$data=array();
			$data['list']=$commentLib->getCommentList(FALSE,$nowPage, $pageSize);
			$data['page']=$pageTool->show('tcp/comment');
			$this->loadView("tcp_comment",$data);
		}
	}
	
	public function groupInfo()
	{
		$groupLib=new groupLib();
		if($_POST)
		{
			$data=array();
			$groupId=$this->checkForm("groupId","post", "群组ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$uploadFile=new uploadFile('group');
			$imgName=$uploadFile->uploadImg('icon');
			if($imgName)
			{
				$data['icon']=$imgName;
			}
			$data['groupName']=$_POST['groupName'];
			$data['userId']=$_POST['userId'];
			$data['sort']=$_POST['sort'];
			$data['groupType']=$_POST['groupType'];
			$data['isShow']=$_POST['isShow']?1:2;
			$data['isSend']=$_POST['isSend']?1:2;
			$data['isReplay']=$_POST['isReplay']?1:2;
			$data['isJoin']=$_POST['isJoin']?1:2;
			$data['memo']=$_POST['memo'];
			if($groupLib->updateGroup($data, $groupId))
			{
				$this->success();
			}
			$this->error();
		}
		else 
		{
			$id=$this->checkForm("topicId", array(3,1), "群组ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$info=$groupLib->getGroupInfo($id);
			if(!$info)
			{
				$this->error('错误的微博ID');
			}
			$this->loadView('tcp_groupinfo',array('info'=>$info));
		}
	}
	
	public function group()
	{
		$groupLib=new groupLib();
		if($_POST)
		{
			$checkId=$this->checkForm("checkId","post","选择的ID错误", array(wsForm::$intArr,0,wsForm::$intMax));
			foreach ($checkId as $groupId)
			{
				if($groupId && is_numeric($groupId))
				{
					$groupLib->delGroup($groupId);
				}
			}
			$this->success();
		}
		else 
		{
			$nowPage=$this->checkForm("page", array(3,1), "分页ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$allCount=$groupLib->getGroupCount();
			$pageSize=25;
			$pageTool=new pageTool($nowPage, $allCount, $pageSize);
			$data=array();
			$data['list']=$groupLib->getGroupList(FALSE,$nowPage, $pageSize);
			$data['page']=$pageTool->show('tcp/group');
			$this->loadView("tcp_group",$data);
		}
	}
	
	public function topicInfo()
	{
		$topicLib=new topicLib();
		if($_POST)
		{
			$data=$_POST;
			$topicId=$this->checkForm("topicId","post", "微博ID错误", array(wsForm::$int,1,wsForm::$intMax));
			unset($data['topicId']);
			unset($data['button']);
			if($topicLib->setTopic($data, $topicId))
			{
				$this->success();
			}
			$this->error();
		}
		else 
		{
			$topicId=$this->checkForm("topicId", array(3,1), "微博ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$info=$topicLib->getInfo($topicId);
			if(!$info)
			{
				$this->error('错误的微博ID');
			}
			$this->loadView('tcp_topicinfo',array('info'=>$info));
		}
	}
	
	public function topic()
	{
		$topicLib=new topicLib();
		if($_POST)
		{
			$checkId=$this->checkForm("checkId","post","选择的ID错误", array(wsForm::$intArr,0,wsForm::$intMax));
			foreach ($checkId as $topicId)
			{
				if($topicId && is_numeric($topicId))
				{
					$topicLib->delTopic($topicId);
				}
			}
			$this->success();
		}
		else 
		{
			$nowPage=$this->checkForm("page", array(3,1), "分页ID错误", array(wsForm::$int,1,wsForm::$intMax));
			$allCount=$topicLib->getTopicCount();
			$pageSize=25;
			$pageTool=new pageTool($nowPage, $allCount, $pageSize);
			$data=array();
			$data['list']=$topicLib->getTopicList($nowPage, $pageSize);
			$data['page']=$pageTool->show('tcp/topic');
			$this->loadView("tcp_topic",$data);
		}
	}
	
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