<?php
class OutlineCheckListAction extends BaseAction 
{
	//课程大纲首页
    public function index()
    {
    	//当前页码
		$nowpage  = isset($_GET['pageIndex']) ? trim($_GET['pageIndex']) : 1;
		//审核状态
		$auditstatus = isset($_GET['auditstatus']) ? trim($_GET['auditstatus']):null;
		$cp = new CommonPRM();
		$pageInfo = new PageInfo();
		$pageInfo->nowpage = $nowpage;
		$pageInfo->pagesize = 10;
		$cp->pageinfo = $pageInfo;
		$btbTrainingplanOutlinePRM = new BtbTrainingplanOutlinePRM();
		//不包括未提交0的状态
		$btbTrainingplanOutlinePRM->auditstatusnot = 0;
		if(!is_null($auditstatus))
		{
			if(is_numeric($auditstatus))
			{
				//auditstatus不为空赋予查询条件
				$btbTrainingplanOutlinePRM->auditstatus = $auditstatus;
				//分页跳转的时候保证查询条件
				$urlPrefix ='OutlineCheckList/index?auditstatus='.$auditstatus;
			}
		}
		else
		{
			$urlPrefix ='OutlineCheckList/index';
		}
		//$coach_id = $this->getLoginUserID();
		//获取登录者的信息
		$user = $this->getLoginInfo();
		//课程大纲EntityList
		$btbTrainingplanOutlinePRM->order_by = 'id DESC';
		//$btbTrainingplanOutlinePRM->coach_id = $coach_id;
		$trainingplanOutlineList = BtbTrainingplanOutlineBLL::getTrainingplanOutlineList($cp,$btbTrainingplanOutlinePRM);
		$page = new CLinkPager($pageInfo->totalcount,$pageInfo->pagesize,$urlPrefix);
		$show = $page->show();
		$this->assign('auditstatus',$auditstatus);
		$this->assign('totalcount',$pageInfo->totalcount);
    	$this->assign('page',$show);
		$this->assign('trainingplanOutlineList',$trainingplanOutlineList);
		//menu课程大纲
		$this->assign('headtype',1);
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
		//$this->display("OutlineCheckList/index");
		$this->display("OutlineCheck/index");
    }
          
    //课程大纲审核
    public function check()
    {
    	//$cp = new CommonPRM();
    	//outline_id
    	$outline_id = isset($_GET['id']) ? trim($_GET['id']):null;
    	$this->redirect('OutlineCheckDetail/index',array('id'=>$outline_id));
    }
   	   
}