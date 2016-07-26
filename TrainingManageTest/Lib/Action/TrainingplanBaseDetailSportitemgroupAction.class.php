<?php
class TrainingplanBaseDetailSportitemgroupAction extends BaseAction
{
	//课程动作列表
	public function index()
	{
		$cp = new CommonPRM();
		//$trainingplan_base_id = isset($_GET['trainingplan_base_id']) ? trim($_GET['trainingplan_base_id']):null;
		$trainingplan_base_id = SessionData::getPageData('TrainingplanBaseDetailSportitemgroup', 'trainingplan_base_id');
		//查看还是编辑
		$actiontype = SessionData::getPageData('TrainingplanBaseDetailSportitemgroup', 'actiontype');		
		//查询trainingplanBaseList
		$btbTrainingplanBasePRM = new BtbTrainingplanBasePRM();
		$btbTrainingplanBasePRM->id = $trainingplan_base_id;
		$trainingplanBaseList = BtbTrainingplanBaseBLL::getTrainingplanBaseList($cp,$btbTrainingplanBasePRM);
		$trainingplanBase = $trainingplanBaseList[0];
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
    	$this->assign('sList1',$sList1);
    	$this->assign('sList2',$sList2);
    	$this->assign('sList3',$sList3);
    	//课程动作列表添加,修改加载此页面	
		$this->assign('addtype',2);
		$this->assign('actiontype',$actiontype);
		$this->assign('trainingplanBase',$trainingplanBase);
		//menu课程设计
		$this->assign('headtype',3);	
		//$this->display("TrainingplanBaseDetailSportitemgroup/index");
		$this->display("TrainingplanBase/trainingplanBaseDetailSportitemgroup");
	}
	
	//弹出的添加动作页面
	public function sportitemgAddIndex()
	{	
		$cp = new CommonPRM();
		//根据动作组表展示大纲动作列表
		//查询动作（根据已审核的单天大纲内容，提供可选择动作）
		$outline_id = isset($_POST['outline_id']) ? trim($_POST['outline_id']):null;
		//outline_detail_id
		$outline_detail_id = isset($_POST['outline_detail_id']) ? trim($_POST['outline_detail_id']):null;
		//sportitemgrouptype
		$sportitemgrouptype = isset($_POST['sportitemgrouptype']) ? trim($_POST['sportitemgrouptype']):null;
		$btbTrainingplanOutlineDetailSportitemPRM = new BtbTrainingplanOutlineDetailSportitemPRM();
		$btbTrainingplanOutlineDetailSportitemPRM->outline_id = $outline_id;
		$btbTrainingplanOutlineDetailSportitemPRM->outline_detail_id = $outline_detail_id;
		$btbTrainingplanOutlineDetailSportitemPRM->sportitemgrouptype = $sportitemgrouptype;
		$sportitemBaseList = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemWithSportitemBaseList($cp,$btbTrainingplanOutlineDetailSportitemPRM);
		if(count($sportitemBaseList)>0)
		{
			$this->ajaxReturn($sportitemBaseList);
		}
	}
	
	//动作添加
	public function sportitemgAdd()
	{
		//trainingplan_base_id
    	$trainingplan_base_id = isset($_POST['trainingplan_base_id']) ? trim($_POST['trainingplan_base_id']): null;
    	//sportitem_base_id
    	$sportitem_base_id = isset($_POST['sportitem_base_id']) ? trim($_POST['sportitem_base_id']): null;
    	//count
    	$count = isset($_POST['acount']) ? trim($_POST['acount']): null;
    	//groupcount
    	$groupcount = isset($_POST['agroupcount']) ? trim($_POST['agroupcount']): null;
    	//agrouptype
    	$grouptype = isset($_POST['agrouptype']) ? trim($_POST['agrouptype']): null;
    	//$sportitem_base_idArray = explode(',', $sportitem_base_id);
    	//addsort
    	$sort = isset($_POST['addsort']) ? trim($_POST['addsort']): null;
    	$jsondata = array();
    	//判断动作是否添加过
    	$cp = new CommonPRM();
    	$btbTrainingplanSportitemgroupDetailPRM = new BtbTrainingplanSportitemgroupDetailPRM();
    	$btbTrainingplanSportitemgroupDetailPRM->trainingplan_base_id = $trainingplan_base_id;
    	$btbTrainingplanSportitemgroupDetailPRM->sportitem_base_id = $sportitem_base_id;
    	$btbTrainingplanSportitemgroupDetailPRM->sort = $sort;
    	$list = BtbTrainingplanSportitemgroupDetailBLL::getTrainingplanSportitemgroupDetailList($cp,$btbTrainingplanSportitemgroupDetailPRM);  	
    	if(count($list) > 0)
    	{
    		//动作已经添加过
    		//$flag = -1;
    		$jsondata['code'] = -1;
    		$jsondata['msg'] = '动作已经添加过,不能重复添加';
    	}
    	else
    	{
    		$sportitemData = array();
    		$sportitemData['trainingplan_base_id'] = $trainingplan_base_id;
    		$sportitemData['sportitem_base_id'] = $sportitem_base_id;
    		$sportitemData['count'] = $count;
    		$sportitemData['groupcount'] = $groupcount;
    		$sportitemData['grouptype'] = $grouptype;
    		$sportitemData['sort'] = $sort;
    		$rows = BtbTrainingplanSportitemgroupDetailBLL::btbTrainingplanSportitemgroupDetailInsert($sportitemData);
    		if($rows > 0)
    		{
    			//动作组添加成功
    			//$flag = 1;
    			$jsondata['code'] = 1;
    			$jsondata['msg'] = '动作组添加成功';
    		}
    		else
    		{
    			//动作组添加失败
    			//$flag = 0;
    			$jsondata['code'] = -2;
    			$jsondata['msg'] = '动作组添加失败';
    		}
    	}
    	//$this->ajaxReturn($flag);
    	$this->ajaxReturn($jsondata);
	}
	
	//动作列表编辑动作页面
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
    
    //编辑执行
    public function sportitemgUpdate()
    {
    	$btb_trainingplan_sportitemgroup_detail_id = isset($_POST['btb_trainingplan_sportitemgroup_detail_id']) ? trim($_POST['btb_trainingplan_sportitemgroup_detail_id']):null;
    	//trainingplan_base_id
    	$trainingplan_base_id = isset($_POST['trainingplan_base_id']) ? trim($_POST['trainingplan_base_id']): null;
    	//sportitem_base_id
    	$sportitem_base_id = isset($_POST['sportitem_base_id']) ? trim($_POST['sportitem_base_id']): null;
    	//count
    	$count = isset($_POST['ucount']) ? trim($_POST['ucount']): null;
    	//groupcount
    	$groupcount = isset($_POST['ugroupcount']) ? trim($_POST['ugroupcount']): null;
    	//grouptype
    	$grouptype = isset($_POST['ugrouptype']) ? trim($_POST['ugrouptype']): null;
    	//usort
    	$sort = isset($_POST['usort']) ? trim($_POST['usort']): null;
    	$jsondata = array();
    	//判断动作是否添加过
    	$cp = new CommonPRM();
    	//$btbTrainingplanSportitemgroupDetailPRM = new BtbTrainingplanSportitemgroupDetailPRM();
    //	$btbTrainingplanSportitemgroupDetailPRM->trainingplan_base_id = $trainingplan_base_id;
    //	$btbTrainingplanSportitemgroupDetailPRM->sportitem_base_id = $sportitem_base_id;
    	//usort
    //	$btbTrainingplanSportitemgroupDetailPRM->sort = $sort;
    //	$list = BtbTrainingplanSportitemgroupDetailBLL::getTrainingplanSportitemgroupDetailList($cp,$btbTrainingplanSportitemgroupDetailPRM);
    	
//    	if(count($list) > 0)
//    	{
//    		//动作已经添加过
//    		$flag = -1;
//    	}
    //	else
    //	{
    		$sportitemData = array();
    		$sportitemData['id'] = $btb_trainingplan_sportitemgroup_detail_id;
    		$sportitemData['trainingplan_base_id'] = $trainingplan_base_id;
    		$sportitemData['sportitem_base_id'] = $sportitem_base_id;
    		$sportitemData['count'] = $count;
    		$sportitemData['groupcount'] = $groupcount;
    		$sportitemData['grouptype'] = $grouptype;
    		$sportitemData['sort'] = $sort;
    		$rows = BtbTrainingplanSportitemgroupDetailBLL::btbTrainingplanSportitemgroupDetailUpdate($sportitemData);
    		if($rows > 0)
    		{
    			//动作修改成功
    			//$flag = 1;
    			$jsondata['code'] = 1;
				$jsondata['msg'] = '动作修改成功';
    		}
    		else
    		{
    			//动作修改失败
    			//$flag = 0;
    			$jsondata['code'] = -1;
				$jsondata['msg'] = '动作修改失败';
    		}
    //	}
    	$this->ajaxReturn($jsondata);
    }
    
    //删除动作
    public function sportitemgDel()
    {
    	$id = isset($_POST['id']) ? trim($_POST['id']):null;
    	$jsondata = array();
    	$data = array();
    	$data['id'] = $id;
    	$data['obj_status'] = 0;
    	$rows = BtbTrainingplanSportitemgroupDetailBLL::btbTrainingplanSportitemgroupDetailUpdate($data);
    	if($rows > 0)
    	{
    		//$flag = 1;
    		$jsondata['code'] = 1;
			$jsondata['msg'] = '删除成功';
    	}
    	else
    	{
    		//$flag = 0;
    		$jsondata['code'] = -1;
			$jsondata['msg'] = '删除失败';
    	}
    	$this->ajaxReturn($jsondata);
    }
    
    //提交审核按钮
   public function commit()
   {
   		//trainingplan_base_id
   		$trainingplan_base_id = isset($_POST['trainingplan_base_id']) ? trim($_POST['trainingplan_base_id']):null;
   		$jsondata = array(); 	 		
   		$data = array();
   		$data['id'] = $trainingplan_base_id;
   		//状态改为审核中
   		$data['status'] = 1;
   		$rows = BtbTrainingplanBaseBLL::btbTrainingplanBaseUpdate($data);
   		if($rows > 0)
   		{
   			//审核成功
   			//$flag = 1;
   			$jsondata['code'] = 1;
   			//插入日志
   			$dataLog = array();
   			$dataLog['trainingplan_base_id'] = $trainingplan_base_id;
   			//提交
   			$dataLog['status'] = 1;
   			$row = BtbTrainingplanLogBLL::btbTrainingplanLogInsert($dataLog);
   			if($row > 0)
   			{
   				//插入成功
   				//$flag = 1;
   				$jsondata['code'] = 1;
   			}
   			else
   			{
   				//插入失败
   				//$flag = 0;
   				$jsondata['code'] = -2;
				$jsondata['msg'] = '插入方案表日志失败';
   			}
   		}
   		else 
   		{
   			//审核失败
   			//$flag = 0;
   			$jsondata['code'] = -1;
			$jsondata['msg'] = '更新课程设计审核状态失败';
   		}
   		
   		$this->ajaxReturn($jsondata);
   }
}