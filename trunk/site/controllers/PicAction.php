<?php
class PicAction extends CommonAction
{
	public function index()
	{
		parent::setTitle("图片微博--");
		$attache=new attachmentLib();
		$pic=$attache->getAttachementList(array('fileType'=>1,'publish'=>1),30,'rand()');
		$imglist="";
		foreach($pic as $k=>$v)
		{
			$rot = rand(-40,40);
			$imglist.='<div id="pic-'.$k.'" class="pic" style="top:'.mt_rand(0,380).'px;left:'.mt_rand(0,700).
			'px;background:url('.baseUrl()."/static/upload/thumb_".$v['fileName'].') no-repeat 50% 50%; -moz-transform:rotate('.
			$rot.'deg); -webkit-transform:rotate('.$rot.'deg);"><a class="fancybox" rel="fncbx" href="'.
			baseUrl()."/static/upload/".$v['fileName'].'" target="_blank">x</a></div>|';
		}
		$data['plist']=explode("|",substr($imglist,0,strlen($imglist)-1));
		$this->loadView('pic_index',$data);
	}
}