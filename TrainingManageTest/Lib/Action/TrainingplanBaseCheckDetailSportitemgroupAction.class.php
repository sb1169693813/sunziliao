<?php
class TrainingplanBaseCheckDetailSportitemgroupAction extends BaseAction
{
	//课程动作列表
	public function index()
	{
		$cp = new CommonPRM();
		$trainingplan_base_id = isset($_GET['id']) ? trim($_GET['id']):null;	
		//查询trainingplanBaseList
		$btbTrainingplanBasePRM = new BtbTrainingplanBasePRM();
		$btbTrainingplanBasePRM->id = $trainingplan_base_id;
		$trainingplanBaseList = BtbTrainingplanBaseBLL::getTrainingplanBaseList($cp,$btbTrainingplanBasePRM);
		$trainingplanBaseList = $trainingplanBaseList[0];
		//查询trainingplanConfigList
		$btbTrainingplanConfigPRM = new BtbTrainingplanConfigPRM();
		$btbTrainingplanConfigPRM->trainingplan_base_id = $trainingplan_base_id;
		$trainingplanConfigList = BtbTrainingplanConfigBLL::getTrainingplanConfigList($cp,$btbTrainingplanConfigPRM);
    	if(count($trainingplanConfigList)>0)
    	{
    		$trainingplanConfig = $trainingplanConfigList[0];
    		$this->assign('trainingplanConfig',$trainingplanConfig);
    	}
		//查询动作信息
		$btbTrainingplanSportitemgroupDetailPRM = new BtbTrainingplanSportitemgroupDetailPRM();
		$btbTrainingplanSportitemgroupDetailPRM->trainingplan_base_id = $trainingplan_base_id;
		$sportitemgroupList = BtbTrainingplanSportitemgroupDetailBLL::getTrainingplanSportitemgroupDetailEntityList($cp,$btbTrainingplanSportitemgroupDetailPRM);
		$sList1 = array();
		$sList2 = array();
		$sList3 = array();
		foreach ($sportitemgroupList as $sl)
		{
			//热身阶段动作
			if($sl['sportitemgrouptype'] == 1)
    		{	
    			$sList1[] = $sl;
    		}
    		//练习阶段动作
    		for($i=0;$i<$trainingplanConfig['sportitemgroupcount'];$i++)
    		{
    			if($sl['sportitemgrouptype'] == 2 && $sl['sort'] == ($i+1))
	    		{
	    			$sList2[][$i] = $sl;
	    		}
	   		}
//    		if($sl['sportitemgrouptype'] == 2)
//    		{
//    			$sList2[] = $sl;
//    		}
    		//拉伸阶段动作
    		if($sl['sportitemgrouptype'] == 3)
    		{
    			$sList3[] = $sl;
    		}
		}
		//获取登录者的信息
		$user = $this->getLoginInfo();
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
		//$this->assign('sportitemgroupcount',$sportitemgroupcount);
    	$this->assign('sl1',$sList1);
    	$this->assign('sl2',$sList2);
    	$this->assign('sl3',$sList3);
    	//课程设计审核后台审核通过,退件页面	
		$this->assign('addtype',5);
		$this->assign('trainingplanBaseList',$trainingplanBaseList);
		//menu课程设计
		$this->assign('headtype',3);	
		//$this->display("TrainingplanBaseCheckDetailSportitemgroup/index");
		$this->display("TrainingplanBaseCheck/trainingplanBaseCheckDetailSportitemgroup");	
	}
	
	//课程设计审核动作列表批注
	public function trainingplanBaseComment()
	{
		//接收传过来的数据
		//trainingplan_base_id
		$trainingplan_base_id = isset($_POST['trainingplan_base_id']) ? trim($_POST['trainingplan_base_id']):null;
		//auditreply审核回复
		$auditreply = isset($_POST['auditreply']) ? trim($_POST['auditreply']):null;
		$jsondata = array();
		$cp = new CommonPRM();
		$btbTrainingplanBasePRM = new BtbTrainingplanBasePRM();
		$btbTrainingplanBasePRM->id = $trainingplan_base_id;
		$trainingplanBaseList = BtbTrainingplanBaseBLL::getTrainingplanBaseList($cp,$btbTrainingplanBasePRM);
		if(count($trainingplanBaseList) > 0)
		{
			$dataTrainingplanBase = array();
			$dataTrainingplanBase['id'] = $trainingplan_base_id;
			$dataTrainingplanBase['auditreply'] = $auditreply;
			$rowsTrainingplanBase = BtbTrainingplanBaseBLL::btbTrainingplanBaseUpdate($dataTrainingplanBase);
			if($rowsTrainingplanBase > 0)
			{
				//保存批注成功
				//$flag = 1;
				$jsondata['code'] = 1;
				$jsondata['msg'] = '保存批注成功';
			}
			else
			{
				//保存批注失败
				//$flag = 0;
				$jsondata['code'] = -1;
				$jsondata['msg'] = '保存批注失败';
			}
		}
		//$this->ajaxReturn($flag);	
		$this->ajaxReturn($jsondata);
	}
	
	//课程设计审核动作列表通过
	public function trainingplanBasePass()
	{
		//接收传过来的数据
		//trainingplan_base_id
		$trainingplan_base_id = isset($_POST['trainingplan_base_id']) ? trim($_POST['trainingplan_base_id']):null;
		$jsondata = array();
		$dataTrainingplanBase = array();
		$dataTrainingplanBase['id'] = $trainingplan_base_id;
		//auditstatus 2 已审核
		$dataTrainingplanBase['status'] = 2;
		$dataTrainingplanBase['auditdate'] = date('Y-m-d H:i:s',time());
		$rowsTrainingplanBase = BtbTrainingplanBaseBLL::btbTrainingplanBaseUpdate($dataTrainingplanBase);
		if($rowsTrainingplanBase > 0)
		{
			//修改状态成功
			//$flag = 1;
			$jsondata['code'] = 1;
			//插入日志status0未提交 1提交 2 审核通过 3发布 -1 审核未通过
			$dataTrainingplanLog = array();
			$dataTrainingplanLog['trainingplan_base_id'] = $trainingplan_base_id;
			$dataTrainingplanLog['status'] = 2;
			$rowsTrainingplanLog = BtbTrainingplanLogBLL::btbTrainingplanLogInsert($dataTrainingplanLog);
			if($rowsTrainingplanLog > 0)
			{
				$jsondata['code'] = 1;
			}
			else
			{
				$jsondata['code'] = -2;
				$jsondata['msg'] = '插入方案日志失败';
			}
		}
		else
		{
			//修改状态失败
			//$flag = 0;			
			$jsondata['code'] = -1;
			$jsondata['msg'] = '修改方案审核状态失败';
		}
		//$this->ajaxReturn($flag);
		$this->ajaxReturn($jsondata);
	}
	
	//课程设计审核动作列表退件
	public function trainingplanBaseBounce()
	{
		//接收传过来的数据
		//$trainingplan_base_id
		$trainingplan_base_id = isset($_POST['trainingplan_base_id']) ? trim($_POST['trainingplan_base_id']):null;
		$jsondata = array();
		$dataTrainingplanBase = array();
		$dataTrainingplanBase['id'] = $trainingplan_base_id;
		//auditstatus -1 未通过
		$dataTrainingplanBase['status'] = -1;
		$dataTrainingplanBase['auditdate'] = date('Y-m-d H:i:s',time());
		$rowsTrainingplanBase = BtbTrainingplanBaseBLL::btbTrainingplanBaseUpdate($dataTrainingplanBase);
		if($rowsTrainingplanBase > 0)
		{
			//修改状态成功
			//$flag = 1;
			$jsondata['code'] = 1;
			//插入日志status0未提交 1提交 2 审核通过 3发布 -1 审核未通过
			$dataTrainingplanLog = array();
			$dataTrainingplanLog['trainingplan_base_id'] = $trainingplan_base_id;
			$dataTrainingplanLog['status'] = -1;
			$rowsTrainingplanLog = BtbTrainingplanLogBLL::btbTrainingplanLogInsert($dataTrainingplanLog);
			if($rowsTrainingplanLog > 0)
			{
				$jsondata['code'] = 1;
			}
			else
			{
				$jsondata['code'] = -2;
				$jsondata['msg'] = '插入方案日志失败';
			}
		}
		else
		{
			//修改状态失败
			//$flag = 0;
			$jsondata['code'] = -1;
			$jsondata['msg'] = '修改方案审核状态失败';
		}
		//$this->ajaxReturn($flag);
		$this->ajaxReturn($jsondata);
	}

	//动作列表查看动作页面
    public function sportitemgUpdateIndex()
    {
    	$cp = new CommonPRM();
    	//根据id查动作组详情
		$trainingplan_outline_detail_sportitem_id = isset($_POST['trainingplan_outline_detail_sportitem_id']) ? trim($_POST['trainingplan_outline_detail_sportitem_id']):null;
		//$trainingplan_outline_detail_sportitem_id =11;
    	$btbTrainingplanSportitemgroupDetailPRM = new BtbTrainingplanSportitemgroupDetailPRM();
		$btbTrainingplanSportitemgroupDetailPRM->id = $trainingplan_outline_detail_sportitem_id;
		$trainingplanSportitemgroupDetailByIdList = BtbTrainingplanSportitemgroupDetailBLL::getTrainingplanSportitemgroupDetailByIdList($cp,$btbTrainingplanSportitemgroupDetailPRM);
		$trainingplanSportitemgroupDetailByIdList = $trainingplanSportitemgroupDetailByIdList[0];
		//根据动作组表展示大纲动作列表
		//查询动作（根据已审核的单天大纲内容，提供可选择动作）
		$outline_id = isset($_POST['outline_id']) ? trim($_POST['outline_id']):null;
		//$outline_id = 48;
		//outline_detail_id
		$outline_detail_id = isset($_POST['outline_detail_id']) ? trim($_POST['outline_detail_id']):null;
		//$outline_detail_id = 80;
		//sportitemgrouptype
		$sportitemgrouptype = isset($_POST['sportitemgrouptype']) ? trim($_POST['sportitemgrouptype']):null;
		//$sportitemgrouptype = 2;
		$btbTrainingplanOutlineDetailSportitemPRM = new BtbTrainingplanOutlineDetailSportitemPRM();
		$btbTrainingplanOutlineDetailSportitemPRM->outline_id = $outline_id;
		$btbTrainingplanOutlineDetailSportitemPRM->outline_detail_id = $outline_detail_id;
		$btbTrainingplanOutlineDetailSportitemPRM->sportitemgrouptype = $sportitemgrouptype;
		$sportitemBaseList = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemWithSportitemBaseList($cp,$btbTrainingplanOutlineDetailSportitemPRM);
//		$data = array();
//		foreach ($sportitemBaseList as $sbList)
//		{
//			
//			//array_push($sbList,$trainingplanSportitemgroupDetailByIdList['count'],$trainingplanSportitemgroupDetailByIdList['groupcount'],$trainingplanSportitemgroupDetailByIdList['grouptype']);
//			$sbList['count'] = $trainingplanSportitemgroupDetailByIdList['count'];
//			$sbList['groupcount'] = $trainingplanSportitemgroupDetailByIdList['groupcount'];
//			$sbList['grouptype'] = $trainingplanSportitemgroupDetailByIdList['grouptype'];
//			$sbList['sid'] = $trainingplanSportitemgroupDetailByIdList['sbid'];
//			$data[] = $sbList;
//			//dump($sbList);
//		}
 		$count = count($sportitemBaseList);
		$sportitemBaseList[$count]['count'] = $trainingplanSportitemgroupDetailByIdList['count'];
		$sportitemBaseList[$count]['groupcount'] = $trainingplanSportitemgroupDetailByIdList['groupcount'];
		$sportitemBaseList[$count]['grouptype'] = $trainingplanSportitemgroupDetailByIdList['grouptype'];
		$sportitemBaseList[$count]['sbid'] = $trainingplanSportitemgroupDetailByIdList['sbid'];
		//dump($sportitemBaseList);
		//dump(count($sportitemBaseList));
		//dump($data);
		if(count($sportitemBaseList)>0)
		{
			$this->ajaxReturn($sportitemBaseList);
		}
    }
    
}