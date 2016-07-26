<?php
//OutlineCheckDetailAction大纲审核详情
class OutlineCheckDetailAction extends BaseAction 
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
    	//$this->display("OutlineCheckDetail/index");
    	$this->display("OutlineCheck/outlineCheckDetail");
	}
	
	//编辑
	public function update()
	{
		$outline_id = isset($_GET['id'])?trim($_GET['id']):null;
    	$this->redirect('OutlineCheckDetailUpdate/index',array('id'=>$outline_id));
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
		$jsondata = array();
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
	
	//通过
	public function outlinePass()
	{
		//接收传过来的参数
		//outline_id	
		$outline_id = isset($_POST['outline_id']) ?trim($_POST['outline_id']):null;		
		//outline_detail_id
		//$outline_detail_id = isset($_POST['outline_detail_id']) ?trim($_POST['outline_detail_id']):null;
		$jsondata = array();
		$cp = new CommonPRM();
		//检查是否方案审核过
		$btbTrainingplanBasePRM = new BtbTrainingplanBasePRM();
		$btbTrainingplanBasePRM->outline_id = $outline_id;
		//$btbTrainingplanBasePRM->outline_detail_id = $outline_detail_id;
		$trainingplanBaseList = BtbTrainingplanBaseBLL::getTrainingplanBaseList($cp,$btbTrainingplanBasePRM);
		if(count($trainingplanBaseList) > 0)
		{
			//大纲已审核过了
			//$flag = -2;
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
	    				//name
	    				$dataTrainingplanBase['name'] = $trainingplanOutlineList['name'].($i+1);
	    				//level
	    				$dataTrainingplanBase['level'] = $trainingplanOutlineList['level'];
	    				//coach_id
	    				$dataTrainingplanBase['coach_id'] = $trainingplanOutlineList['coach_id'];		
	    				//equipmenttype课程类型
	    				$dataTrainingplanBase['equipmenttype'] = $trainingplanOutlineList['type'];
	    				//bodypart单天重点
	    				$dataTrainingplanBase['bodypart'] = $todList['bodypart'];
	    				//使用器械
	    				$dataTrainingplanBase['equipment'] = $trainingplanOutlineList['useequipment'];
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
		    			//$flag = 1;
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
				//$flag = 1;
				$jsondata['code'] = 1;
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
}