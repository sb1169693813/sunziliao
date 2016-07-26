<?php
class OutlineDetailsportitemgroupAction extends  BaseAction
{
	//大纲动作列表修改首页
	public function index()
	{
		$actiontype = SessionData::getPageData('OutlineDetailsportitemgroup', 'actiontype');
		$cp = new CommonPRM();
		//第几天
		//SessionData::setPageData('OutlineDetailsportitemgroup', 'day');
		$day = isset($_GET['day']) ?trim($_GET['day']):1;
		
		//$daycount = isset($_GET['daycount']) ?trim($_GET['daycount']):null;
    	//$outline_id = isset($_GET['outline_id'])? trim($_GET['outline_id']):null;
    	//$outline_detail_id = isset($_GET['outline_detail_id']) ? trim($_GET['outline_detail_id']):null;
    	//查大纲表
		$outline_id = SessionData::getPageData('OutlineDetailsportitemgroup', 'outline_id');
//		echo $outline_id;
//		exit;
    	$btbTrainingplanOutlinePRM = new BtbTrainingplanOutlinePRM();
    	$btbTrainingplanOutlinePRM->id = $outline_id;
    	$trainingplanOutlineList = BtbTrainingplanOutlineBLL::getTrainingplanOutlineList($cp,$btbTrainingplanOutlinePRM);
    	if(count($trainingplanOutlineList) > 0)
    	{
    		$trainingplanOutlineList = $trainingplanOutlineList[0];
    	}    	    	
    	//查大纲详情表
    	$btbTrainingplanOutlineDetailPRM = new BtbTrainingplanOutlineDetailPRM();
    	$btbTrainingplanOutlineDetailPRM->outline_id = $outline_id;
    	$btbTrainingplanOutlineDetailPRM->day = $day;
    	$trainingplanOutlineDetailList = BtbTrainingplanOutlineDetailBLL::getTrainingplanOutlineDetailList($cp,$btbTrainingplanOutlineDetailPRM);
    	if(count($trainingplanOutlineDetailList) > 0)
    	{
    		$outline_detail_id = $trainingplanOutlineDetailList[0]['id'];
	    	//查详情动作表
			$btbTrainingplanOutlineDetailSportitemPRM = new BtbTrainingplanOutlineDetailSportitemPRM();
	    	$btbTrainingplanOutlineDetailSportitemPRM->outline_id = $outline_id;
	    	$btbTrainingplanOutlineDetailSportitemPRM->outline_detail_id = $outline_detail_id;
	    	$trainingplanOutlineDetailSportitemList = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemList($cp,$btbTrainingplanOutlineDetailSportitemPRM);
	    	if(count($trainingplanOutlineDetailSportitemList) > 0)
	    	{
		    	$trainingplanOutlineDetailSportitemList1 = array();
		    	$trainingplanOutlineDetailSportitemList2 = array();
		    	$trainingplanOutlineDetailSportitemList3 = array();
		    	foreach ($trainingplanOutlineDetailSportitemList as $todsList)
		    	{
		    		//dump($todsList);
		    		//动作组类型 1热身 2练习 3拉伸
		    		if($todsList['sportitemgrouptype'] == 1)
		    		{	
		    			$trainingplanOutlineDetailSportitemList1[] = $todsList;
		    		}
		    		if($todsList['sportitemgrouptype'] == 2)
		    		{
		    			$trainingplanOutlineDetailSportitemList2[] = $todsList;
		    		}
		    		if($todsList['sportitemgrouptype'] == 3)
		    		{
		    			$trainingplanOutlineDetailSportitemList3[] = $todsList;
		    		}
		    	}
		    	$this->assign('trainingplanOutlineDetailSportitemList1',$trainingplanOutlineDetailSportitemList1);
    			$this->assign('trainingplanOutlineDetailSportitemList2',$trainingplanOutlineDetailSportitemList2);
    			$this->assign('trainingplanOutlineDetailSportitemList3',$trainingplanOutlineDetailSportitemList3);
	    	}
	    	//dump(count($trainingplanOutlineDetailSportitemList2));
	    	//exit;
    		$this->assign('bodypart',$trainingplanOutlineDetailList[0]['bodypart']);    	
    		$this->assign('outline_detail_id',$outline_detail_id);
    		
    	}    	
    	//查大纲详情id
//    	$btbTrainingplanOutlineDetailPRM = new BtbTrainingplanOutlineDetailPRM();
//    	$btbTrainingplanOutlineDetailPRM->outline_id = $outline_id;
//    	$trainingplanOutlineDetailList = BtbTrainingplanOutlineDetailBLL::getTrainingplanOutlineDetailList($cp,$btbTrainingplanOutlineDetailPRM);
//		$outlineDetailId = array();
//    	foreach ($trainingplanOutlineDetailList as $todList)
//		{
//			$outlineDetailId[0][] = $todList['id']; 
//		}
//		//查单天重点
//		$btbTrainingplanOutlineDetailPRM->id = $outline_detail_id;
//		$trainingplanOutlineDetail = BtbTrainingplanOutlineDetailBLL::getTrainingplanOutlineDetailList($cp,$btbTrainingplanOutlineDetailPRM);
//		$trainingplanOutlineDetail = $trainingplanOutlineDetail[0];
//		$this->assign('outlineDetailId',$outlineDetailId[0]);
		
		//获取登录者的信息
		$user = $this->getLoginInfo();
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
    	$this->assign('daycount',$trainingplanOutlineList['daycount']);
    	//大纲动作列表添加,修改加载此页面
    	$this->assign('addtype',1);
    	$this->assign('actiontype',$actiontype);
    	$this->assign('outline_id',$outline_id);
    	//menu课程大纲
    	$this->assign('headtype',1);
		//$this->display("OutlineDetailsportitemgroup/index");
		$this->display("Outline/outlineDetailsportitemgroup");
	}
		
	//课程大纲动作添加
	public function sportitemgAdd()
	{
		//outline_id
    	$outline_id = isset($_POST['outline_id']) ? trim($_POST['outline_id']):null;
    	//outline_detail_id
    	$outline_detail_id = isset($_POST['outline_detail_id']) ? trim($_POST['outline_detail_id']):null;
    	//sportitemgrouptype
    	$sportitemgrouptype = isset($_POST['sportitemgrouptype']) ?trim($_POST['sportitemgrouptype']):null;
    	$name = isset($_POST['addname'])? trim($_POST['addname']) : null;
    	//动作类型 1 个数 2时间
    	$grouptype = isset($_POST['addgrouptype']) ? trim($_POST['addgrouptype']): null;
    	$count = isset($_POST['addcount'])? trim($_POST['addcount']) : null;
    	$groupcount = isset($_POST['addgroupcount']) ? trim($_POST['addgroupcount']): null;
    	$targetbodypart = isset($_POST['addtargetbodypart']) ? trim($_POST['addtargetbodypart']): null;
    	$targetmuscles = isset($_POST['addtargetmuscles']) ? trim($_POST['addtargetmuscles']): null;    	    	   	
    	//判断动作是否存在
    	$cp = new CommonPRM();
    	$btbTrainingplanOutlineDetailSportitemPRM = new BtbTrainingplanOutlineDetailSportitemPRM();
    	$btbTrainingplanOutlineDetailSportitemPRM->name = $name;
    	$btbTrainingplanOutlineDetailSportitemPRM->outline_detail_id = $outline_detail_id;
    	//$btbTrainingplanOutlineDetailSportitemPRM->outline_id = $outline_id;
		$trainingplanOutlineDetailSportitemList = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemList($cp,$btbTrainingplanOutlineDetailSportitemPRM);    	
		$jsondata = array();
		if(count($trainingplanOutlineDetailSportitemList) > 0)
    	{
    		//动作以存在
    		//$rows = -1;   		
			$jsondata['code'] = -1;
			$jsondata['msg'] = '动作以存在,不能重复添加';
    	}
    	else
    	{
    		$data = array();
	    	$data['name'] = $name;
	    	$data['count'] = $count;
	    	$data['outline_id'] = $outline_id;
	    	$data['outline_detail_id'] = $outline_detail_id;
	    	$data['targetmuscles'] = $targetmuscles;
	    	$data['sportitemgrouptype'] = $sportitemgrouptype;
	    	$data['groupcount'] = $groupcount;
	    	$data['grouptype'] = $grouptype;
	    	$data['targetbodypart'] = $targetbodypart;
	    	$rows = BtbTrainingplanOutlineDetailSportitemBLL::btbTrainingplanOutlineDetailSportitemInsert($data);
	    	if($rows > 0)
	    	{
	    		$jsondata['code'] = 1;
	    	}
	    	else
	    	{
	    		$jsondata['code'] = -2;
				$jsondata['msg'] = '添加动作失败';
	    	}
    	}
    	//$this->ajaxReturn($rows);
    	$this->ajaxReturn($jsondata);
	}
	
	//新建大纲动作列表编辑动作页面
    public function sportitemgUpdateIndex()
    {
		$trainingplan_outline_detail_sportitem_id = isset($_POST['trainingplan_outline_detail_sportitem_id']) ?trim($_POST['trainingplan_outline_detail_sportitem_id']):null;
    	$cp = new CommonPRM();
		$btbTrainingplanOutlineDetailSportitemPRM = new BtbTrainingplanOutlineDetailSportitemPRM();
		$btbTrainingplanOutlineDetailSportitemPRM->id = $trainingplan_outline_detail_sportitem_id;
		$trainingplanOutlineDetailSportitemList = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemList($cp,$btbTrainingplanOutlineDetailSportitemPRM);
    	$this->ajaxReturn($trainingplanOutlineDetailSportitemList[0]);
    }
    
	//大纲动作列表编辑动作执行
	public function sportitemgUpdate()
	{
		//$name = isset($_POST['updatename']) ? trim($_POST['updatename']):null;
		$id = isset($_POST['id']) ? trim($_POST['id']):null;
		//updategrouptype
		$grouptype = isset($_POST['updategrouptype']) ? trim($_POST['updategrouptype']):null;
		$count = isset($_POST['updatecount']) ? trim($_POST['updatecount']):null;
		$groupcount = isset($_POST['updategroupcount']) ? trim($_POST['updategroupcount']):null;
		$targetbodypart = isset($_POST['updatetargetbodypart']) ? trim($_POST['updatetargetbodypart']): null;
		$targetmuscles = isset($_POST['updatetargetmuscles']) ? trim($_POST['updatetargetmuscles']):null;								
		//判断动作是否存在
//    	$cp = new CommonPRM();
//    	$btbTrainingplanOutlineDetailSportitemPRM = new BtbTrainingplanOutlineDetailSportitemPRM();
//    	$btbTrainingplanOutlineDetailSportitemPRM->name = $name;
//		$trainingplanOutlineDetailSportitemList = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemList($cp,$btbTrainingplanOutlineDetailSportitemPRM);    	
//		if(count($trainingplanOutlineDetailSportitemList) > 0)
//    	{
//    		//动作以存在
//    		$rows = -1;
//    	}
//		else
//		{
			$data = array();
			$data['id'] = $id;
			$data['count'] = $count;
			//$data['name'] = $name;
			$data['targetmuscles'] = $targetmuscles;
			$data['groupcount'] = $groupcount;
			$data['grouptype'] = $grouptype;
			$data['targetbodypart'] = $targetbodypart;
			$rows = BtbTrainingplanOutlineDetailSportitemBLL::btbTrainingplanOutlineDetailSportitemUpdate($data);
			if($rows > 0)
			{
				//修改成功
				$jsondata['code'] = 1;
				$jsondata['msg'] = '修改成功';
			}
			else
			{
				//修改失败
				$jsondata['code'] = -1;
				$jsondata['msg'] = '修改失败';
			}
	//	}	
		$this->ajaxReturn($jsondata);
	}
	
	//课程大纲动作删除
	public function sportitemgDel()
	{	
		//trainingplan_outline_detail_sportitem_id
		$id = isset($_POST['id'])?trim($_POST['id']):null;
		$data = array();
		$data['id'] = $id;
		$data['obj_status'] = 0;
		$rows = BtbTrainingplanOutlineDetailSportitemBLL::btbTrainingplanOutlineDetailSportitemUpdate($data);
		if($rows > 0)
		{
			//修改成功
			$jsondata['code'] = 1;
			$jsondata['msg'] = '删除成功';
		}
		else
		{
			//修改失败
			$jsondata['code'] = -1;
			$jsondata['msg'] = '删除失败';
		}
		$this->ajaxReturn($jsondata);
	}
	
	//课程大纲保存
	public function sportitemgroupSave()
	{
		$outline_id = isset($_GET['outline_id'])? trim($_GET['outline_id']):null;
		$cp = new CommonPRM();
		$btbTrainingplanOutlineDetailSportitemPRM = new BtbTrainingplanOutlineDetailSportitemPRM();
		$btbTrainingplanOutlineDetailSportitemPRM->outline_id = $outline_id;
    	$trainingplanOutlineDetailSportitemList = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemList($cp,$btbTrainingplanOutlineDetailSportitemPRM);
		$listCount = count($trainingplanOutlineDetailSportitemList);
		
//		$this->assign('listCount',$listCount);
//    	$this->display("OutlineDetailsportitemgroupAdd/sportitemgroupSave");
		$this->ajaxReturn($listCount);
	}
	
 	//课程大纲提交
	public function outlineCommit()
    {
    	//outline_id
    	$outline_id = isset($_POST['outline_id']) ? trim($_POST['outline_id']):null;
    	$dataEntity = array();
    	$arr = array();
    	$jsondata = array();
    	$jsondata['code'] =1;
    	$i = 0;
    	$cp = new CommonPRM();
    	$btbTrainingplanOutlinePRM = new BtbTrainingplanOutlinePRM();
    	$btbTrainingplanOutlineDetailSportitemPRM = new BtbTrainingplanOutlineDetailSportitemPRM();
    	//部分课时还未添加动作，请补充完整再提交审核
		$btbTrainingplanOutlineDetailPRM = new BtbTrainingplanOutlineDetailPRM();
		$btbTrainingplanOutlineDetailPRM->outline_id = $outline_id;
		$btbTrainingplanOutlineDetailSportitemPRM->outline_id = $outline_id;
    	$trainingplanOutlineDetailList = BtbTrainingplanOutlineDetailBLL::getTrainingplanOutlineDetailList($cp,$btbTrainingplanOutlineDetailPRM);
		foreach ($trainingplanOutlineDetailList as $todList)
		{	
			if($todList['bodypart'] == '')
			{
				$jsondata['code'] = -4;
				$jsondata['msg'] = "请选择当天的单天重点";
				$arr[0] = $jsondata;
				$this->ajaxReturn($arr);
				return;
			}
			$btbTrainingplanOutlineDetailSportitemPRM->outline_detail_id = $todList['id'];
			$trainingplanOutlineDetailSportitemList = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemList($cp,$btbTrainingplanOutlineDetailSportitemPRM);
			if(count($trainingplanOutlineDetailSportitemList) == 0)
			{
				$jsondata['code'] = -3;
				$jsondata['msg'] = "部分课时还未添加动作，请补充完整再提交审核";
				$arr[0] = $jsondata;
				$this->ajaxReturn($arr);
				return;
			}
		}
    	//outline_detail_id
    	//$outline_detail_id = isset($_POST['outline_detail_id']) ? trim($_POST['outline_detail_id']):null;
    	//$outline_id = 46;
    	if($jsondata['code'] != -3)
    	{
	    	//查看动作是否审核过
	    	//$btbTrainingplanOutlineDetailSportitemPRM->outline_detail_id = $outline_detail_id;
	    	//初始化outline_detail_id
    		$btbTrainingplanOutlineDetailSportitemPRM->outline_detail_id = '';
	    	$trainingplanOutlineDetailSportitemList = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemList($cp,$btbTrainingplanOutlineDetailSportitemPRM);	
	    	//if(count($trainingplanOutlineDetailSportitemList)== 0)
	//    	{
	//    		
	//    	}
	    	foreach($trainingplanOutlineDetailSportitemList as $todsList)
	    	{
	    		//查看动作表里是否有动作
	    		$btbTrainingplanOutlineDetailSportitemPRM->name = $todsList['name'];
	    		$btbTrainingplanOutlineDetailSportitemPRM->source_outline_id = $outline_id;
	    		$btbTrainingplanOutlineDetailSportitemPRM->source_outline_detail_id = $todsList['outline_detail_id'];
	    		$data = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemWithSportitemBaseList($cp,$btbTrainingplanOutlineDetailSportitemPRM);
	    		//没有动作
		    	if(count($data) == 0)
		    	{
		    		//$dataEntity[]['name'] =$todsList['name'];
	    			$dataEntity['name'] =$todsList['name'];
	    			$dataEntity['source_outline_id'] = $todsList['outline_id'];
	    			$dataEntity['source_outline_detail_id'] = $todsList['outline_detail_id'];
	    			//查训练方案名称
	    			$btbTrainingplanOutlinePRM->id = $todsList['outline_id'];
	    			$trainingplanOutlineList = BtbTrainingplanOutlineBLL::getTrainingplanOutlineList($cp,$btbTrainingplanOutlinePRM);	
	    			if(count($trainingplanOutlineList) > 0)
	    			{
	    				$outline_name =  $trainingplanOutlineList[0]['name'];
	    				//创建人id
	    				$dataEntity['obj_createuser'] = $trainingplanOutlineList[0]['coach_id'];
	    			}
	    			//查第几天
	    			$btbTrainingplanOutlineDetailPRM->id = $todsList['outline_detail_id'];
	    			$trainingplanOutlineDetailList = BtbTrainingplanOutlineDetailBLL::getTrainingplanOutlineDetailList($cp,$btbTrainingplanOutlineDetailPRM);
	    			if(count($trainingplanOutlineDetailList) > 0)
	    			{
	    				$day = $trainingplanOutlineDetailList[0]['day'];
	    			}
	    			//徒手训练第1节 			
	    			$dataEntity['source'] = $outline_name.'第'.$day.'节';
	    			//未提交
	    			$dataEntity['auditstatus'] = 0;
	    			$rows = BtbSportitemBaseBLL::btbSportitemBaseInsert($dataEntity);
	    			if($rows > 0)
	    			{
	    				//$flag = 1;
	    				//计算有多少个动作解析
	    				$jsondata['code'] = 1;
	    				$i= $i+1;
	    				//更新大纲详情动作表sportitem_base_id
	    				$dataTrainingplanOutlineDetailSportitem =  array();
	    				$dataTrainingplanOutlineDetailSportitem['id'] = $todsList['id'];
	    				$dataTrainingplanOutlineDetailSportitem['sportitem_base_id'] = $rows;
	    				$rowsTrainingplanOutlineDetailSportitem = BtbTrainingplanOutlineDetailSportitemBLL::btbTrainingplanOutlineDetailSportitemUpdate($dataTrainingplanOutlineDetailSportitem);
	    				if($rowsTrainingplanOutlineDetailSportitem >0)
	    				{
	    					$jsondata['code'] = 1;
	    				}
	    				else
	    				{
	    					$jsondata['code'] = -5;
	    					$jsondata['msg'] = "大纲详情动作表更新失败";
	    				}
	    			}
	    			else
	    			{
	    				//$flag = 0;
	    				$jsondata['msg'] = "动作组插入失败";		
						$jsondata['code'] = -1;
	    			}		    	
		    	}
	    	}
	    	//$jsondata['code'] = 0;
	    	if($jsondata['code'] == 1)
	    	{
	    		//改变提交状态
		    	$outlinedata = array();
		    	$outlinedata['id'] = $outline_id;
		    	//0未提交 1审核中 2 已审核  -1 审核未通过
		    	$outlinedata['auditstatus'] = 1;
		    	$outlinerows = BtbTrainingplanOutlineBLL::btbTrainingplanOutlineUpdate($outlinedata);
		    	if($outlinerows > 0)
		    	{
		    		//$flag = 1;大纲状态更新成功
		    		$jsondata['code'] = 1;
		    	}
		    	else
		    	{
		    		//$flag = 0;
		    		$jsondata['msg'] = "大纲状态更新失败";
					$jsondata['code'] = -2;
		    	}
	    	}  	
    	}
    	//$arr[0] = $flag;
    	$arr[0] = $jsondata;
    	$arr[1] = $i;
    	$this->ajaxReturn($arr);
    }
	
	//单天重点保存
	public function outlineDetailSave()
	{
		$outline_id= isset($_POST['outline_id'])?trim($_POST['outline_id']):null;
		//outline_detail_id
		$outline_detail_id = isset($_POST['outline_detail_id'])?trim($_POST['outline_detail_id']):null;
		//bodypart
		$bodypart= isset($_POST['bodypart'])?trim($_POST['bodypart']):null;
		$cp = new CommonPRM();
		$btbTrainingplanOutlineDetailPRM = new BtbTrainingplanOutlineDetailPRM();
		$btbTrainingplanOutlineDetailPRM->outline_id = $outline_id;
		$btbTrainingplanOutlineDetailPRM->id = $outline_detail_id;
		$trainingplanOutlineDetailList = BtbTrainingplanOutlineDetailBLL::getTrainingplanOutlineDetailList($cp,$btbTrainingplanOutlineDetailPRM);
		$trainingplanOutlineDetailList = $trainingplanOutlineDetailList[0];
		$data = array();
		$jsondata = array();
		if(count($trainingplanOutlineDetailList) > 0)
		{
			$data['id'] = $trainingplanOutlineDetailList['id'];
			$data['bodypart'] = $bodypart;
			$outlineDetailUpdateRows = BtbTrainingplanOutlineDetailBLL::btbTrainingplanOutlineDetailUpdate($data);
			if($outlineDetailUpdateRows > 0)
			{
				//单天重点保存成功
				//$flag = 1;
				$jsondata['msg'] = '单天重点保存成功';
				$jsondata['code'] = 1;
			}
			else
			{
				//单天重点保存失败
				//$flag = 0;
				$jsondata['msg'] = "单天重点保存失败";
				$jsondata['code'] = -1;
			}
		}
		else
		{
			//$flag = 0;
			$jsondata['msg'] = "大纲详情不存在";
			$jsondata['code'] = -2;
		}
		$this->ajaxReturn($jsondata);
		//$this->ajaxReturn($flag);
	}
	
	//上一步
	public function prev()
	{
		//outline_id
		$outline_id = SessionData::getPageData('OutlineDetailsportitemgroup', 'outline_id');
		//编辑2
		SessionData::setPageData('OutlineDetail', 'actiontype',2);
		SessionData::setPageData('OutlineDetail', 'outline_id',$outline_id);
		$this->redirect('OutlineDetail/index');
	}
}