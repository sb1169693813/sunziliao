<?php
return array(
	'URL_MODEL' => '2',

	//数据库配置
    'DB_PREFIX' 			=> '', // 数据库表前缀 
	'DB_TYPE'   			=> 'pdo', // 数据库类型

	'DB_91MASTER' 			=> array(
								'db_type' 	=> 'pdo',
								'db_user' 	=> 'root',
								'db_pwd' 	=> '',
								'db_dsn' 	=> 'mysql:host=127.0.0.1;dbname=91masterdb;charset=UTF8'
								),
//	'DB_91MASTER' 			=> array(
//								'db_type' 	=> 'pdo',
//								'db_user' 	=> 'user',
//								'db_pwd' 	=> 'IozfWPdEz5I7q3+DgRf3cItKwbgkDT67ba51AqMi3O8=',
//								'db_dsn' 	=> 'mysql:host=211.144.76.248;dbname=91masterdb;charset=UTF8'
//								),								
	'DATA_CACHE_FLAG'     	=> false,     // 是否启用缓存
	'DATA_CACHE_PREFIX'     => 'TrainingManage',     // 缓存前缀
	'DATA_CACHE_TYPE'       => 'file',								
								
	//菜品图片上传
	//'COOKBOOKPIC_UPLOAD' => 'gym/cookbook/',																
	'UPLOAD_MAXSIZE'    	=> 10 * 1024 * 1024, //文件图片上传允许的大小
//--------------------------------------------------自定义配置--------------------------------------------------
//--------------------------------------------------文件引用--------------------------------------------------
	'BLL_PATH'				=>  '../BLL/',
	'DAO_PATH'				=>  '../DAO/',
	'PARAM_PATH'			=>  '../PRM/',
							
	'FILE_BASE_URL'    		=> array('http://localhost/Public/'), //文件图片展示路径
//	'FILE_BASE_URL'    		=> array('http://192.168.0.74/Public/'), //文件图片展示路径

	'LAYOUT_ON'             =>  true,     // 是否启用布局
	'LAYOUT_NAME'           =>  'Layout/index', // 当前布局名称 默认为layout
//--------------------------------------------------分组配置--------------------------------------------------
//    'APP_GROUP_MODE'        => 0,  // 分组模式 0 普通分组 1 独立分组
//    'APP_GROUP_LIST'        => '',      // 项目分组设定,多个组之间用逗号分隔,例如'Home,Admin'
// 	'DEFAULT_GROUP'			=> '',

	'DEFAULT_MODULE'        => 'Login', // 默认模块名称
    'DEFAULT_ACTION'        => 'index', // 默认操作名称
 
);
?>