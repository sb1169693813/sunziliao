<?php
class ActionReferenceAction extends  BaseAction
{	
	public function index()
	{
		$name = isset($_GET['name'])?trim($_GET['name']):null;
		$level = isset($_GET['level'])?trim($_GET['level']):null;
		$type = isset($_GET['type'])?trim($_GET['type']):null;
		$targetbodypart = isset($_GET['targetbodypart'])?trim($_GET['targetbodypart']):null;
		$useequipment = isset($_GET['useequipment'])?trim($_GET['useequipment']):null;
		$cp = new CommonPRM();
		$btbSportitemBasePRM = new BtbSportitemBasePRM();
		if(!is_null($name))
		{
			$btbSportitemBasePRM->name = '%'.urldecode($name).'%';
		}
		if(!is_null($level))
		{
			$btbSportitemBasePRM->level = urldecode($level);
		}
		if(!is_null($type))
		{
			$btbSportitemBasePRM->type = urldecode($type);
		}
		if(!is_null($targetbodypart))
		{
			$btbSportitemBasePRM->targetbodypart = '%'.urldecode($targetbodypart).'%';
		}
		if(!is_null($useequipment))
		{
			$btbSportitemBasePRM->useequipment = '%'.urldecode($useequipment).'%';
		}
		//审核通过
		//$btbSportitemBasePRM->auditstatus = 2;
		$sportitemBaseList = BtbSportitemBaseBLL::getSportitemBaseLikeList($cp,$btbSportitemBasePRM);
		//$sportitemBaseList = BtbSportitemBaseBLL::getSportitemBaseList($cp,$btbSportitemBasePRM);
		//		dump($sportitemBaseList);
//		exit;
		//获取登录者的信息
		$user = $this->getLoginInfo();
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
		$this->assign('sportitemBaseList',$sportitemBaseList);
		$this->assign('name',urldecode($name));
		$this->assign('level',urldecode($level));
		$this->assign('type',urldecode($type));
		$this->assign('targetbodypart',urldecode($targetbodypart));
		$this->assign('useequipment',urldecode($useequipment));		
		$this->display("ActionReference/index");
	}
}