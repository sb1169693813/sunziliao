<?php
//OutlineDetailAction
class OutlineDetailAction extends BaseAction 
{
	//大纲基本属性编辑页面
	public function index()
	{		
		//查看1编辑2还是新建3
		//$actiontype = SessionData::getPageData('OutlineDetail', 'actiontype');
		$actiontype = isset($_GET['actiontype'])?trim($_GET['actiontype']):3;
		if($actiontype !=3)
		{
			//outline_id
			//$outline_id = SessionData::getPageData('OutlineDetail', 'outline_id');
			//SessionData::setPageData('OutlineDetailsportitemgroup', 'outline_id',$outline_id);
			$outline_id = isset($_GET['outline_id'])?trim($_GET['outline_id']):null;
			$cp = new CommonPRM();
    		$btbTrainingplanOutlinePRM = new BtbTrainingplanOutlinePRM();
    		$btbTrainingplanOutlinePRM->id = $outline_id;
    		//大纲List
			$trainingplanOutlineList = BtbTrainingplanOutlineBLL::getTrainingplanOutlineList($cp,$btbTrainingplanOutlinePRM);
    		$this->assign('trainingplanOutlineList',$trainingplanOutlineList[0]);
    		$this->assign('outline_id',$outline_id);
		}
		//SessionData::setPageData('OutlineDetailsportitemgroup', 'actiontype',$actiontype);
    	//获取登录者的信息
		$user = $this->getLoginInfo();
		$this->assign('actiontype',$actiontype);	
		//menu课程大纲
    	$this->assign('headtype',1);
    	//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
    	//$this->display("OutlineDetail/index");
    	$this->display("Outline/outlineDetail");
	}
	
	//下一步编辑
	public function outlineUpdate()
	{
		//教练id coach_id
//    	$ses = SessionData::getAttribute('loginUserInfo');
//    	if(isset($ses))
//    	{
//    		$coach_id = $ses['id'];
//   		}
		$coach_id = $this->getLoginUserID();
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
	    $outlinedata = array();
	    $outlinedata['id'] = $outline_id;
	    $outlinedata['name'] = $name;
	    $outlinedata['bodypart'] = $bodypart;
	    $outlinedata['daycount'] = $daycount;
	    $outlinedata['type'] = $type;
	    $outlinedata['level'] = $level;
	    $outlinedata['coach_id'] = $coach_id;
	    $outlinedata['useequipment'] = $useequipment;
	    //0 未审核 1 已审核 2 审核失败
	    //$outlinedata['auditstatus'] = 0;
	    $rows = BtbTrainingplanOutlineBLL::btbTrainingplanOutlineUpdate($outlinedata);
	    $jsondata = array();
	    if($rows > 0)
		{
			//修改大纲成功
			//$flag = 1;
			$jsondata['code'] = 1;
		}
		else
		{
			//'修改大纲失败'
			//$flag = 0;
			$jsondata['msg'] = '编辑大纲失败';
			$jsondata['code'] = -1;
		} 
		$this->ajaxReturn($jsondata);	   	  	   		    	
    	//$this->ajaxReturn($flag);
	}
		
	//下一步添加
	public function outlineAdd()
	{
		//教练id coach_id
//    	$ses = SessionData::getAttribute('loginUserInfo');
//    	if(isset($ses))
//    	{
//    		$coach_id = $ses['id'];
//   	}
		$coach_id = $this->getLoginUserID();
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
    	//检查大纲是否存在
    	$cp = new CommonPRM();
    	$btbTrainingplanOutlinePRM = new BtbTrainingplanOutlinePRM();
    	$btbTrainingplanOutlinePRM->name = $name;
    	$trainingplanOutlineList = BtbTrainingplanOutlineBLL::getTrainingplanOutlineList($cp,$btbTrainingplanOutlinePRM);
    	$jsondata = array();
    	if(count($trainingplanOutlineList) > 0)
    	{
    		//大纲以存在
    		//$flag = -1;
    		$jsondata['msg'] = "大纲以存在";	
			$jsondata['code'] = -1;
    	}
    	else
    	{
    		//$flag = '大纲不存在';
	    	$outlinedata = array();
	    	$outlinedata['name'] = $name;
	    	$outlinedata['bodypart'] = $bodypart;
	    	$outlinedata['daycount'] = $daycount;
	    	$outlinedata['type'] = $type;
	    	$outlinedata['level'] = $level;
	    	$outlinedata['coach_id'] = $coach_id;
	    	$outlinedata['useequipment'] = $useequipment;
	    	//0 未审核 1 已审核 2 审核失败
	    	$outlinedata['auditstatus'] = 0;
	    	$rows = BtbTrainingplanOutlineBLL::btbTrainingplanOutlineInsert($outlinedata);
	    	if($rows > 0)
			{
				SessionData::setPageData('OutlineDetailsportitemgroup', 'outline_id',$rows);
				for($i=0;$i<$daycount;$i++)
				{
					$detaildata = array();
					$detaildata['outline_id'] = $rows;
					$detaildata['day'] = $i+1;
					//sort排序
					$detaildata['sort'] = $i+1;
					$detailrows = BtbTrainingplanOutlineDetailBLL::btbTrainingplanOutlineDetailInsert($detaildata);
					if($detailrows > 0)
					{
						//$flag = $rows;
						$jsondata['code'] = $detailrows;
					}
					else 
					{
						//'新建大纲详情失败'
						//$flag = -2;
						$jsondata['msg'] = "新建大纲详情失败";		
						$jsondata['code'] = -2;
					}
				}
			}
			else 
			{
				//'新建大纲失败'
				//$flag = '新建大纲失败';
				//$flag = -3;
				$jsondata['msg'] = "新建大纲失败";		
				$jsondata['code'] = -3;
			}
    	}
    	//$this->ajaxReturn($flag);
		$this->ajaxReturn($jsondata);
	}
}