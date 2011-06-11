<?php
class UcpAction extends admCommonAction
{
	public function user()
	{
		$userAdmLib=new userAdmLib();
		$nowPage=$this->checkForm("page", array(3,1), "分页ID错误", array(wsForm::$int,1,wsForm::$intMax));
		$allCount=$userAdmLib->getUserAllCount();
		$pageSize=25;
		$pageTool=new pageTool($nowPage, $allCount, $pageSize);
		$data=array();
		$data['list']=$userAdmLib->getUserAllList($nowPage, $pageSize);
		$data['page']=$pageTool->show('ucp/user');
		$this->loadView("user_list",$data);
	}
}