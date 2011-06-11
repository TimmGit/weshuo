<?php
class userMod
{
	/**
	 * @var mysqlPdo
	 */
	protected $db;
	private $table='user';
	
	function __construct()
	{
		$this->db=wsModel::getInstance();
	}
	
	public function getUserAllCount()
	{
		return $this->db->getCount($this->table);
	}
	
	public function getUserAllList($limit)
	{
		return $this->db->selectData($this->table,'','userId desc',$limit);
	}
	
	public function checkUserLogin($userId,$password,$loginType='id')
	{
		$loginType=strtolower($loginType);
		switch ($loginType)
		{
			case 'id':
				return $this->checkUserLoginById($userId, $password);
				break;
			case 'mail':
				return $this->checkLoginByMail($userId, $password);
				break;
			default:
				return $this->checkLoginByUserName($userId, $password);
				break;
		}
	}
	
	private function checkUserLoginById($userId,$password)
	{
		return $this->db->findData($this->table,array('userId'=>$userId,'password'=>md5($password)));
	}
	
	public function checkExit($field,$mail)
	{
		return $this->db->findData($this->table,array($field=>$mail));
	}
	
	public function checkNickNameIsExit($userId,$nickName)
	{
		return $this->db->findData($this->table,array('userId'=>'!='.$userId,'nickName'=>$nickName));
	}
	
	public function updateUserInfo($userId,$data)
	{
		return $this->db->updateData($this->table,$data,'userId='.$userId);
	}
	
	public function addUser($data)
	{
		return $this->db->insertData($this->table,$data);
	}
	
	public function checkLoginByMail($mail,$password)
	{
		return $this->db->findData($this->table,array('mail'=>$mail,'password'=>md5($password)));
	}
	
	public function checkLoginByUserName($userName,$password)
	{
		return $this->db->findData($this->table,array('userName'=>$userName,'password'=>md5($password)));
	}
	
	public function getUserInfoByHome($home)
	{
		return $this->db->findData($this->table,array('homePage'=>$home));
	}
	
	public function getUserInfoByName($name)
	{
		return $this->db->findData($this->table,array('userName'=>$name));
	}

	public function getUserInfoByMail($mail)
	{
		return $this->db->findData($this->table,array('mail'=>$mail));
	}
	
	public function getUserInfoById($userId)
	{
		return $this->db->findData($this->table,array('userId'=>$userId));
	}
	
	public function getUserByRand($limit=10)
	{
		return $this->db->selectData($this->table,'','RAND() desc',10);
	}
	
	public function getUserInfoByNick($nickName)
	{
		return $this->db->findData($this->table,array('nickName'=>$nickName));
	}
}