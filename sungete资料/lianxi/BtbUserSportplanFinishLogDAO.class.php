<?php
class BtbUserSportplanFinishLogDAO
{
	public static function getTrainingplanSumtime(Common $cp = null,BtbUserSportplanFinishLog $cond = null)
	{
		$conn = DataAccess::getDbConnection();

		if(is_null($cond))
		{
			$cond = new BtbUserSportplanFinishLogPRM();
		}

		
		$sql = ' SELECT SUM(tp.time) as sumtime FROM btb_user_sportplan_finish_log  as usfl inner join btb_trainingplan_detail as tpd 
		on usfl.trainingplan_detail_id = tpd.id inner join btb_trainingplan on tpd.trainingplan_id = tp.id  
		WHERE usfl.obj_status = 1 AND tpd.obj_status = 1 AND tp.obj_status = 1 AND usfl.type = 1 ';
		

		$param = array();

		if(!is_null($cond))
		{
				
			if(!String::isNullOrEmpty($cond->id))
			{
				//自增主键
				$sql .= ' AND usfl.id = :id ';
				$param[':id'] = $cond->id;
			}
			if(!String::isNullOrEmpty($cond->user_id))
			{
				//用户ID
				$sql .= ' AND usfl.user_id = :user_id ';
				$param[':user_id'] = $cond->user_id;
			}
			if(!String::isNullOrEmpty($cond->trainingplan_detail_id))
			{
				//运动项目ID
				$sql .= ' AND usfl.trainingplan_detail_id = :trainingplan_detail_id ';
				$param[':trainingplan_detail_id'] = $cond->trainingplan_detail_id;
			}
			if(!String::isNullOrEmpty($cond->type))
			{

				$sql .= ' AND usfl.type = :type ';
				$param[':type'] = $cond->type;
			}
			if(!String::isNullOrEmpty($cond->enddate))
			{
				//星期几（1-7）
				$sql .= ' AND usfl.enddate = :enddate ';
				$param[':enddate'] = $cond->enddate;
			}
			if(!String::isNullOrEmpty($cond->obj_createdate_gt))
			{
				$sql .=' AND usfl.obj_createdate > :obj_createdate_gt';
				$param[':obj_createdate_gt'] = $cond->obj_createdate_gt;
			}
			if(!String::isNullOrEmpty($cond->obj_createdate_lt))
			{
				$sql .=' AND usfl.obj_createdate < :obj_createdate_lt';
				$param[':obj_createdate_lt'] = $cond->obj_createdate_lt;
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


	public static function getOncetrainingplanSumtime(Common $cp = null,BtbUserSportplanFinishLog $cond = null)
	{
		$conn = DataAccess::getDbConnection();

		if(is_null($cond))
		{
			$cond = new BtbUserSportplanFinishLogPRM();
		}

		
		$sql = ' SELECT SUM(otp.time) as sumtime FROM btb_user_sportplan_finish_log  as usfl 
		inner join btb_oncetrainingplan as otp on usfl.trainingplan_detail_id = otp.id 
		WHERE usfl.obj_status = 1 AND otp.obj_status = 1 AND usfl.type = 2 ';
		

		$param = array();

		if(!is_null($cond))
		{
				
			if(!String::isNullOrEmpty($cond->id))
			{
				//自增主键
				$sql .= ' AND usfl.id = :id ';
				$param[':id'] = $cond->id;
			}
			if(!String::isNullOrEmpty($cond->user_id))
			{
				//用户ID
				$sql .= ' AND usfl.user_id = :user_id ';
				$param[':user_id'] = $cond->user_id;
			}
			if(!String::isNullOrEmpty($cond->trainingplan_detail_id))
			{
				//运动项目ID
				$sql .= ' AND usfl.trainingplan_detail_id = :trainingplan_detail_id ';
				$param[':trainingplan_detail_id'] = $cond->trainingplan_detail_id;
			}
			if(!String::isNullOrEmpty($cond->type))
			{

				$sql .= ' AND usfl.type = :type ';
				$param[':type'] = $cond->type;
			}
			if(!String::isNullOrEmpty($cond->enddate))
			{
				//星期几（1-7）
				$sql .= ' AND usfl.enddate = :enddate ';
				$param[':enddate'] = $cond->enddate;
			}
			if(!String::isNullOrEmpty($cond->obj_createdate_gt))
			{
				$sql .=' AND usfl.obj_createdate > :obj_createdate_gt';
				$param[':obj_createdate_gt'] = $cond->obj_createdate_gt;
			}
			if(!String::isNullOrEmpty($cond->obj_createdate_lt))
			{
				$sql .=' AND usfl.obj_createdate < :obj_createdate_lt';
				$param[':obj_createdate_lt'] = $cond->obj_createdate_lt;
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