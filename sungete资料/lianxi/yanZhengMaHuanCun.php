<?php
//发送验证码

//判断验证码缓存是否存在
//缓存名称
$cacheName = C('VERIFYCODE_PREFIX').$mpno.'_'.$type;
//发送状态缓存名
$sendStatusCacheName = $cacheName.'_send_status';


if(S($sendStatusCacheName)!== false)
{
	//发送状态名存在，不能重复发送
	$code = 3031;
}
else
{
	//获取随机的验证码
	$captcha = $this->getRandCode(1,$len=6);
	//设置短信发送状态 60秒内不能重新发送
	S($sendStatusCacheName,1,array('expire'=>60));
	//设置缓存
	S($cacheName,$captcha,array('expire'=>C('VERIFYCODE_CACHE_TIME')));


	//验证码存放的缓存时间
	$verifyCacheTime = C('VERIFYCODE_CACHE_TIME')/60;

	//您的验证码是1234，请在XXXX内分钟使用
	$sendMessage = '您的验证码是：'.$captcha.'请在'.$verifyCacheTime.'分钟内使用';

	S($cacheName,$result,array('expire'=>$cacheTime));

}