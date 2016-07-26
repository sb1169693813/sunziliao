<?php
/**
 * 
 * 课程设计完善审核
 * @author sun
 *
 */
class TrainingplanBaseCheckListAction extends BaseAction
{
	//课程设计完善审核首页
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
		//不包括未提交0的状态
		$btbTrainingplanBasePRM->statusnot = 0;
		if(!is_null($status))
		{
			if(is_numeric($status))
			{
				//auditstatus不为空赋予查询条件
				$btbTrainingplanBasePRM->status = $status;
				//分页跳转的时候保证查询条件
				$urlPrefix ='TrainingplanBaseCheckList/index?status='.$status;
			}
		}
		else
		{
			$urlPrefix ='TrainingplanBaseCheckList/index';
		}
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
		//$this->display("TrainingplanBaseCheckList/index");
		$this->display("TrainingplanBaseCheck/index");
    }
      
 	//课程设计审核
    public function check()
    {
    	//trainingplan_base_id
    	$trainingplan_base_id = isset($_GET['id']) ? trim($_GET['id']):null;
    	$this->redirect('TrainingplanBaseCheckDetail/index',array('id'=>$trainingplan_base_id));
    }
}