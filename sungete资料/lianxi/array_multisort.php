<?php
//数据结果
$result = array();
//拼音排序数组
$pinyin = array();
foreach ($cityList as $key => $value) 
{
	$pinyin[$key] = $value['pinyin'];
	$result[$key]['pinyin'] = $value['pinyin'];
	$result[$key]['city_name'] = $value['city_name'];
	$result[$key]['city_code'] = $value['city_code'];
	unset($cityList[$key]);
}

//按照拼音排序
array_multisort($pinyin,SORT_STRING,$result);

