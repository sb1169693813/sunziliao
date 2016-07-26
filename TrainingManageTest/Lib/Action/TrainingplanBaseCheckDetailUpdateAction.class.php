<?php
class TrainingplanBaseCheckDetailUpdateAction extends BaseAction
{
	//课程设计完善审核详情编辑首页
	public function index()
	{
		$trainingplan_base_id = isset($_GET['id'])?trim($_GET['id']):null;
		$cp = new CommonPRM();
		$btbTrainingplanBasePRM = new BtbTrainingplanBasePRM();
		$btbTrainingplanBasePRM->id = $trainingplan_base_id;
		$trainingplanBaseList = BtbTrainingplanBaseBLL::getTrainingplanBaseList($cp,$btbTrainingplanBasePRM);
		$trainingplanBaseList = $trainingplanBaseList[0];
//		dump($trainingplanBaseList);
//		exit;
		$btbTrainingplanConfigPRM = new BtbTrainingplanConfigPRM();
		$btbTrainingplanConfigPRM->trainingplan_base_id = $trainingplan_base_id;
		$trainingplanConfigList = BtbTrainingplanConfigBLL::getTrainingplanConfigList($cp,$btbTrainingplanConfigPRM);
		if(count($trainingplanConfigList) > 0)
		{
			$trainingplanConfigList = $trainingplanConfigList[0];
		}
		$btbCoachPRM = new BtbCoachPRM();
		$btbCoachPRM->id = $trainingplanBaseList['coach_id'];
		$coachList = BtbCoachBLL::getCoachList($cp,$btbCoachPRM);
		if(count($coachList) > 0)
		{
			$coachList = $coachList[0];
		}
		//获取登录者的信息
		$user = $this->getLoginInfo();
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
		//$this->assign('coach_name',$user['name']);
		$this->assign('coach_name',$coachList['name']);
		$this->assign("trainingplanBaseList",$trainingplanBaseList);
		$this->assign("trainingplanConfigList",$trainingplanConfigList);
		//课程设计审核后台审核通过,退件页面
		$this->assign('addtype',5);
		//menu课程设计
		$this->assign('headtype',3);
		//$this->display("TrainingplanBaseCheckDetailUpdate/index");
		$this->display("TrainingplanBaseCheck/trainingplanBaseCheckDetailUpdate");
	}
	
	//保存
	public function trainingplanBaseUpdate()
	{
		$jsondata = array();
		//接收post传来的数据
		$trainingplan_base_id = isset($_POST['trainingplan_base_id'])?trim($_POST['trainingplan_base_id']):null;
		$name = isset($_POST['name'])?trim($_POST['name']):null;
		$level = isset($_POST['level'])?trim($_POST['level']):null;
		$bodypart = isset($_POST['bodypart'])?trim($_POST['bodypart']):null;
		$kcal = isset($_POST['kcal'])?trim($_POST['kcal']):null;
		$referenceurl = isset($_POST['referenceurl'])?trim($_POST['referenceurl']):null;
		$warmupstatus = isset($_POST['warmupstatus'])?trim($_POST['warmupstatus']):null;
		$stretchstatus = isset($_POST['stretchstatus'])?trim($_POST['stretchstatus']):null;
		$sportitemgroupcount = isset($_POST['sportitemgroupcount'])?trim($_POST['sportitemgroupcount']):null;
		$ability1 = isset($_POST['ability1'])?trim($_POST['ability1']):null;
		$ability2 = isset($_POST['ability2'])?trim($_POST['ability2']):null;
		$ability3 = isset($_POST['ability3'])?trim($_POST['ability3']):null;
		$ability4 = isset($_POST['ability4'])?trim($_POST['ability4']):null;
		$ability5 = isset($_POST['ability5'])?trim($_POST['ability5']):null;
		//coursestarget
		$coursestarget = isset($_POST['coursestarget'])?trim($_POST['coursestarget']):null;
		//equipmenttype
		$equipmenttype = isset($_POST['equipmenttype'])?trim($_POST['equipmenttype']):null;
		//equipment
		$equipment = isset($_POST['equipment'])?trim($_POST['equipment']):null;
		//targetbodypart
		$targetbodypart = isset($_POST['targetbodypart'])?trim($_POST['targetbodypart']):null;
		//targetmuscle
		$targetmuscle = isset($_POST['targetmuscle'])?trim($_POST['targetmuscle']):null;
		//修改方案表数据
		$trainingplanBaseData = array();
		$trainingplanBaseData['id'] = $trainingplan_base_id;
		$trainingplanBaseData['name'] = $name;
		$trainingplanBaseData['level'] = $level;
		$trainingplanBaseData['bodypart'] = $bodypart;
		$trainingplanBaseData['kcal'] = $kcal;
		$trainingplanBaseData['referenceurl'] = $referenceurl;
		$trainingplanBaseData['ability1'] = $ability1;
		$trainingplanBaseData['ability2'] = $ability2;
		$trainingplanBaseData['ability3'] = $ability3;
		$trainingplanBaseData['ability4'] = $ability4;
		$trainingplanBaseData['ability5'] = $ability5;
		$trainingplanBaseData['coursestarget'] = $coursestarget;
		$trainingplanBaseData['equipmenttype'] = $equipmenttype;
		$trainingplanBaseData['equipment'] = $equipment;
		$trainingplanBaseData['targetbodypart'] = $targetbodypart;
		$trainingplanBaseData['targetmuscle'] = $targetmuscle;
		$trainingplanBaseRows = BtbTrainingplanBaseBLL::btbTrainingplanBaseUpdate($trainingplanBaseData);
		if($trainingplanBaseRows > 0)
		{
			//$flag = 1;
			$jsondata['code'] = 1;
			//配置表数据
			$cp = new CommonPRM();
			$btbTrainingplanConfigPRM = new BtbTrainingplanConfigPRM();
			$btbTrainingplanConfigPRM->trainingplan_base_id = $trainingplan_base_id;
			$trainingplanConfigList = BtbTrainingplanConfigBLL::getTrainingplanConfigList($cp,$btbTrainingplanConfigPRM);			
			if(count($trainingplanConfigList) > 0)
			{
				//修改配置表数据
				$trainingplanConfigData = array();
				$trainingplanConfigData['warmupstatus'] = $warmupstatus;
				$trainingplanConfigData['stretchstatus'] = $stretchstatus;
				$trainingplanConfigData['sportitemgroupcount'] = $sportitemgroupcount;
				$trainingplanConfigData['trainingplan_base_id'] =$trainingplan_base_id;
				$trainingplanConfigData['id'] = $trainingplanConfigList[0]['id'];
				$trainingplanConfigUpdateRows = BtbTrainingplanConfigBLL::btbTrainingplanConfigUpdate($trainingplanConfigData);
				if($trainingplanConfigUpdateRows > 0)
				{
					//$flag = 1;
					$jsondata['code'] = 1;
				}
				else
				{
					//$flag = 0;
					$jsondata['code'] = -2;
					$jsondata['msg'] = '课程结构修改失败';
					//课程结构修改失败
				}
			}
			else
			{
				//插入配置表数据
				$trainingplanConfigInsertRows = BtbTrainingplanConfigBLL::btbTrainingplanConfigInsert($trainingplanConfigData);
				if($trainingplanConfigInsertRows > 0)
				{
					//$flag = 1;
					$jsondata['code'] = 1;
				}
				else
				{
					//$flag = 0;					
					//课程结构插入失败
					$jsondata['code'] = -3;
					$jsondata['msg'] = '课程结构插入失败';
				}
			}
			$btbTrainingplanSportitemgroupPRM = new BtbTrainingplanSportitemgroupPRM();
			//$warmupstatus不存在增加
			$trainingplanSportitemgroupData1 = array();
			//type1热身
			$btbTrainingplanSportitemgroupPRM->type = 1;
			$btbTrainingplanSportitemgroupPRM->trainingplan_base_id = $trainingplan_base_id;
			$trainingplanSportitemgroupData1['trainingplan_base_id'] = $trainingplan_base_id;
			$trainingplanSportitemgroupList1 = BtbTrainingplanSportitemgroupBLL::getTrainingplanSportitemgroupList($cp,$btbTrainingplanSportitemgroupPRM);			
			//$warmupstatus选择了
			if($warmupstatus ==1)
			{		
				//查看动作组表是否存在,不不在添加
				if(count($trainingplanSportitemgroupList1) == 0)
				{
					//1热身 2普通动作组 3拉伸
					$trainingplanSportitemgroupData1['type'] = 1;
					$trainingplanSportitemgroupData1['name'] = '热身';
					$rowsgroup1 = BtbTrainingplanSportitemgroupBLL::btbTrainingplanSportitemgroupInsert($trainingplanSportitemgroupData1);
					if($rowsgroup1 > 0)
					{
						//$flag = 1;
						$jsondata['code'] = 1;
					}
					else
					{
						//$flag = 0;
						//课程结构插入失败
						$jsondata['code'] = -4;
						$jsondata['msg'] = '热身插入失败';
					}	
				}
			}
			//warmupstatus没选择,有数据时
			if($warmupstatus ==0)
			{
				if(count($trainingplanSportitemgroupList1) > 0)
				{
					$trainingplanSportitemgroupList1 = $trainingplanSportitemgroupList1[0];
					$trainingplanSportitemgroupData1['id'] = $trainingplanSportitemgroupList1['id'];
					$trainingplanSportitemgroupData1['type'] = 1;
					$trainingplanSportitemgroupData1['name'] = '热身';
					$trainingplanSportitemgroupData1['obj_status'] = 0;
					$rowsgroup2= BtbTrainingplanSportitemgroupBLL::btbTrainingplanSportitemgroupUpdate($trainingplanSportitemgroupData1);
					if($rowsgroup2 > 0)
					{
						//$flag = 1;
						$jsondata['code'] = 1;
					}
					else
					{
						//$flag = 0;
						//课程结构修改失败
						$jsondata['code'] = -5;
						$jsondata['msg'] = '热身修改失败';
					}
				}
			}
					
			$trainingplanSportitemgroupData2 = array();
			$trainingplanSportitemgroupData2['trainingplan_base_id'] = $trainingplan_base_id;
			//$stretchstatus 选择了
			//type3拉伸
			$btbTrainingplanSportitemgroupPRM->type = 3;
			$trainingplanSportitemgroupList2 = BtbTrainingplanSportitemgroupBLL::getTrainingplanSportitemgroupList($cp,$btbTrainingplanSportitemgroupPRM);
			//拉伸选择了
			if($stretchstatus ==1)
			{
				//查看动作组表是否存在,不不在添加
					if(count($trainingplanSportitemgroupList2) == 0)
					{
						$trainingplanSportitemgroupData2['type'] = 3;
						$trainingplanSportitemgroupData2['name'] = '拉伸';
						$rowsgroup3= BtbTrainingplanSportitemgroupBLL::btbTrainingplanSportitemgroupInsert($trainingplanSportitemgroupData2);
						if($rowsgroup3 > 0)
						{
							//$flag = 1;
							$jsondata['code'] = 1;
						}
						else
						{
							//$flag = 0;
							//课程结构插入失败
							$jsondata['code'] = -6;
							$jsondata['msg'] = '拉伸插入失败';
						}
					}	
			}
			//拉伸没选择
			if($stretchstatus == 0)
			{
				if(count($trainingplanSportitemgroupList2) > 0)
				{
					$trainingplanSportitemgroupList2 = $trainingplanSportitemgroupList2[0];
					$trainingplanSportitemgroupData2['id'] = $trainingplanSportitemgroupList2['id'];
					$trainingplanSportitemgroupData2['type'] = 3;
					$trainingplanSportitemgroupData2['name'] = '拉伸';
					$trainingplanSportitemgroupData2['obj_status'] = 0;
					$rowsgroup4= BtbTrainingplanSportitemgroupBLL::btbTrainingplanSportitemgroupUpdate($trainingplanSportitemgroupData2);
					if($rowsgroup4 > 0)
					{
						//$flag = 1;
						$jsondata['code'] = 1;
					}
					else
					{
						//$flag = 0;
						//课程结构修改失败
						$jsondata['code'] = -7;
						$jsondata['msg'] = '拉伸修改失败';
					}
				}	
			}
				
			//sportitemgroupcount填了
			$trainingplanSportitemgroupData3 = array();
			$trainingplanSportitemgroupData3['trainingplan_base_id'] = $trainingplan_base_id;
			//查询type=2练习的数据
			$btbTrainingplanSportitemgroupPRM->type = 2;
			$trainingplanSportitemgroupList3 = BtbTrainingplanSportitemgroupBLL::getTrainingplanSportitemgroupList($cp,$btbTrainingplanSportitemgroupPRM);
			if(!is_null($sportitemgroupcount))
			{
				if(count($trainingplanSportitemgroupList3) ==0)
				{
					//插入
					for($i=0;$i<$sportitemgroupcount;$i++)
					{
						$trainingplanSportitemgroupData3['type'] = 2;
						$trainingplanSportitemgroupData3['name'] = '普通动作组'.($i+1);
						//sort
						$trainingplanSportitemgroupData3['sort'] = $i+1;
						$rowsgroup5 = BtbTrainingplanSportitemgroupBLL::btbTrainingplanSportitemgroupInsert($trainingplanSportitemgroupData3);
						if($rowsgroup5 > 0)
						{
							//$flag = 1;
							$jsondata['code'] = 1;
						}
						else
						{
							//$flag = 0;
							//课程结构插入失败
							$jsondata['code'] = -8;
							$jsondata['msg'] = '普通动作组插入失败';
						}
					}
				}
//				else
//				{
//					//2->4
//					for($i=0;$i<($sportitemgroupcount-count($trainingplanSportitemgroupList3));$i++)
//					{
//						$trainingplanSportitemgroupData3['type'] = 2;
//						$trainingplanSportitemgroupData3['name'] = '普通动作组'.(count($trainingplanSportitemgroupList3)+$i+1);
//						$rowsgroup7 = BtbTrainingplanSportitemgroupBLL::btbTrainingplanSportitemgroupInsert($trainingplanSportitemgroupData3);
//						if($rowsgroup7 > 0)
//						{
//							$flag = 1;
//						}
//						else
//						{
//							$flag = 0;
//						}
//					}					
//				}
					
			}//sportitemgroupcount状态改为0
//			else
//			{
			//填0小段课程
			if($sportitemgroupcount==0)
			{
				if(count($trainingplanSportitemgroupList3)>0)
				{
					foreach ($trainingplanSportitemgroupList3 as $tsList3)
					{
						$trainingplanSportitemgroupData3['id']= $tsList3['id'];
						$trainingplanSportitemgroupData3['obj_status'] = 0;
						$rowsgroup6 = BtbTrainingplanSportitemgroupBLL::btbTrainingplanSportitemgroupUpdate($trainingplanSportitemgroupData3);
						if($rowsgroup6 > 0)
						{
							//$flag = 1;
							$jsondata['code'] = 1;
						}
						else
						{
							//$flag = 0;
							//课程结构修改失败
							$jsondata['code'] = -9;
							$jsondata['msg'] = '普通动作组修改失败';
						}
					}												
				}
			}
			//}
		}
		else
		{
			//$flag = 0;
			//$flag = 0;
			$jsondata['code'] = -1;
			//方案表修改失败
			$jsondata['msg'] = '课程设计修改失败';
		}
		//$this->ajaxReturn($flag);
		$this->ajaxReturn($jsondata);
	}		
}