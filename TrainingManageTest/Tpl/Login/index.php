{__NOLAYOUT__}
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <title>
            BTB
        </title>
        <link href="__PUBLICROOT__/TrainingManage/css/login.css" rel="stylesheet" type="text/css">
        <link href="__PUBLICROOT__/TrainingManage/css/common.css" rel="stylesheet" type="text/css">
        <script src="__PUBLICROOT__/TrainingManage/js/jquery-1.9.0.min.js" language="javascript" type="text/javascript">
        </script>
        <!--[if lte IE 7]>
            <link rel="stylesheet" type="text/css" href="css/ie7.css" />
            <div class="if-ie7">
                您的浏览器版本过低，无法正常显示网站内容，请升级您的浏览器至IE8或以上，谢谢。
            </div>
        <![endif]-->
    </head>

    <body>
	<div class="login-bg-wrap">
	<div class="login-bg">
    <span class="in-0">  BTB课程设计平台   </span>
	  <div class="in-1"><input id="txtcoach" type="text" placeholder="用户名" name="txtcoach"></div>
	  <div class="in-2"><input id="txtpwd" type="password" placeholder="密码" name="txtpwd"></div>
	 <!-- 
    <a class="in-4" href="index.html">登陆</a>
     -->
    <input id="btnlogin" class="in-4 hand" type="button" value="登陆" />
    <div class="in-5">Copyright © 2014-2016 上海哥特网络技术有限公司</div>
    </div>
    </div>
<script type="text/javascript">
$(function(){
	$("#txtcoach").focus(function(){
		//$(".login-alert1").html("");
	});
	$("#txtpwd").focus(function(){
		//$(".login-alert2").html("");
	});
	// 回车键登陆
	$(document).keypress(function(e){
	   if(e.which == 13){  
	   		$("#btnlogin").click();  
	   }  
	});
	$("#btnlogin").click(function(){
		//alert(1111);
		var $txtcoach = $("#txtcoach").val();
		//alert($txtcoach);
		var $txtpwd = $("#txtpwd").val();
		//alert($txtpwd);
		if($txtcoach == ""){
			$txtcoach = "请输入您的用户名";
		}
		if($txtpwd == ""){
			$txtpwd = "请输入您的登陆密码";
		}
		$.ajax({
			url:"__URL__/loginin",
			type:'post',
			data: {'txtcoach':$txtcoach,'txtpwd':$txtpwd},
			'datatype':'json',
			success:function(jsondata){
				//console.log(jsondata);
				if(jsondata['updatestatus'] == 0 && jsondata['errortype'] == 1 &&　jsondata['msg']　==　'请输入用户名'){
					//请输入用户名
					alert(jsondata['msg']);
				}
				if(jsondata['updatestatus'] == 0 && jsondata['errortype'] == 2　&& jsondata['msg']　==　'请输入密码'){
					//请输入密码
					alert(jsondata['msg']);
				}
				if(jsondata['updatestatus'] == 0 && jsondata['errortype'] == 1　&& jsondata['msg']　==　'该用户不存在'){
					//该用户不存在
					alert(jsondata['msg']);
				}
				if(jsondata['updatestatus'] == 0 && jsondata['errortype'] == 2　&& jsondata['msg']　==　'密码不正确'){
					//密码不正确
					alert(jsondata['msg']);
				}
				if(jsondata['updatestatus'] == 1){
					//跳到课程管理页面
					if(jsondata['type'] == 1)
					{
						window.location.href='<?php echo U('OutlineList/index');?>';
					}
					//跳到课程审核页面
					if(jsondata['type'] == 0)
					{
						window.location.href='<?php echo U('OutlineCheckList/index?auditstatus=1');?>';
					}				
				}	
			},
		});
	});
})
</script>
    </body>
</html>
