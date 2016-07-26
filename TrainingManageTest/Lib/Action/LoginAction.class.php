<?php
// 
class LoginAction extends Action 
{
	/**
	 * 登陆首页
	 */
    public function index()
    {
    	$this->display();
    }
    
     /**
	  * 登陆
	 */
    public function loginin()
    {
		$updatestatus= "1";
		$errortype=0;
		header('Content-type:text/html; charset=utf-8');
		
		//检验验证码是否正确
//		if(md5(trim($_POST['verify'])) != Session::get('verify')){
//			$updatestatus= "0";
//			$msg='验证码错误!';
//			$errortype=3;
//		}
		
		//用户名
		$txtcoach = trim($_POST['txtcoach']);
		if($txtcoach == '请输入您的用户名')
		{
			$txtcoach = '';
		}
			
		//密码
		$txtpwd = trim($_POST['txtpwd']);
		if($txtpwd == '请输入您的登陆密码')
		{
			$txtpwd = '';
		}

		if($txtcoach == '')
		{
			$updatestatus= "0";
			$msg='请输入用户名';
			$errortype=1;
		}
			
		if($txtpwd == '')
		{
			$updatestatus= "0";
			$msg='请输入密码';
			$errortype=2;
		}
		if($updatestatus=="0")
		{
			$jsondata['msg']=$msg;
			$jsondata['updatestatus']= $updatestatus;
			$jsondata['errortype']= $errortype;
			//
			$this->ajaxReturn($jsondata);
			return;
		}
		//根据用户名查询用户
		$commonPRM = new CommonPRM();
    	$btbCoachPRM = new BtbCoachPRM();
    	$btbCoachPRM->account = $txtcoach;
    	$coachList = BtbCoachBLL::getCoachList($commonPRM,$btbCoachPRM);
    	if(count($coachList) == 0)
    	{
			$updatestatus= "0";
			$msg="该用户不存在";
			$jsondata['msg']=$msg;
			$jsondata['updatestatus']= $updatestatus;
			$jsondata['errortype']= 1;
			$this->ajaxReturn($jsondata);
			return;
    	}
    	else if($coachList[0]['password'] != md5($txtpwd))
    	{
    		$updatestatus= "0";
			$msg="密码不正确";
			$jsondata['msg']=$msg;
			$jsondata['updatestatus']= $updatestatus;
			$jsondata['errortype']= 2;
			$this->ajaxReturn($jsondata);
			return;
    	}
		else
		{
			$updatestatus= "1";
		}

		if($updatestatus== "1")
		{
			$coach = $coachList[0];
			//保存登录信息
			SessionData::setAttribute('loginUserInfo', $coach);
			$jsondata['updatestatus']= $updatestatus;
			$jsondata['name']= $coach['name'];
			$jsondata['type'] = $coach['type'];
			$this->ajaxReturn($jsondata);
		}
	}
	/**
	 * 登出
	 */
	public function logout()
	{
		// 清空所有Session
		SessionData::clearAll();
		$this->redirect("Login/index");
	}
    
}