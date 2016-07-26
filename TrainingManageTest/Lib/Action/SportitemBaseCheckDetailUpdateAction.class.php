<?php
class SportitemBaseCheckDetailUpdateAction extends BaseAction
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
		//$targetbodypart = str_replace(',','/',$sportitemBaseList['targetbodypart']);
		//获取登录者的信息
		$user = $this->getLoginInfo();
		$this->assign('sportitemBaseList',$sportitemBaseList);
		//menu动作库
		$this->assign('headtype',2);
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
		//动作审核后台审核通过,推荐页面
    	//$this->assign('addtype',4);
    	//$this->assign('targetbodypart',$targetbodypart);		
		//$this->display('SportitemBaseCheckDetailUpdate/index');
		$this->display('SportitemBaseCheck/sportitemBaseCheckDetailUpdate');
	}
	
	//保存
	public function sportitemBaseUpdate()
	{		       				       			
		//接收传过来的一些参数
		$sportitem_base_id = isset($_POST['sportitem_base_id'])?trim($_POST['sportitem_base_id']):null;
		$level = isset($_POST['level'])?trim($_POST['level']):null;
		$type = isset($_POST['type'])?trim($_POST['type']):null;
		$useequipment = isset($_POST['useequipment'])?trim($_POST['useequipment']):null;
		$targetbodypart = isset($_POST['targetbodypart'])?trim($_POST['targetbodypart']):null;
		$target = isset($_POST['target'])?trim($_POST['target']):null;
		$intro = isset($_POST['intro'])?trim($_POST['intro']):null;
		$content1 = isset($_POST['content1'])?trim($_POST['content1']):null;
		$content2 = isset($_POST['content2'])?trim($_POST['content2']):null;
		$content3 = isset($_POST['content3'])?trim($_POST['content3']):null;
		$content4 = isset($_POST['content4'])?trim($_POST['content4']):null;
		$jsondata = array();
		$dataSportitemBase = array();
		$dataSportitemBase['id'] = $sportitem_base_id;
		$dataSportitemBase['level'] = $level;
		$dataSportitemBase['type'] = $type;
		$dataSportitemBase['useequipment'] = $useequipment;
		$dataSportitemBase['targetbodypart'] = $targetbodypart;
		$dataSportitemBase['target'] = $target;
		$dataSportitemBase['intro'] = $intro;
		$dataSportitemBase['content1'] = $content1;
		$dataSportitemBase['content2'] = $content2;
		$dataSportitemBase['content3'] = $content3;
		$dataSportitemBase['content4'] = $content4;	
		$rowsSportitemBase = BtbSportitemBaseBLL::btbSportitemBaseUpdate($dataSportitemBase);
		if($rowsSportitemBase > 0)
		{
			//修改动作表成功
			//$flag = 1;
			$jsondata['code'] = 1;
			$jsondata['msg'] = '保存动作成功';
		}
		else
		{
			//修改动作表失败
			//$flag =0;
			$jsondata['code'] = -1;
			$jsondata['msg'] = '保存动作失败';
		}
		//$this->ajaxReturn($flag);
		$this->ajaxReturn($jsondata);
	}
}