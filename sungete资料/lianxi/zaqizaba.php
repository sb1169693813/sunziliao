<?php
	// $url = "Order/index?keyword=keywordVal";
	// $urlPrefix = str_replace('keywordVal','keyword',$url);
	// echo $urlPrefix;
	$arr = array("gtval" => 'gtdate', "ltval" =>'ltdate');
	$urlPrefix  = strtr("Order/index?gtdate=gtval&ltdate=ltval",$arr);
	echo $urlPrefix;
