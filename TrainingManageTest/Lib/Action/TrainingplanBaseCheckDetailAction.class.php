<?php
class TrainingplanBaseCheckDetailAction extends BaseAction
{
	//课程设计完善审核首页
	public function index()
	{
		$trainingplan_base_id = isset($_GET['id'])?trim($_GET['id']):null;
		$cp = new CommonPRM();
		$btbTrainingplanBasePRM = new BtbTrainingplanBasePRM();
		$btbTrainingplanBasePRM->id = $trainingplan_base_id;
		$trainingplanBaseList = BtbTrainingplanBaseBLL::getTrainingplanBaseList($cp,$btbTrainingplanBasePRM);
		$trainingplanBaseList = $trainingplanBaseList[0];
		$btbTrainingplanConfigPRM = new BtbTrainingplanConfigPRM();
		$btbTrainingplanConfigPRM->trainingplan_base_id = $trainingplan_base_id;
		$trainingplanConfigList = BtbTrainingplanConfigBLL::getTrainingplanConfigList($cp,$btbTrainingplanConfigPRM);
		if(count($trainingplanConfigList) > 0)
		{
			$trainingplanConfigList = $trainingplanConfigList[0];
		}
		$btbCoachPRM = new BtbCoachPRM();
		$btbCoachPRM->id = $trainingplanBaseList['coach_id'];
		$coachList = BtbCoachBLL::getCoachList($cp,$btbCoachPRM);
		if(count($coachList) > 0)
		{
			$coachList = $coachList[0];			
		}
		//目标部位targetbodypart
		$targetbodypart = str_replace(',','/',$trainingplanBaseList['targetbodypart']);
		//获取登录者的信息
		$user = $this->getLoginInfo();
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
		//$this->assign('coach_name',$user['name']);
		$this->assign('coach_name',$coachList['name']);
		$this->assign("trainingplanBaseList",$trainingplanBaseList);
		$this->assign("trainingplanConfigList",$trainingplanConfigList);
		$this->assign('targetbodypart',$targetbodypart);
		//课程设计审核后台审核通过,退件页面
		$this->assign('addtype',5);
		//menu课程设计
		$this->assign('headtype',3);
		//$this->display("TrainingplanBaseCheckDetail/index");
		$this->display("TrainingplanBaseCheck/trainingplanBaseCheckDetail");
	}
	
	//跳转到编辑页面
	public function update()
	{
		$trainingplan_base_id = isset($_GET['id'])?trim($_GET['id']):null;
    	$this->redirect('TrainingplanBaseCheckDetailUpdate/index',array('id'=>$trainingplan_base_id));
	}
	
	//课程设计审核批注
	public function trainingplanBaseComment()
	{
		//接收传过来的数据
		//trainingplan_base_id
		$trainingplan_base_id = isset($_POST['trainingplan_base_id']) ? trim($_POST['trainingplan_base_id']):null;
		//auditreply
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
				//$flag = 1;				
				$jsondata['code'] = 1;
				$jsondata['msg'] = '保存批注成功';
			}
			else
			{
				//$flag = 0;
				$jsondata['code'] = -1;
				$jsondata['msg'] = '保存批注失败';
			}
		}
		//$this->ajaxReturn($flag);
		$this->ajaxReturn($jsondata);	
	}
	
	//课程设计审核通过
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
	
	//课程设计审核退件
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
	
}