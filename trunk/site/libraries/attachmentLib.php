<?php
class attachmentLib
{
	/**
	 * 
	 * @var attachmentMod
	 */
	private $mod;
	function __construct()
	{
		$this->mod=new attachmentMod();
	}
	
	public function getAttachementList($where,$limit=8,$order='attId desc')
	{
		return $this->mod->getAttachment($where,$limit,$order);
	}
}