<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
class pageTool
{
	private $nowPage=1;
	private $allPage=1;
	private $pageSize;
	private $first='第一页';
	private $last='最后一页';
	private $next='下一页';
	private $prov='上一页';
	private $pageName='页';
	private $up="上";
	private $down="下";
	
	function __construct($nowPage,$allCount,$pageSize)
	{
		$this->nowPage=$nowPage;
		$this->pageSize=$pageSize;
		$this->allPage=$allCount?ceil($allCount/$pageSize):1;
	}
	
	public function setConfig($fist,$last,$next,$prov,$pageName,$up=FALSE,$down=FALSE)
	{
		$this->first=$fist;
		$this->last=$last;
		$this->next=$next;
		$this->prov=$prov;
		$this->pageName=$pageName;
		if($up)
		{
			$this->up=$up;
		}
		if($down)
		{
			$this->down=$down;
		}
	}
	
	public function show($url)
	{
		$html='';
		if($this->nowPage<=1)
		{
			$html=$this->first.' '.$this->prov;
		}
		else 
		{
			$page=($this->nowPage-1)>0 ?$this->nowPage-1 :1;
			$html="<a href='".siteUrl($url.'/1')."'>$this->first</a>  <a href='".siteUrl($url.'/'.$page)."'>$this->prov</a>  ";
		}
		if($this->nowPage > $this->allPage)
		{
			$html.=$this->next.' '.$this->last;
		}
		else 
		{
			$page=($this->nowPage+1)>$this->allPage ?$this->allPage :($this->nowPage+1);
			$html.="<a href='".siteUrl($url.'/'.$page)."'>$this->next</a>  <a href='".siteUrl($url.'/'.$this->allPage)."'>$this->last</a> ";
		}
		$html.=$this->nowPage.'/'.$this->allPage.$this->pageName;
		return $html;
	}
	
	public function showNum($url,$num=5)
	{
		$html='';
		if($this->nowPage>1)
		{
			$page=$this->nowPage-1;
			$html="<a href='".siteUrl($url.'/1')."'>$this->first</a>  <a href='".siteUrl($url.'/'.$page)."'>$this->prov</a>  ";
		}
		if($this->nowPage>$num)
		{
			$page=$this->nowPage-$num;
			$html.=" <a href='".siteUrl($url.'/'.$page)."'>".$this->up.$num.$this->pageName."</a> ";
		}
		if($this->allPage>$num)
		{
			for ($i=0;$i<$num;$i++)
			{
				if($this->nowPage+$num>$this->allPage)
				{
					$html.=" <a href='".siteUrl($url.'/'.($this->nowPage-$num+$i))."'>".($this->nowPage-$num+$i)."</a> ";
				}
				else 
				{
					$html.=" <a href='".siteUrl($url.'/'.($this->nowPage+$i))."'>".($this->nowPage+$i)."</a> ";
				}			
			}
		}
		if($this->allPage>=$num)
		{
			$page=$this->nowPage+$num;
			$html.=" <a href='".siteUrl($url.'/'.$page)."'>".$this->down.$num.$this->pageName."</a> ";
		}
		if($this->nowPage < $this->allPage)
		{
			$page=$this->nowPage+1;
			$html.="<a href='".siteUrl($url.'/'.$page)."'>$this->next</a>  <a href='".siteUrl($url.'/'.$this->allPage)."'>$this->last</a> ";
		}
		return $html;
	}
}