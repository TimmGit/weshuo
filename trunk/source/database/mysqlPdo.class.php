<?php
!defined("WS_ROOT") && exit('No direct script access allowed');
/**
* weshuo microblog platform
* @copyright  (c) 2010-2011 weshuo team http://www.weshuo.org
* @license  The Mozilla Public License (MPL 1.1)
* @author iceweb
*/ 
class mysqlPdo implements dbInterface
{
	private static $dbConfig=array();
	private static $dbConn=NULL;
	private static $sql='';
	private static $dbh;
	private static $count=0;
	
	function __construct()
	{
		if(is_null(self::$dbConn) || !isset(self::$dbConn))
		{
			self::getConn();
		}
	}
	
	private static function getConn()
	{
		try 
		{
			self::$dbConfig=setting::getDb();
			$options=array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			self::$dbConn=new PDO('mysql:dbname='.self::$dbConfig['dbName'].';host='.self::$dbConfig['dbHost'].';port='.self::$dbConfig['dbPort'],self::$dbConfig['dbUser'],self::$dbConfig['dbPwd'], $options);
			self::$dbConn->query("set names ".str_replace("-",'',CHARSET));
		}
		catch (Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * 执行SQL语句
	 * @param string $sql;
	 * @see dbInterface::querySql()
	 */
	public function querySql($sql)
	{
		self::$sql=$sql;
		self::$dbh=self::$dbConn->query(self::$sql);
		return self::$dbh->fetchAll();
	}
	
	/**
	 * 返回影响的行数
	 * @see dbInterface::rowCount()
	 */
	public function rowCount()
	{
		return self::$dbh->RowCount() ?self::$dbh->RowCount() :self::$count;
	}
	
	/**
	 * 返回一个字段
	 * @param string $sql
	 * @param int $int
	 * @see dbInterface::getOne()
	 */
	public function getOne($sql, $int=0)
	{
		self::$dbh=$this->querySql($sql);
		return self::$dbh->fetchColumn($int);
	}
	
	/**
	 * 返回一行记录
	 * @param string $sql
	 * @see dbInterface::getRow()
	 */
	public function getRow($sql)
	{
		$sql=$sql.' limit 1';
		return $this->querySql($sql);
	}
	
	/**
	 * 执行SQL语句 返回boolean
	 * @param string $sql
	 * @see dbInterface::execSql()
	 */
	public function execSql($sql)
	{
		$count=false;
		self::$sql=$sql;
		$count=self::$dbConn->exec(self::$sql);
		if($count===false)
		{
			return false;
		}
		else 
		{
			self::$count=$count;
			return true;
		}
	}
	
	/**
	 * 查询数据
	 * @param string $table
	 * @param array $where
	 * @param string $order
	 * @param string $limit
	 * @see dbInterface::selectData()
	 */
	public function selectData($table, $where, $order=FALSE, $limit=FALSE)
	{
		if(is_array($where))
		{
			$where=sqlTool::array2sql($where);
		}
		$sql="select * from ".self::$dbConfig['dbPrefix'].$table." where 1=1 ".$where;
		if($order)
		{
			$sql.=" order by ".$order;
		}
		if($limit)
		{
			$sql.=' limit '.$limit;
		}
		self::$sql=$sql;
		self::$dbh=self::$dbConn->query(self::$sql);
		return self::$dbh->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * 更新数据
	 * @param string $table
	 * @param array $where
	 * @param array $data
	 * @see dbInterface::updateData()
	 */
	public function updateData($table, $data, $where)
	{
		if(is_array($where))
		{
			$where=sqlTool::array2sql($where);
		}
		if(is_array($data))
		{
			$data=sqlTool::array2setSql($data);
		}
		$sql="update ".self::$dbConfig['dbPrefix'].$table." set ".$data.' where 1=1 '.$where;
		return $this->execSql($sql);
	}
	
	/**
	 * 删除数据
	 * @see dbInterface::deleteData()
	 */
	public function deleteData($table, $data, $where)
	{
		if(is_array($data))
		{
			$data=sqlTool::array2setSql($data);
		}
		if(is_array($where))
		{
			$where=sqlTool::array2sql($where);
		}
		$sql="delete from ".self::$dbConfig['dbPrefix'].$table." where 1=1 ".$where;
		return $this->execSql($sql);
		
	}
	
	/**
	 * 插入数据
	 * @see dbInterface::insertData()
	 */
	public function insertData($table, $data)
	{
		if(is_array($data))
		{
			$data=sqlTool::array2insert($data);
			self::$sql="insert into ".self::$dbConfig['dbPrefix'].$table."(".$data['field'].")values(".$data['value'].")";
			self::$dbh=self::$dbConn->query(self::$sql);
			return $this->lastInsertId();	
		}
	}
	
	/**
	 * 查询数据
	 * @see dbInterface::findData()
	 */
	public function findData($table, $where,$order=false)
	{
		if(is_array($where))
		{
			$where=sqlTool::array2sql($where);
		}
		$sql="select * from ".self::$dbConfig['dbPrefix'].$table." where 1=1 ".$where;
		if($order)
		{
			$sql.=" order by ".$order;
		}
		$sql.=' limit 1';
		self::$sql=$sql;
		self::$dbh=self::$dbConn->query(self::$sql);
		return self::$dbh->fetch(PDO::FETCH_ASSOC);
	}
	
	public function getLastSql()
	{
		return self::$sql;
	}
	
	public function lastInsertId()
	{
		return self::$dbConn->lastInsertId();
	}
}
