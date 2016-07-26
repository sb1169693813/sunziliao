<?php
class OutlineCheckDetailUpdateAction extends BaseAction 
{
	//大纲基本属性编辑页面
	public function index()
	{			
		//outline_id
    	$outline_id = isset($_GET['id']) ? trim($_GET['id']):null;
		$cp = new CommonPRM();
    	$btbTrainingplanOutlinePRM = new BtbTrainingplanOutlinePRM();
    	$btbTrainingplanOutlinePRM->id = $outline_id;
    	//大纲List
		$trainingplanOutlineList = BtbTrainingplanOutlineBLL::getTrainingplanOutlineList($cp,$btbTrainingplanOutlinePRM);
    	$this->assign('trainingplanOutlineList',$trainingplanOutlineList[0]);	
    	//获取登录者的信息
		$user = $this->getLoginInfo();
		//menu课程大纲
    	$this->assign('headtype',1);
    	//课程审核后台审核通过,推荐页面
    	$this->assign('addtype',3);
    	//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
    	//$this->display("OutlineCheckDetailUpdate/index");
    	$this->display("OutlineCheck/outlineCheckDetailUpdate");
	}
	
	//保存
	public function outlineUpdate()
	{
    	//专题名称name
    	$name = isset($_POST['name'])? trim($_POST['name']):null;
    	//课程类型type
    	$type = isset($_POST['type'])?trim($_POST['type']):null;
    	//难易程度level
    	$level = isset($_POST['level'])? trim($_POST['level']):null;
    	//课程重点bodypart
    	$bodypart = isset($_POST['bodypart'])? trim($_POST['bodypart']):null;
    	//课程数量daycount
    	$daycount = isset($_POST['daycount'])? trim($_POST['daycount']):null;
    	//使用器械
    	$useequipment = isset($_POST['useequipment'])? trim($_POST['useequipment']):null; 
    	//outline_id
    	$outline_id = isset($_POST['outline_id'])?trim($_POST['outline_id']):null;
    	//$flag = '大纲不存在';
    	$jsondata = array();
	    $outlinedata = array();
	    $outlinedata['id'] = $outline_id;
	    $outlinedata['name'] = $name;
	    $outlinedata['bodypart'] = $bodypart;
	    $outlinedata['daycount'] = $daycount;
	    $outlinedata['type'] = $type;
	    $outlinedata['level'] = $level;
	    $outlinedata['useequipment'] = $useequipment;
	    //0 未审核 1 已审核 2 审核失败
	    //$outlinedata['auditstatus'] = 0;
	    $rows = BtbTrainingplanOutlineBLL::btbTrainingplanOutlineUpdate($outlinedata);
	    if($rows > 0)
		{
			//修改大纲成功
			//$flag = 1;
			$jsondata['code'] = 1;
			$jsondata['msg'] = '编辑大纲成功';
		}
		else
		{
			//'修改大纲失败'
			//$flag = 0;
			$jsondata['code'] = -1;
			$jsondata['msg'] = '编辑大纲失败';
		} 	   	  	   		    	
    	//$this->ajaxReturn($flag);
    	$this->ajaxReturn($jsondata);
	}
}