<?php
class SportitemBaseDetailAction extends BaseAction
{
	//编辑页面首页
	public function index()
	{
		//接收sportitem_base_id
		$sportitem_base_id = SessionData::getPageData('SportitemBaseDetail', 'sportitem_base_id');
		//查看1,编辑2
		$actiontype = SessionData::getPageData('SportitemBaseDetail', 'actiontype');
		$cp = new CommonPRM();
		$btbSportitemBasePRM = new BtbSportitemBasePRM();
		$btbSportitemBasePRM->id = $sportitem_base_id;
		$sportitemBaseList = BtbSportitemBaseBLL::getSportitemBaseList($cp,$btbSportitemBasePRM);
		$sportitemBaseList = $sportitemBaseList[0];
		//获取登录者的信息
		$user = $this->getLoginInfo();
		//要点数组
		//$content = explode(',', $sportitemBaseList['content']);
		$this->assign('actiontype',$actiontype);
		//$this->assign('content',$content);
		$this->assign('sportitemBaseList',$sportitemBaseList);
		//menu动作库
		$this->assign('headtype',2);
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);		
		//$this->display('SportitemBaseDetail/index');
		$this->display('SportitemBase/sportitemBaseDetail');
	}
		
	//提交审核
	public function sportitemBaseCommit()
	{   
		$sportitem_base_id = isset($_POST['sportitem_base_id']) ? trim($_POST['sportitem_base_id']):null;
		//$name = isset($_POST['name']) ? trim($_POST['name']):null;
		$level = isset($_POST['level']) ? trim($_POST['level']):null;
		$type = isset($_POST['type']) ? trim($_POST['type']):null;
		$useequipment = isset($_POST['useequipment']) ? trim($_POST['useequipment']):null;
		$targetbodypart = isset($_POST['targetbodypart']) ? trim($_POST['targetbodypart']):null;
		$target = isset($_POST['target']) ? trim($_POST['target']):null;
		$intro = isset($_POST['intro']) ? trim($_POST['intro']):null;
		$content1 = isset($_POST['content1'])?trim($_POST['content1']):null;
		$content2 = isset($_POST['content2'])?trim($_POST['content2']):null;
		$content3 = isset($_POST['content3'])?trim($_POST['content3']):null;
		$content4 = isset($_POST['content4'])?trim($_POST['content4']):null;
		$data = array();
		$jsondata = array();
		$data['id'] = $sportitem_base_id;
		//$data['name'] = $name;
		$data['level'] = $level;
		$data['type'] = $type;
		$data['useequipment'] = $useequipment;
		$data['targetbodypart'] = $targetbodypart;
		$data['target'] = $target;
		$data['intro'] = $intro;
		$data['content1'] = $content1;
		$data['content2'] = $content2;
		$data['content3'] = $content3;
		$data['content4'] = $content4;
		//审核中
		$data['auditstatus'] = 1;
		//$data['name'] = $name;
		$rows = BtbSportitemBaseBLL::btbSportitemBaseUpdate($data);
		if($rows > 0)
		{
			//$flag = 1;
			$jsondata['msg'] = '提交成功';
			$jsondata['code'] = 1;
		}
		else
		{
			//$flag = 0;
			$jsondata['msg'] = '提交失败';
			$jsondata['code'] = -1;
		}
		$this->ajaxReturn($jsondata);
		//$this->ajaxReturn($data);
	}
}