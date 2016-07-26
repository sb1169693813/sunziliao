<?php
class BtbWonderfulweekpicDAO
{
	public static function getWonderfulweekpicwithlogList(CommonPRM $cp=null, BtbWonderfulweekpicPRM $cond=null)
	{
		$conn = DataAccess::getDbConnection();

		if(is_null($cond))
		{
			$cond = new BtbWonderfulweekpicPRM();
		}

		if($cond->getCount)
		{
			$sql = ' SELECT count(0) count FROM  btb_wonderfulweekpic as wwp 
			inner join btb_user_weekpic_log as uwl on wwp.log_id = uwl.id 
			WHERE wwp.obj_status = 1 AND uwl.obj_status = 1 ';
		}
		else
		{
			$sql = ' SELECT * FROM btb_wonderfulweekpic as wwp 
			inner join btb_user_weekpic_log as uwl on wwp.log_id = uwl.id 
			WHERE wwp.obj_status = 1 AND uwl.obj_status = 1 ';
		}

		$param = array();

		if(!is_null($cond))
		{
				
			if(!String::isNullOrEmpty($cond->id))
			{
				//自增主键
				$sql .= ' AND wwp.id = :id ';
				$param[':id'] = $cond->id;
			}
			
			if(!String::isNullOrEmpty($cond->log_id))
			{
				//自增主键
				$sql .= ' AND wwp.log_id = :log_id ';
				$param[':log_id'] = $cond->log_id;
			}
			if(!String::isNullOrEmpty($cond->detail_id))
			{
				//自增主键
				$sql .= ' AND wwp.detail_id = :detail_id ';
				$param[':detail_id'] = $cond->detail_id;
			}
			if(!$cond->getCount)
			{
				if(!is_null($cond->order_by))
				{
					$sql .= ' ORDER BY ' . $cond->order_by . ' ';
				}
				if(!is_null($cond->limit))
				{
					$sql .= ' LIMIT ' . $cond->limit;
				}
			}
		}

		$list = BaseDAO::queryList($conn, $cp, $sql, $param);

		if($cond->getCount)
		{
			$list=$list[0]['count'];
		}
		return $list;
	}

}