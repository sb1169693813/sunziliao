<?php
class OutlineCheckDetailsportitemgroupAction extends  BaseAction
{
	//大纲审核动作列表首页
	public function index()
	{
		//$actiontype = SessionData::getPageData('OutlineDetailsportitemgroup', 'actiontype');
		$cp = new CommonPRM();
		//第几天
		$day = isset($_GET['day']) ?trim($_GET['day']):1;		
    	//查大纲表
		$outline_id = isset($_GET['id']) ?trim($_GET['id']):null;
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
		//获取登录者的信息
		$user = $this->getLoginInfo();
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
    	$this->assign('daycount',$trainingplanOutlineList['daycount']);
    	$this->assign('trainingplanOutlineList',$trainingplanOutlineList);
    	//课程大纲审核后台审核通过,退件页面
    	$this->assign('addtype',3);
    	//$this->assign('actiontype',$actiontype);
    	$this->assign('outline_id',$outline_id);
    	//menu课程大纲
    	$this->assign('headtype',1);
		//$this->display("OutlineCheckDetailsportitemgroup/index");
		$this->display("OutlineCheck/outlineCheckDetailsportitemgroup");
	}
	
	//批注
	public function comment()
	{
		//接收传过来的数据
		//outline_id
		$outline_id = isset($_POST['outline_id']) ? trim($_POST['outline_id']):null;
		//auditreply
		$auditreply = isset($_POST['auditreply']) ? trim($_POST['auditreply']):null;
		$cp = new CommonPRM();
    	$btbTrainingplanOutlinePRM = new BtbTrainingplanOutlinePRM();
    	$btbTrainingplanOutlinePRM->id = $outline_id;
    	//大纲List
		$trainingplanOutlineList = BtbTrainingplanOutlineBLL::getTrainingplanOutlineList($cp,$btbTrainingplanOutlinePRM);
		if(count($trainingplanOutlineList) > 0)
		{
			$data = array();
			$data['id'] = $outline_id;
			$data['auditreply'] = $auditreply;
			$rows = BtbTrainingplanOutlineBLL::btbTrainingplanOutlineUpdate($data);
			if($rows > 0)
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
	
	//通过按钮
	public function outlinePass()
	{
		//接收传过来的参数
		//outline_id	
		$outline_id = isset($_POST['outline_id']) ?trim($_POST['outline_id']):null;		
		//outline_detail_id
		//$outline_detail_id = isset($_POST['outline_detail_id']) ?trim($_POST['outline_detail_id']):null;
		$cp = new CommonPRM();
		//检查是否方案审核过
		$btbTrainingplanBasePRM = new BtbTrainingplanBasePRM();
		$btbTrainingplanBasePRM->outline_id = $outline_id;
		//$btbTrainingplanBasePRM->outline_detail_id = $outline_detail_id;
		$trainingplanBaseList = BtbTrainingplanBaseBLL::getTrainingplanBaseList($cp,$btbTrainingplanBasePRM);
		if(count($trainingplanBaseList) > 0)
		{
			//大纲已审核过了
			//$flag = 2;
			$jsondata['code'] = -1;
			$jsondata['msg'] = '大纲以审核过了,不能重复审核';
		}
		else
		{
			//大纲list
			$btbTrainingplanOutlinePRM = new BtbTrainingplanOutlinePRM();
	    	$btbTrainingplanOutlinePRM->id = $outline_id;
	    	$trainingplanOutlineList = BtbTrainingplanOutlineBLL::getTrainingplanOutlineList($cp,$btbTrainingplanOutlinePRM);
	    	
	    	//大纲详情list
	    	$btbTrainingplanOutlineDetailPRM = new BtbTrainingplanOutlineDetailPRM();
	    	$btbTrainingplanOutlineDetailPRM->outline_id = $outline_id;
	    	//$btbTrainingplanOutlineDetailPRM->id = $outline_detail_id;
	    	$trainingplanOutlineDetailList = BtbTrainingplanOutlineDetailBLL::getTrainingplanOutlineDetailList($cp,$btbTrainingplanOutlineDetailPRM);   		    	
	    	if(count($trainingplanOutlineList) > 0)
	    	{
	    		$trainingplanOutlineList = $trainingplanOutlineList[0];
	    		
	    		if(count($trainingplanOutlineDetailList) > 0)
	    		{
	    			$i = 0;
			    	foreach ($trainingplanOutlineDetailList as $todList)
			    	{
			    		$dataTrainingplanBase = array();
	    				$dataTrainingplanBase['outline_id'] = $outline_id;
	    				$dataTrainingplanBase['outline_detail_id'] = $todList['id'];
	    				//name123
	    				$dataTrainingplanBase['name'] = $trainingplanOutlineList['name'].($i+1);
	    				//level
	    				$dataTrainingplanBase['level'] = $trainingplanOutlineList['level'];
	    				//coach_id
	    				$dataTrainingplanBase['coach_id'] = $trainingplanOutlineList['coach_id'];	
	    				//equipmenttype
	    				$dataTrainingplanBase['equipmenttype'] = $trainingplanOutlineList['type'];
	    				//bodypart
	    				$dataTrainingplanBase['bodypart'] = $todList['bodypart'];
	    				//status审核状态未提交
	    				$dataTrainingplanBase['status'] = 0;
	    				//插入方案表
	    				$rowsTrainingplanBase = BtbTrainingplanBaseBLL::btbTrainingplanBaseInsert($dataTrainingplanBase);
			    		if($rowsTrainingplanBase > 0)
	    				{
	    					$jsondata['code'] = 1;
	    					$i++;
	    				}
	    				else
	    				{
	    					$jsondata['code'] = -2;
	    					$jsondata['msg'] = '方案表插入失败';
	    					return;
	    				} 				
			    	}
		    		if($jsondata['code'] == 1)
		    		{
		    			//插入方案表成功
		    			$flag = 1;
		    			//更改大纲状态为以审核2
		    			$dataOutline = array();
		    			$dataOutline['id'] = $outline_id;
		    			$dataOutline['auditstatus'] = 2;
		    			//auditdate
		    			$dataOutline['auditdate'] = date('Y-m-d H:i:s',time());
		    			$outlinerows = BtbTrainingplanOutlineBLL::btbTrainingplanOutlineUpdate($dataOutline);
		    			if($outlinerows > 0)
		    			{
		    				//更改大纲状态成功
		    				//$flag = 1;
		    				$jsondata['code'] = 1;
		    			}
		    			else 
		    			{
		    				//更改大纲状态失败
		    				//$flag = -1;
		    				$jsondata['code'] = -3;
							$jsondata['msg'] = '更改大纲状态失败';
		    			}
		    		}		    			    			
	    		}	    			    			    			    		
	    	}
		}		
    	//$this->ajaxReturn($flag);
    	$this->ajaxReturn($jsondata);
	}
	
	//退件
	public function outlineBounce()
	{
		//接收传过来的数据
		//outline_id
		$outline_id = isset($_POST['outline_id']) ? trim($_POST['outline_id']):null;
		$jsondata = array();
		$cp = new CommonPRM();
    	$btbTrainingplanOutlinePRM = new BtbTrainingplanOutlinePRM();
    	$btbTrainingplanOutlinePRM->id = $outline_id;
    	//大纲List
		$trainingplanOutlineList = BtbTrainingplanOutlineBLL::getTrainingplanOutlineList($cp,$btbTrainingplanOutlinePRM);
		if(count($trainingplanOutlineList)>0)
		{
			$dataOutline = array();
			$dataOutline['id'] = $outline_id;
			//-1 未通过
			$dataOutline['auditstatus'] = -1;
			//auditdate
		    $dataOutline['auditdate'] = date('Y-m-d H:i:s',time());
			$rowsOutline = BtbTrainingplanOutlineBLL::btbTrainingplanOutlineUpdate($dataOutline);
			if($rowsOutline > 0)
			{
				//退件成功
				$flag = 1;
				//方案表obj_status改为0
				$btbTrainingplanBasePRM = new BtbTrainingplanBasePRM();
				$btbTrainingplanBasePRM->outline_id = $outline_id;
				$trainingplanBaseList = BtbTrainingplanBaseBLL::getTrainingplanBaseList($cp,$btbTrainingplanBasePRM);
				foreach ($trainingplanBaseList as $tbList)
				{
					$dataTrainingplanBase = array();
					$dataTrainingplanBase['id'] = $tbList['id'];
					//改为无效
					$dataTrainingplanBase['obj_status'] = 0;
					$rowsTrainingplanBase = BtbTrainingplanBaseBLL::btbTrainingplanBaseUpdate($dataTrainingplanBase);
					if($rowsTrainingplanBase > 0)
					{
						//修改成功
						//$flag = 1;
						$jsondata['code'] = 1;						
					}
					else
					{
						//修改失败
						//$flag = -1;
						$jsondata['code'] = -2;
						$jsondata['msg'] = '更改方案审核状态失败';
					}
				}
			}
			else
			{
				//退件失败
				//$flag = 0;
				$jsondata['code'] = -1;
				$jsondata['msg'] = '更改大纲审核状态失败';
			}
		}
		//$this->ajaxReturn($flag);
		$this->ajaxReturn($jsondata);
	}
	
	//大纲动作列表查看动作页面
    public function sportitemgUpdateIndex()
    {
		$trainingplan_outline_detail_sportitem_id = isset($_POST['trainingplan_outline_detail_sportitem_id']) ?trim($_POST['trainingplan_outline_detail_sportitem_id']):null;
    	$cp = new CommonPRM();
		$btbTrainingplanOutlineDetailSportitemPRM = new BtbTrainingplanOutlineDetailSportitemPRM();
		$btbTrainingplanOutlineDetailSportitemPRM->id = $trainingplan_outline_detail_sportitem_id;
		$trainingplanOutlineDetailSportitemList = BtbTrainingplanOutlineDetailSportitemBLL::getTrainingplanOutlineDetailSportitemList($cp,$btbTrainingplanOutlineDetailSportitemPRM);
    	$this->ajaxReturn($trainingplanOutlineDetailSportitemList[0]);
    }
    
}