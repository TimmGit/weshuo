<?php
class MapAction extends  CommonAction
{
	public function index()
	{
		parent::setTitle("地图微博--");
		$userLib=new userLib();
		$topicLib=new topicLib();
		$listTopic=$topicLib->getTopicList(1,2);
		$commentLib=new commentLib();
		$listCm=$commentLib->getCommentList(false,1,2);
		$newArray=array_merge($listTopic,$listCm);
		$newArray=list_sort_by($newArray,'time');
		$data['newTopic']=$this->formatTopicInfo($userLib,$newArray[0]);
		$this->loadView("map_index",$data);
	}
	
	private function formatTopicInfo(userLib $userLib,$info)
	{
		$content=isset($info['title']) ?$info['title'] :$info['content'];
		$info['title']=topicExtra::getBlogCommon($content);
		$info['numTime']=$info['time'];
		$info['time']=topicExtra::getTime($info['time']);
		$userInfo=$userLib->getUserInfo($info['userId'],'ID');
		$info['userName']=$userInfo['nickName'] ?$userInfo['nickName'] :$userInfo['userName'];
		$info['icon']=baseUrl('static/upload/face/ws_60_').($userInfo['icon']? $userInfo['icon'] :'icon.jpg');
		return $info;
	}
	
	public function last()
	{
		$userLib=new userLib();
		$id=isset($_POST['id']) ?intval($_POST['id']) :exit;
		$topicLib=new topicLib();
		$listTopic=$topicLib->getTopicList(1,2,array('time'=>'<'.$id),'time desc');
		$commentLib=new commentLib();
		$listCm=$commentLib->getCommentList(array('time'=>'<'.$id),1,3,'time desc');
		$newArray=array_merge($listTopic,$listCm);
		$newArray=list_sort_by($newArray,'time');
		$info=$this->formatTopicInfo($userLib,$newArray[0]);
		echo json_encode($info);	
	}
}