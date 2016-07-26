<?php
class OutlineListAction extends BaseAction 
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
		if(!is_null($auditstatus))
		{
			if(is_numeric($auditstatus))
			{
				//auditstatus不为空赋予查询条件
				$btbTrainingplanOutlinePRM->auditstatus = $auditstatus;
				//分页跳转的时候保证查询条件
				$urlPrefix ='OutlineList/index?auditstatus='.$auditstatus;
			}
		}
		else
		{
			$urlPrefix ='OutlineList/index';
		}
    	//教练id coach_id
//    	$ses = SessionData::getAttribute('loginUserInfo');
//    	if(isset($ses))
//    	{
//    		$coach_id = $ses['id'];
//   		}
		$coach_id = $this->getLoginUserID();
//		dump($coach_id);
//		exit;
		//获取登录者的信息
		$user = $this->getLoginInfo();
		//课程大纲EntityList
		$btbTrainingplanOutlinePRM->order_by = 'id DESC';
		$btbTrainingplanOutlinePRM->coach_id = $coach_id;
		$trainingplanOutlineList = BtbTrainingplanOutlineBLL::getTrainingplanOutlineList($cp,$btbTrainingplanOutlinePRM);
		$page = new CLinkPager($pageInfo->totalcount,$pageInfo->pagesize,$urlPrefix);
		$show = $page->show();
		$this->assign('auditstatus',$auditstatus);
		$this->assign('totalcount',$pageInfo->totalcount);
    	$this->assign('page',$show);
		$this->assign('trainingplanOutlineList',$trainingplanOutlineList);
		$this->assign('addtype',6);
		//menu课程大纲
		$this->assign('headtype',1);
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
		//$this->display("OutlineList/index");
		$this->display("Outline/index");
    }
    
    //课程大纲详情查看
    public function view()
    {
    	//$cp = new CommonPRM();
    	//outline_id
    	$outline_id = isset($_GET['outline_id']) ? trim($_GET['outline_id']):null;
//    	//设置跳转session值
//		SessionData::setPageData('OutlineDetail', 'outline_id', $outline_id);
//		//查看1
//		SessionData::setPageData('OutlineDetail', 'actiontype', 1);	
    	//$this->redirect('OutlineDetail/index');
    	$this->redirect('OutlineDetail/index',array('actiontype'=>1,'outline_id'=>$outline_id));
    }
     
    //课程大纲编辑
    public function update()
    {
    	//$cp = new CommonPRM();
    	//outline_id
    	$outline_id = isset($_GET['outline_id']) ? trim($_GET['outline_id']):null;
    	//设置跳转session值
		SessionData::setPageData('OutlineDetail', 'outline_id', $outline_id);
		//编辑2
		SessionData::setPageData('OutlineDetail', 'actiontype', 2);
    	$this->redirect('OutlineDetail/index');
    }
    
	//课程大纲新建
    public function add()
    {
    	//新建3
    	SessionData::setPageData('OutlineDetail', 'actiontype', 3);
    	$this->redirect("OutlineDetail/index");
    }
    
    //课程大纲提交
	public function outlineCommit()
    {
    	//outline_id
    	$outline_id = isset($_POST['outline_id']) ? trim($_POST['outline_id']):null;
    	$dataEntity = array();
    	$arr = array();
    	$jsondata = array();
    	$jsondata['code'] = 1;
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
	    	//$jsondata['code'] = 1;
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
    
}