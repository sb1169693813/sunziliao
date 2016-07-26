<?php
class InstrumentReferenceAction extends  BaseAction
{
	
	public function index()
	{
		//获取登录者的信息
		$user = $this->getLoginInfo();
		//课程管理1还是课程审核页面0
		$this->assign('coachtype',$user['type']);
		$this->display("InstrumentReference/index");
	}
}