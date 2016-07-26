<?php
/**
 * 自定义Action基类
 * @copyright   Copyright(c) @哥特网络
 * @author      liuwel
 * @version     1.0
 */
//加载分页类
import('CLinkPager', COMMON_PATH, '.php');
define('PAGE_SIZE', '10');
class BaseAction extends Action {


	protected function _initialize() {
		$this->assign('headtype', 1);
		$this->assign('addtype', 0);
		$this->basecheck();
	}

	protected function basecheck()
	{
		$islogin=0;
		if($this->isLogin())
		{
			$user = $this->getLoginInfo();
			$this->assign('LoginInfo',$user);
			$islogin=1;
		}
		else
		{
			$this->redirect("Login/index");
		}
		$this->assign('islogin',$islogin);
	}


	

	//SEO设置
	function setseo($key,$description=null)
	{
		if(isset($key))
		{
			$keylist=explode("|",$key);
			$pagetitle="";
			$metakeywords="";
			foreach ($keylist as $k=>$value)
			{
				$pagetitle .= $value."_";
				$metakeywords .=$value.",";
			}
			$pagetitle .=PTITLE;
			$metakeywords .=MKEYWORDS;
			$this -> assign('pagetitle', $pagetitle);
			$this -> assign('metakeywords', $metakeywords);
		}
		if(isset($description))
		{
			//$metadescription=MDescription;
			$this -> assign('metadescription', $description);
		}
		else
		{
			$metadescription=MDESCRIPTION;
			$this -> assign('metadescription', $metadescription);
		}
	}

	//判断浏览器类型
	function is_mobile() {
		$agenttype=0;
		$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		$mobile_agents = Array("ucweb","iphone","240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
		$is_mobile = false;
		foreach ($mobile_agents as $device) {
			if (strpos($user_agent, $device)) {
				$is_mobile = true;
				break;
			}
		}
		$is_pc = (strpos($user_agent, 'windows nt')) ? true : false;
		$is_ipad = (strpos($user_agent, 'ipad')) ? true : false;
		$is_mac = (strpos($user_agent, 'mac')) ? true : false;
		$is_weixin = (strpos($user_agent, 'micromessenger')) ? true : false;//是否是微信
		if($is_pc || $is_mac){
			$agenttype=1;
		}
		if($is_ipad){
			$agenttype=2;
		}
		if($is_mobile){
			$agenttype=3;
		}
		if($is_weixin)
		{
			$agenttype=4;
		}
		return $agenttype;
	}

	function is_iphone() {
		$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		$is_iphone = false;
		$is_iphone = (strpos($user_agent, 'iphone')) ? true : false;
		return $is_iphone;
	}

	function isIpad()
	{
		$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		$is_ipad = (strpos($user_agent, 'ipad')) ? true : false;
		return $is_ipad;
	}

	function _empty(){
		$this->display('Static:error404');
	}


	function ParametersCheckFromGet($Paramname)
	{
		$flag=false;
		if(isset($_GET[$Paramname])&&!empty($_GET[$Paramname]))
		{
			$flag=true;
		}
		return $flag;
	}

	function ParametersCheckIntFromGet($Paramname)
	{
		$flag=false;
		if(isset($_GET[$Paramname])&&!empty($_GET[$Paramname]))
		{
			if(is_numeric($_GET[$Paramname]))
			{
				$flag=true;
			}
		}
		return $flag;
	}

	function ParametersCheckFromPost($Paramname)
	{
		$flag=false;
		if(isset($_POST[$Paramname])&&!empty($_POST[$Paramname]))
		{
			$flag=true;
		}
		return $flag;
	}

	function ParametersCheckIntFromPost($Paramname)
	{
		$flag=false;
		if(isset($_POST[$Paramname])&&!empty($_POST[$Paramname]))
		{
			if(is_numeric($_POST[$Paramname]))
			{
				$flag=true;
			}
		}
		return $flag;
	}

	/**
	 * 判断是否用户登录
	 */
	protected function isLogin() {
		return !is_null(SessionData::getAttribute('loginUserInfo'));
	}

	/**
	 * 设置title
	 * @param $title title
	 */
	public function setTitle($title)
	{
		$this->assign("htmlTitle", $title);
	}

	/**
	 * 设置header title
	 * @param $headerTitle title
	 */
	public function setHeaderTitle($headerTitle)
	{
		$this->assign("headerTitle", $headerTitle);
	}


	/**
	 * 设置返回页
	 * @param $backUrl 默认是在哪里调用记录哪个地方
	 * @return void
	 */
	public function setBackUrl($backUrl = __SELF__ )
	{
		if(preg_match('/.*?ajax.*?/',$backUrl))
		{
			return;
		}
		SessionData::setAttribute(BACK_URL, $backUrl);
	}



	/**
	 * 获取登录的用户信息
	 */
	public function getLoginInfo()
	{
		$user = SessionData::getAttribute('loginUserInfo');
		if(is_null($user))
		{
			return null;
		}
		return $user;
	}

	/**
	 * 获取登录的用户ID
	 */
	public function getLoginUserID()
	{
		$user = SessionData::getAttribute('loginUserInfo');
		if(is_null($user))
		{
			return null;
		}
		return $user['id'];
	}

	public function verify(){
		import("ORG.Util.Image");
		Image::BuildImageVerify(5);
	}


	public function getindustrylevel($industrystandardlist,$baseinfo,$operatingreceipt,$totalassets,$userindustry)
	{
		$level=0;
		for($i=0;$i<count($industrystandardlist);$i++)
		{
			switch ($userindustry["type"]) {
				case 0:
					if($baseinfo["employeesnum"]>= $industrystandardlist[$i]["xmin"] && $baseinfo["employeesnum"]< $industrystandardlist[$i]["xmax"])
					{
						$level=$industrystandardlist["level"];
					}
					;
					break;
				case 1:
					if($baseinfo["employeesnum"]>= $industrystandardlist[$i]["xmin"] && $baseinfo["employeesnum"]< $industrystandardlist[$i]["xmax"] && $operatingreceipt>=$industrystandardlist[$i]["ymin"]&& $operatingreceipt<$industrystandardlist[$i]["ymax"])
					{
						$level=$industrystandardlist["level"];
					}
					;
					break;
				case 2:
					if($baseinfo["employeesnum"]>= $industrystandardlist[$i]["xmin"] && $baseinfo["employeesnum"]< $industrystandardlist[$i]["xmax"] && $totalassets>=$industrystandardlist[$i]["ymin"]&& $totalassets<$industrystandardlist[$i]["ymax"])
					{
						$level=$industrystandardlist["level"];
					}
					;
					break;
			}
			if($level!=0)
			{
				break;
			}
		}
		if($level==0)
		{
				
			$level=2;
		}
		return $level;
	}

	static  public function sendMail($Subject,$Body,$email)
	{
		vendor('phpmailer.class#phpmailer');
		 
		//建立邮件发送类
		$mail = new PHPMailer();
		//使用SMTP方式发送
		$mail->IsSMTP();
		//SMTP host
		$mail->Host = "smtp.exmail.qq.com";
		//启用SMTP验证功能
		$mail->SMTPAuth = true;
		//SMTP username
		$mail->Username = "info@fin-net.cn";
		//SMTP password
		$mail->Password = "clio_liu0318";
		//SMTP port
		$mail->Port=25;
		//邮件发送者email地址
		$mail->From = "info@fin-net.cn";
		//邮件发送者名称
		$mail->FromName = "fin-net.cn";
		$mail->CharSet = "utf-8";
		$mail->IsHTML(true);
		//$mail->CharSet = "GB2312";   // 这里指定字符集！
		$mail->Encoding = "base64";

		$address =$email;
		$mail->AddAddress($address);
		//$mail->AddCC('wubing@91sqs.com');
		 
		//邮件标题
		$mail->Subject = $Subject;

		//邮件内容
		$mail->Body = $Body;
		 
		if(!$mail->Send())
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	static  public function getemailbody($newpassword)
	{
		$emailcontent = file_get_contents("email.txt");
		$emailcontent = str_replace("[password]",$newpassword,$emailcontent);
		return $emailcontent;
	}
	
}
