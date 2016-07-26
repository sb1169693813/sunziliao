<?php
/**
 * 
 * 课程设计完善
 * @author sun
 *
 */
class TrainingplanBaseListAction extends BaseAction
{
	//课程设计完善首页
    public function index()
    {
    	//当前页码
		$nowpage  = isset($_GET['pageIndex']) ? trim($_GET['pageIndex']) : 1;
		//审核状态
		$status = isset($_GET['status']) ? trim($_GET['status']):null;
		$cp = new CommonPRM();
		$pageInfo = new PageInfo();
		$pageInfo->nowpage = $nowpage;
		$pageInfo->pagesize = 10;
		$cp->pageinfo = $pageInfo;
		$btbTrainingplanBasePRM = new BtbTrainingplanBasePRM();
		$btbTrainingplanBasePRM->order_by = ' id DESC ';
		if(!is_null($status))
		{
			if(is_numeric($status))
			{
				//auditstatus不为空赋予查询条件
				$btbTrainingplanBasePRM->status = $status;
				//分页跳转的时候保证查询条件
				$urlPrefix ='TrainingplanBaseList/index?status='.$status;
			}
		}
		else
		{
			$urlPrefix ='TrainingplanBaseList/index';
		}
    	//教练id coach_id
//    	$ses = SessionData::getAttribute('loginUserInfo');
//    	if(isset($ses))
//    	{
//    		$coach_id = $ses['id'];
//   		}
		$coach_id = $this->getLoginUserID();
   		$btbTrainingplanBasePRM->coach_id = $coach_id;
   		//获取登录者的信息
		$user = $this->getLoginInfo();
		//课程设计完善List
		$trainingplanBaseList = BtbTrainingplanBaseBLL::getTrainingplanBaseList($cp,$btbTrainingplanBasePRM);
		$page = new CLinkPager($pageInfo->totalcount,$pageInfo->pagesize,$urlPrefix);
		$show = $page->show();
		$this->assign('status',$status);
		$this->assign('totalcount',$pageInfo->totalcount);
    	$this->assign('page',$show);
		$this->assign('trainingplanBaseList',$trainingplanBaseList);
		//menu课程设计
		$this->assign('headtype',3);
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
		//$this->display("TrainingplanBaseList/index");
		$this->display("TrainingplanBase/index");
    }
       
    //课程设计完善查看
    public function view()
    {
    	//$cp = new CommonPRM();
    	//trainingplan_base_id
    	$trainingplan_base_id = isset($_GET['trainingplan_base_id']) ? trim($_GET['trainingplan_base_id']):null;
    	//设置跳转session值
		SessionData::setPageData('TrainingplanBaseDetail', 'trainingplan_base_id', $trainingplan_base_id);
		//查看1
		SessionData::setPageData('TrainingplanBaseDetail', 'actiontype', 1);
    	$this->redirect('TrainingplanBaseDetail/index');
    }
    
    //课程设计完善编辑
    public function update()
    {
    	$trainingplan_base_id = isset($_GET['trainingplan_base_id']) ? trim($_GET['trainingplan_base_id']):null;
    	//设置跳转session值
		SessionData::setPageData('TrainingplanBaseDetail', 'trainingplan_base_id', $trainingplan_base_id);
		//修改2
		SessionData::setPageData('TrainingplanBaseDetail', 'actiontype', 2);
    	$this->redirect('TrainingplanBaseDetail/index');
    }
    
    //课程设计提交
    public function trainingplanBaseCommit()
    {
    	//trainingplan_base_id
   		$trainingplan_base_id = isset($_POST['trainingplan_base_id']) ? trim($_POST['trainingplan_base_id']):null;
   		$data = array();
   		$jsondata = array();   		
   		$data['id'] = $trainingplan_base_id;
   		//审核中
   		$data['status'] = 1;
   		$trainingplanBaseUpdateRows = BtbTrainingplanBaseBLL::btbTrainingplanBaseUpdate($data);
   		if($trainingplanBaseUpdateRows > 0)
   		{
   			//审核成功
   			//$flag = 1;
   			$jsondata['code'] = 1;
   			//插入日志
   			$dataLog = array();
   			$dataLog['trainingplan_base_id'] = $trainingplan_base_id;
   			//提交
   			$dataLog['status'] = 1;
   			$trainingplanLogInsertRows = BtbTrainingplanLogBLL::btbTrainingplanLogInsert($dataLog);
   			if($trainingplanLogInsertRows > 0)
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
   		//$this->ajaxReturn($flag);
   		$this->ajaxReturn($jsondata);
    }
}