<?php
class SportitemBaseCheckDetailAction extends BaseAction
{
	//动作库审核详情页面首页
	public function index()
	{
		//接收sportitem_base_id
		$sportitem_base_id = isset($_GET['id'])?trim($_GET['id']):null;
		$cp = new CommonPRM();
		$btbSportitemBasePRM = new BtbSportitemBasePRM();
		$btbSportitemBasePRM->id = $sportitem_base_id;
		$sportitemBaseList = BtbSportitemBaseBLL::getSportitemBaseList($cp,$btbSportitemBasePRM);
		$sportitemBaseList = $sportitemBaseList[0];
		//目标部位targetbodypart
		$targetbodypart = str_replace(',','/',$sportitemBaseList['targetbodypart']);
		//获取登录者的信息
		$user = $this->getLoginInfo();
		$this->assign('sportitemBaseList',$sportitemBaseList);
		//menu动作库
		$this->assign('headtype',2);
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
		//动作审核后台审核通过,推荐页面
    	$this->assign('addtype',4);
    	$this->assign('targetbodypart',$targetbodypart);		
		//$this->display('SportitemBaseCheckDetail/index');
		$this->display('SportitemBaseCheck/sportitemBaseCheckDetail');
	}
	
	//编辑
	public function update()
	{
		$sportitem_base_id = isset($_GET['id'])?trim($_GET['id']):null;
    	$this->redirect('SportitemBaseCheckDetailUpdate/index',array('id'=>$sportitem_base_id));
	}
	//sportitemBaseComment批注
	public function sportitemBaseComment()
	{
		//接收传过来的数据
		//sportitem_base_id
		$sportitem_base_id = isset($_POST['sportitem_base_id']) ? trim($_POST['sportitem_base_id']):null;
		//auditreply
		$auditreply = isset($_POST['auditreply']) ? trim($_POST['auditreply']):null;
		$jsondata = array();
		$cp = new CommonPRM();
    	$btbSportitemBasePRM = new BtbSportitemBasePRM();
    	$btbSportitemBasePRM->id = $sportitem_base_id;
    	//大纲List
		$sportitemBaseList = BtbSportitemBaseBLL::getSportitemBaseList($cp,$btbSportitemBasePRM);
		if(count($sportitemBaseList) > 0)
		{
			$dataSportitemBase = array();
			$dataSportitemBase['id'] = $sportitem_base_id;
			$dataSportitemBase['auditreply'] = $auditreply;
			$rowsSportitemBase = BtbSportitemBaseBLL::btbSportitemBaseUpdate($dataSportitemBase);
			if($rowsSportitemBase > 0)
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
	
	//sportitemBasePass通过
	public function sportitemBasepass()
	{
		//接收传过来的数据
		//sportitem_base_id
		$sportitem_base_id = isset($_POST['sportitem_base_id']) ? trim($_POST['sportitem_base_id']):null;
		$dataSportitemBase = array();
		$jsondata = array();
		$dataSportitemBase['id'] = $sportitem_base_id;
		//auditstatus 2 已审核
		$dataSportitemBase['auditstatus'] = 2;
		$dataSportitemBase['auditdate'] = date('Y-m-d H:i:s',time());
		$rowsSportitemBase = BtbSportitemBaseBLL::btbSportitemBaseUpdate($dataSportitemBase);
		if($rowsSportitemBase > 0)
		{
			//$flag = 1;
			$jsondata['code'] = 1;
			$jsondata['msg'] = '动作审核通过';
		}
		else
		{
			//$flag = 0;
			$jsondata['code'] = -1;
			$jsondata['msg'] = '动作审核失败';
		}
		//$this->ajaxReturn($flag);
		$this->ajaxReturn($jsondata);
	}
	
	//sportitemBaseBounce退件
	public function sportitemBaseBounce()
	{
		//接收传过来的数据
		//sportitem_base_id
		$sportitem_base_id = isset($_POST['sportitem_base_id']) ? trim($_POST['sportitem_base_id']):null;
		$dataSportitemBase = array();
		$jsondata = array();
		$dataSportitemBase['id'] = $sportitem_base_id;
		//auditstatus -1 未通过
		$dataSportitemBase['auditstatus'] = -1;
		$dataSportitemBase['auditdate'] = date('Y-m-d H:i:s',time());
		$rowsSportitemBase = BtbSportitemBaseBLL::btbSportitemBaseUpdate($dataSportitemBase);
		if($rowsSportitemBase > 0)
		{
			//$flag = 1;
			$jsondata['code'] = 1;
			$jsondata['msg'] = '退件成功';
		}
		else
		{
			//$flag = 0;
			$jsondata['code'] = -1;
			$jsondata['msg'] = '退件失败';
		}
		//$this->ajaxReturn($flag);
		$this->ajaxReturn($jsondata);
	}
	
}