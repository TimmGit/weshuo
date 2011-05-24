<?php
class sqlTool
{
	public static function array2sql($where)
	{
		$sql='';
		if(is_array($where))
		{
			foreach ($where as $k=>$v)
			{
				$sql.=' and ';
				$fuhao=substr($v,0,1);
				if($fuhao=='<' || $fuhao=='>' || $fuhao=='!')
				{
					$sql.=$k.$v;
				}
				else
				{
					$sql.=$k."='".$v."'";
				}
			}
		}
		return $sql;
	}
	
	public static function array2setSql($data)
	{
		$setSql="";
		if(is_array($data))
		{
			foreach ($data as $k=>$v)
			{
				if($v)
				{
					$setSql.=$k."='".$v."',";
				}
			}
		}
		return $setSql ? substr($setSql,0,-1):'';
	}
	
	public static function array2insert($data)
	{
		if(is_array($data))
		{
			$field='';
			$value='';
			foreach ($data as $k=>$v)
			{
				$field.=$k.',';
				$value.="'".$v."',";
			}
			return array('field'=>substr($field,0,-1),'value'=>substr($value,0,-1));
		}
	}
}