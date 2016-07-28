<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta content="telephone=no"name="format-detection"/>
<meta name="apple-mobile-web-app-status-bar-style" content="default" />
<title>404</title>
</head>
<body style="background:#4CC1D2">

<div style="width:500px; margin:180px auto; text-align:center; color:#fff; font-size:60px; font-family:Georgia ">
<br>
<span style="font-size:28px; font-family:'微软雅黑'; text-shadow:1px 1px 1px #efefef">抱歉，您所访问的页面不存在！<br>
<span style="font-size:20px"><span id="setTimeUp">3</span>秒后自动返回首页</span></span></div>

</body>
<script type='text/javascript'>
//ziji
var timeObj = document.getElementById("setTimeUp");
var clock = setInterval('reload()',1000);
function reload(){
	var timeNum = parseInt(timeObj.innerHTML);
	if(timeNum == 2){
		window.clearInterval(clock);
		window.location.href='https://www.baidu.com';
	}else if(timeNum < 2){
		window.clearInterval(clock);
	}
	timeNum--;
	timeObj.innerHTML = timeNum;
}

/*
var timeobj = document.getElementById("setTimeUp");
var clock = setInterval("reload()",1000);
function reload(){
	var timeNum = parseInt(timeobj.innerHTML);
	if(timeNum == 2){
		window.clearInterval(clock);
		window.location = "https://www.baidu.com";
	}else if(timeNum < 2){
		window.clearInterval(clock);
	}
	timeNum--;
	timeobj.innerHTML = timeNum;
}
*/
</script>
</html>
