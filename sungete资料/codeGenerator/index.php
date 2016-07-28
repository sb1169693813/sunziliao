<?php
//------------------------------- define -----------------------------------
$projectPrefix = null;
$savePath = './temp/';
$dbLinkPrefix = $_SERVER['SCRIPT_NAME'] . '?db=';
$databases = array();
$getConnection = 'getDbConnection';
//require_once('./gii.class.php');
//------------------------------- connection -----------------------------------
define('DB_HOST','211.144.76.248');
define('DB_USER','user');
define('DB_PASSWORD','cinkate');
$connect = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die('mysql connect error');
mysql_query('set names utf8');
$result = mysql_query("show databases",$connect);
while($row = mysql_fetch_assoc($result))
	$databases[] =$row['Database'];
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="lwl">
    <title>Gii Extension</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./gii_static/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="./gii_static/css/bootstrap-theme.min.css">-->
    <!-- Custom styles for this template -->
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
	<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
	<script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Static navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">
                    Toggle navigation
                </span>
                <span class="icon-bar">
                </span>
                <span class="icon-bar">
                </span>
                <span class="icon-bar">
                </span>
            </button>
            <a class="navbar-brand" href="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                Gii Extension
            </a>
        </div>
        <div class="navbar-collapse collapse"> <!-- class="active" -->
            <ul class="nav navbar-nav">
            	<?php for($i=0,$j=0;$i<count($databases),$j<=3;$i++,$j++):?>
            	<?php if($j == count($databases))break;?>
                <li>
                    <a href="<?php echo $dbLinkPrefix.$databases[$i];?>">
                        <?php echo $databases[$i];?>
                    </a>
                </li>                
                <?php endfor;?>
                <?php if(count($databases)>4):?>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        Other Databases
                        <b class="caret">
                        </b>
                    </a>
                    <ul class="dropdown-menu">
                    	<?php for($h=4;$h<count($databases);$h++):?>
                        <li>
                            <a href="<?php echo $dbLinkPrefix.$databases[$h];?>">
                               <?php echo $databases[$h];?> 
                            </a>
                        </li>
                        <?php endfor;?>
                    </ul>
                </li>
                <?php endif;?>              
            </ul>          
        </div>
        <!--/.nav-collapse -->
    </div>
</div>
<div class="container">

<!-- Get 数据db为空时显示  -->
<?php	
	if(!isset($_GET['db'])){?>  
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">      
    	<h2>点击菜单栏选择数据库</h2>
    </div> 
<?php
	}?>
	
<!-- 选择数据库  -->
<?php	
	if(isset($_GET['db'])){
	 	if(in_array($_GET['db'],$databases)){
			$dbName = $_GET['db'];
			$tables = Gii::viewAllTable($connect,$dbName);	
			if(isset($_GET['table']))
			{
				$table = $_GET['table'];
				
				if(!in_array($table,$tables))
				{?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Error!</strong> 表名不存在
					</div>						
				<?php 	
				}else{	
				//echo $table;
				$code = Gii::generalCode($connect, $dbName, $table ,$projectPrefix,$getConnection);
				if(isset($_GET['save']))
				{
					$path = $_GET['save'];
					
					if(!file_exists('./temp'))
					{
						@mkdir('./temp');						
					}
					
					if(!file_exists('./temp/DAO'))
					{
						@mkdir('./temp/DAO');
					}
					
					if(!file_exists('./temp/PRM'))
					{
						@mkdir('./temp/PRM');
					}
					
					if(!file_exists('./temp/BLL'))
					{
						@mkdir('./temp/BLL');
					}
					
					preg_match_all('/^class\s(.*?)PRM/im',$code[1],$metches);
					$saveFilePrefix = $metches[1][0];		
					switch($path)
					{
						case 'DAO':	
							file_put_contents('./temp/DAO/'.$saveFilePrefix.'DAO.class.php',"<?php\n".$code[0]);
							break;						
						case 'PRM':
							file_put_contents('./temp/PRM/'.$saveFilePrefix.'PRM.class.php',"<?php\n".$code[1]);
							break;
						case 'BLL':
							file_put_contents('./temp/BLL/'.$saveFilePrefix.'BLL.class.php',"<?php\n".$code[2]);
							break;
						case 'ALL':
							file_put_contents('./temp/DAO/'.$saveFilePrefix.'DAO.class.php',"<?php\n".$code[0]);
							file_put_contents('./temp/PRM/'.$saveFilePrefix.'PRM.class.php',"<?php\n".$code[1]);
							file_put_contents('./temp/BLL/'.$saveFilePrefix.'BLL.class.php',"<?php\n".$code[2]);
							break;
						default :
							break;
					}
				}?>	
				<div class="col-md-12">			
					<textarea class="form-control" rows="37" noresize><?php echo $code[0];?><?php echo "\n".$code[1];?><?php echo "\n".$code[2];?>
					</textarea>	
				</div>
				<hr />
				<div class="col-md-12">
					<div class="col-lg-2">						
						<code>默认保存文件路径  <?php echo $savePath;?></code>
					</div>
					<div class="col-md-2">					
						<select name="pathtype" class="col-lg-2 form-control" id="save" >
							<option value="ALL">ALL</option>
							<option value="DAO">DAO</option>
							<option value="PRM">PRM</option>				
							<option value="BLL">BLL</option>			
						</select>					
					</div>	
					<div class="col-md-2">
						<button class="btn btn-default" onclick="saveFile()">save</button>
					</div>	
				</div>
<?php 	
			}}
			else
			{ ?>
				<ul class="nav nav-pills">
					<?php foreach($tables as $table):?>
					<li class="wd"><a href="<?php echo $_SERVER['SCRIPT_NAME'].'?db='.$_GET['db'].'&table='.$table;?>"><?php echo $table?></a></li>
					<?php endforeach;?>
				</ul>				
<?php 		}			
	
 		}else{?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Error!</strong> 数据库不存在
			</div>	
<?php
	 	}
	 }
?>
	

</div>
<!-- /container -->
<style>
.wd{min-width:250px;}
textarea{resize:none;}
</style>
<!-- Placed at the end of the document so the pages load faster -->
<script src="./gii_static/js/jquery-1.9.0.min.js"></script>
<script src="./gii_static/js/bootstrap.min.js"></script>
<script>
console.log("你好！！");
<?php if(isset($_GET['db']) && isset($_GET['table'])):?>
function saveFile()
{
	var save = $("#save").val();
	//var prefix = $("#prefix").val();
	alert("save "+save);
	window.location="<?php echo $_SERVER['SCRIPT_NAME'].'?db='.$_GET['db'].'&table='.$_GET['table'];?>"+"&save="+save;
}
<?php endif;?>

</script>
</body>
</html>
<?php
class Gii
{			
	public static function viewAllTable($conn,$dbName)
	{
		mysql_select_db($dbName,$conn);
		$sql = 'show tables';		
		$result = mysql_query($sql,$conn);
		
		$resouce = array();
		while($row = mysql_fetch_assoc($result))		
			$resouce[] = $row['Tables_in_' . $dbName];		
		array_multisort($resouce);	
		return $resouce;
	}
	
	public static function getFieldsAndComments($conn,$table){
		$sql = 'show full columns from ' . $table;
		$result = mysql_query($sql,$conn);
		
		$resouce = array();
		while($row = mysql_fetch_assoc($result))
			$resouce[$row['Field']] = $row['Comment'];	
		return $resouce;	
	}
	
	public static function descTableField($conn,$table)
	{
		$sql = ' desc '.$table;
		$result = mysql_query($sql,$conn);
		
		$resouce = array();
		while($row = mysql_fetch_assoc($result))
			$resouce[] = $row['Field'];	
		return $resouce;	
	}
	
	public static function generalCode($conn,$dbname,$table,$prefix=null,$getConnection='getDbConnection')	
	{		
		mysql_select_db($dbname);		
		//$fields = self::descTableField($conn,$table);
		$res = self::getFieldsAndComments($conn,$table);
		$fields = array_keys($res);

		
		$getTableNameArr = explode('_',$table);
		$funcName = '';
		if(count($getTableNameArr) == 1)
			$funcName = '';
		else
			for($i=1;$i<count($getTableNameArr);$i++)
				$funcName .= ucfirst($getTableNameArr[$i]);

		$daoIfCode = '';
		$prmCode = '';
		foreach($fields as $item)
		{
			if( !preg_match('/^obj_.*?/',$item) )
			{
				$notes = !empty($res[$item]) ? "//{$res[$item]}" : null;
				$daoIfCode .=
"
			if(!String::isNullOrEmpty(\$cond->{$item}))
			{
				{$notes}
				\$sql .= ' AND {$item} = :{$item} ';
				\$param[':{$item}'] = \$cond->{$item};
			}";
				
				
				$prmCode .= "\t{$notes}\n\tpublic \${$item} = null;\n";
			}
		}

		//$prefix = ucfirst($getTableNameArr[0]);
		$prefix = is_null($prefix) || $prefix == '' ? ucfirst($getTableNameArr[0]) : $prefix;
		$getList = $funcName == '' ?$prefix: $funcName;
		$daoCode =
"/**
 * {$table} DAO Create By lwl
 */
class {$prefix}{$funcName}DAO
{	
	/**
	 * 查询 {$table} 表数据
	 * @param CommonPRM \$cp
	 * @param PRM Object \$cond
	 * @return array
	 */
	public static function get{$getList}List(CommonPRM \$cp=null, {$prefix}{$funcName}PRM \$cond=null)
	{
		\$conn = DataAccess::{$getConnection}();
		
		if(is_null(\$cond))
		{
			\$cond = new {$prefix}{$funcName}PRM();
		}
		
		if(\$cond->getCount)
		{
			\$sql = ' SELECT count(0) count FROM {$table} WHERE obj_status = 1';
		}
		else
		{
			\$sql = ' SELECT * FROM {$table} WHERE obj_status = 1 ';
		}		
		
		\$param = array();
		
		if(!is_null(\$cond))
		{
			".$daoIfCode."
			if(!\$cond->getCount)
			{
				if(!is_null(\$cond->order_by))
				{
					\$sql .= ' ORDER BY ' . \$cond->order_by . ' ';			
				}
				if(!is_null(\$cond->limit))
				{
					\$sql .= ' LIMIT ' . \$cond->limit;				
				}
			}			
		}
		
		\$list = BaseDAO::queryList(\$conn, \$cp, \$sql, \$param);
		
		if(\$cond->getCount)
		{
			\$list=\$list[0]['count'];
		}		
		return \$list;
	}

	/**
	 * {$table}新增
	 * @param array
	 * @return last insert id
	 */
	public static function {$getTableNameArr[0]}{$funcName}Insert(\$data)
	{
		\$conn = DataAccess::{$getConnection}();
		\$sql = BaseDAO::getInsertSql('{$table}', \$data);
		\$conn->execute(\$sql, \$data);
		return \$conn->getLastInsID();
	}
	
	/**
	 * {$table}新增全部
	 * @param array
	 * @return last insert id
	 */
	public static function {$getTableNameArr[0]}{$funcName}InsertAll(\$data)
	{
		\$conn = DataAccess::{$getConnection}();
		\$param = array();
		\$sql = BaseDAO::getInsertAllSql('{$table}', \$data, \$param);
		\$conn->execute(\$sql, \$param);
		return \$conn->getLastInsID();
	}
	
	/**
	 * {$table}修改
	 * @param array 
	 * @return affected rows
	 */
	public static function {$getTableNameArr[0]}{$funcName}Update(\$data)
	{
		\$conn = DataAccess::{$getConnection}();
		\$sql = BaseDAO::getUpdateSql('{$table}', \$data);
		return \$conn->execute(\$sql, \$data);		
	}
	
}";	

$prmCode = 
"/**
 * {$table} PRM Create By lwl
 */
class {$prefix}{$funcName}PRM
{
{$prmCode}\n\tpublic \$order_by = null;
\tpublic \$limit = null;

\tpublic \$getCount = false;
}";	


$bllCode = 
"/**
 * {$table} BLL Create By lwl
 */
class {$prefix}{$funcName}BLL
{
	/**
	 * 查询 {$table} 表数据
	 * @param CommonPRM \$cp
	 * @param PRM Object \$cond
	 * @return array
	 */
	public static function get{$getList}List(CommonPRM \$cp=null, {$prefix}{$funcName}PRM \$cond=null)
	{
		return {$prefix}{$funcName}DAO::get{$getList}List(\$cp,\$cond);
	}
	
	/**
	 * {$table}新增
	 * @param array
	 * @return last insert id
	 */
	public static function {$getTableNameArr[0]}{$funcName}Insert(\$data)
	{
		return {$prefix}{$funcName}DAO::{$getTableNameArr[0]}{$funcName}Insert(\$data);
	}
	
	/**
	 * {$table}新增全部
	 * @param array
	 * @return last insert id
	 */
	public static function {$getTableNameArr[0]}{$funcName}InsertAll(\$data)
	{
		return {$prefix}{$funcName}DAO::{$getTableNameArr[0]}{$funcName}InsertAll(\$data);
	}
	
	/**
	 * {$table}修改
	 * @param array \$data
	 * @return affected rows
	 */
	public static function {$getTableNameArr[0]}{$funcName}Update(\$data)
	{
		return {$prefix}{$funcName}DAO::{$getTableNameArr[0]}{$funcName}Update(\$data);
	}
	
	/**
	 * {$table}获取count
	 * @return int
	 */
	public static function get{$getList}Count(CommonPRM \$cp=null, {$prefix}{$funcName}PRM \$cond=null)
	{
		\$cond->getCount = true;
		return {$prefix}{$funcName}DAO::get{$getList}List(\$cp,\$cond);
	}
	
}
";


		return array($daoCode,$prmCode,$bllCode);
	}
	
}
mysql_close($connect);
?>