<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="renderer" content="webkit" />
        <title>
            BTB课程设计平台
        </title>
        <?php if($coachtype ==1){?>
        <link href="__PUBLICROOT__/TrainingManage/css/hrm-new1.css" rel="stylesheet" type="text/css">
        <?php }?>
        <?php if($coachtype ==0){?>
        <link href="__PUBLICROOT__/TrainingManage/css/hrm-new2.css" rel="stylesheet" type="text/css">
        <?php }?>
        <link href="__PUBLICROOT__/TrainingManage/css/common.css" rel="stylesheet" type="text/css">
        <script src="__PUBLICROOT__/TrainingManage/js/jquery-1.9.0.min.js" language="javascript" type="text/javascript"> </script>
		<script src="__PUBLICROOT__/TrainingManage/js/prefixfree.min.js"></script>
      	<script src="__PUBLICROOT__/TrainingManage/js/main.js" language="javascript" type="text/javascript"> </script>     	
      </head>
        <body>
        <?php  if($addtype==1){?>
<div class="md-modal md-effect-1 box4" id="modal-1">
    <h2>添加动作</h2>
    <div class="mainlist">  	 
		<div class="mainlist">
<!-- 行 1-->
        <div class="line-full t-line-36 h30">
            <div class="wp100wrap  h30">
                <div class="t-15-r">名称：</div>
                <input type="text" id="addname" name="addname" placeholder="" class="input-50-r">
            </div>
        </div>
        <div class="line-full t-line-36 h30">
            <div class="wp100wrap  h30">
                <div class="t-15-r">方式：</div>
                <select class="wp50" name="addgrouptype" id="addgrouptype">
                	<option value="">请选择</option>
                    <option value="1">按数量</option>
                    <option value="2">按时间</option>
                </select>
            </div>
        </div>
        <!-- 行2-->
        <div class="line-full t-line-36 h30">
            <div class="wp100wrap  h30">
                <div class="t-15-r">运动量：</div>
                <input type="text" name="addcount" placeholder="" class="wp21">个/秒
                <input type="text" name="addgroupcount" placeholder="" class="wp21">组
            </div>
        </div>
        <!-- 行3-->
        <div class="line-full t-line-36">
            <div class="wp100wrap  ">
                <div class="t-15-r  fleft">目标部位：<br>（可多选）&nbsp;</div>
                <div class="wp80 lh30 fright">
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="addtargetbodypart" data-labelauty="肩部" class="chk_3" value="肩部" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="addtargetbodypart" data-labelauty="上臂" class="chk_3" value="上臂" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="addtargetbodypart" data-labelauty="前臂" class="chk_3" value="前臂" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="addtargetbodypart" data-labelauty="背部" class="chk_3" value="背部" />

                    </div>

                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="addtargetbodypart" data-labelauty="胸部" class="chk_3" value="胸部" />

                    </div>

                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="addtargetbodypart" data-labelauty="腹部" class="chk_3" value="腹部" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="addtargetbodypart" data-labelauty="臀部" class="chk_3" value="臀部" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="addtargetbodypart" data-labelauty="大腿" class="chk_3" value="大腿" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="addtargetbodypart" data-labelauty="小腿" class="chk_3" value="小腿" />
                    </div>
                </div>
            </div>
        </div>
        <div class="line-full t-line-36 h30">
            <div class="wp100wrap  h30">
                <div class="t-15-r">目标肌肉：</div>
                <input type="text" placeholder="" class="input-50-r" name="addtargetmuscles" id="addtargetmuscles"/>&nbsp;&nbsp;
                <a href="<?php echo U('MuscleReference/index');?>" class="instrument-name" target="_blank">肌肉名称参考</a>
            </div>
        </div>
        <div class=" fleft wp100 h50 line-full save-line">
        	<!--  
            <button class="md-trigger md-close blue" data-modal="modal-2">保&nbsp;&nbsp; &nbsp; &nbsp;存</button>           
            <button class="md-trigger md-close blue" data-modal="modal-2">取&nbsp;&nbsp; &nbsp; &nbsp;消</button>
            -->
            <input id="sub" name="提交" type="button" class="blue hand" value="保&nbsp;&nbsp;&nbsp; &nbsp;存"/>
            <input  id="quxiao" type="button" value="取&nbsp;&nbsp; &nbsp; &nbsp;消" class="blue hand"/>
            <input id="sportitemgrouptype" type="hidden" name="sportitemgrouptype"/>
            <input id="outline_id" type="hidden" name="outline_id"/>
            <input id="outline_detail_id" type="hidden" name="outline_detail_id"/>
        </div>
 </div>
<script type="text/javascript">
$(document).ready(function(){
	//$(':input').labelauty();
	//取消按钮
	$("#quxiao").click(function(){
		//alert(111);		
		$('#modal-1').removeClass('md-show');
		$("#addname").val("");
		$("input[name='addcount']").val("");
		$("input[name='addgroupcount']").val('');
		$('#addtargetmuscles').val('');		
		$('#addgrouptype').children('option:selected').attr('selected',false);
		$('input[name="addtargetbodypart"]:checked').attr('checked',false);
	});
	//保存按钮
	$("#sub").click(function(){
		//alert(22222);
		//名称
		var addname = $('#addname').val();
		//方式
		var addgrouptype = $('#addgrouptype').children('option:selected').val();
		//个数
		var addcount = $("input[name='addcount']").val();
		//组数
		var addgroupcount = $("input[name='addgroupcount']").val();
		//目标部位
    	var chk_value =[];
		$('input[name="addtargetbodypart"]:checked').each(function(){ 
			chk_value.push($(this).val());
		});
		var addtargetbodypart = chk_value.join(',');
		//目标肌肉
		var addtargetmuscles = $('#addtargetmuscles').val();
		//var $groupcount = $('#groupcount').val();
		//热身1 练习2 还是拉伸3		
		var sportitemgrouptype = $('#sportitemgrouptype').val();
		var outline_id = $('#outline_id').val();
		var outline_detail_id = $('#outline_detail_id').val();
		if( addname == '')
		{
			alert('请填写动作名称');
		}
		else if(addname.toString().length > 8)
		{
			alert('动作名称长度不超过8个字');
		}
		else if(addgrouptype == '')
		{
			alert('请选择方式');
		}
//		else if(addcount == '')
//		{
//			alert('请填写数量并以数字形式填写');
//		}
		//alert(isNumber(addcount));
		else if(addcount == '')
		{
			alert('请填写个数');
		}
		else if(isNumber(addcount) == false)
		{
			alert('请以数字形式填写个数');
		}
		else if(parseInt(addcount)>2147483647)
		{
			alert('个数的数字不能超过2147483647');
		}
		else if(addgroupcount == '')
		{
			alert('请填写组数');
		}	
		else if(isNumber(addgroupcount) == false)
		{
			alert('请以数字形式填写组数');
		}
		else if(parseInt(addgroupcount)>2147483647)
		{
			alert('组数的数字不能超过2147483647');
		}	
		else if(addtargetbodypart == '')
		{
			alert('请选择目标部位');
		}
		else if(addtargetmuscles == '')
		{
			alert('请填写目标肌肉,包含多个时,请用 / 隔开');
		}
		else if(addtargetmuscles.toString().length >100)
		{
			alert('目标肌肉不超过100个字');
		}
		else
		{
			$('#modal-1').removeClass('md-show');
			//alert('add');
			if(confirm('确认添加?'))
			{
				$.ajax({
					url:"__URL__/sportitemgAdd",
					type:'post',
					data: {'addname':addname,'addcount':addcount,'addtargetmuscles':addtargetmuscles,'sportitemgrouptype':sportitemgrouptype,
						'outline_id':outline_id,'addgroupcount':addgroupcount,'addgrouptype':addgrouptype,
						'outline_detail_id':outline_detail_id,'addtargetbodypart':addtargetbodypart
						},
					'datatype':'json',
					success:function(jsondata){
						if(jsondata.code == 1)
						{
							//alert('添加成功');						
							window.location.reload();
							//火狐
							$("#addname").val("");
							$("input[name='addcount']").val("");
							$("input[name='addgroupcount']").val('');
							$('#addtargetmuscles').val('');
							$('#addgrouptype').children('option:selected').attr('selected',false);
							$('input[name="addtargetbodypart"]:checked').attr('checked',false);
						}
						if(jsondata.code == -1)
						{
							//动作以存在,不能重复添加
							alert(jsondata.msg);
							$('#modal-1').addClass('md-show');
						}
						if(jsondata.code == -2)
						{
							//添加动作失败
							alert(jsondata.msg);
						}
					},
				});
			}
			else
			{
				$('#modal-1').addClass('md-show');
			}		
		}
	});	
})
</script>	
    </div>
</div>
<div class="md-modal md-effect-1 box4" id="modal-2">
    <h2>编辑动作</h2>
    <div class="mainlist">    	
		    <div class="mainlist">
        <!-- 行 1-->
        <div class="line-full t-line-36 h30">
            <div class="wp100wrap  h30">
                <div class="t-15-r">名称：</div>
                <input type="text" id="updatename" name="updatename" placeholder="" class="input-50-r">
            </div>
        </div>
        <div class="line-full t-line-36 h30">
            <div class="wp100wrap  h30">
                <div class="t-15-r">方式：</div>
                <select class="wp50" name="updategrouptype" id="updategrouptype">
                	<option value="">请选择</option>
                    <option value="1">按数量</option>
                    <option value="2">按时间</option>
                </select>
            </div>
        </div>
        <!-- 行2-->
        <div class="line-full t-line-36 h30">
            <div class="wp100wrap  h30">
                <div class="t-15-r">运动量：</div>
                <input type="text" name="updatecount" placeholder="" class="wp21" id="updatecount" />个/秒
                <input type="text" name="updategroupcount" placeholder="" class="wp21" id="updategroupcount" />组
            </div>
        </div>
        <!-- 行3-->
        <div class="line-full t-line-36">
            <div class="wp100wrap  ">
                <div class="t-15-r  fleft">目标部位：<br>（可多选）&nbsp;</div>
                <div class="wp80 lh30 fright">
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="肩部" class="chk_3" value="肩部" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="上臂" class="chk_3" value="上臂" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="前臂" class="chk_3" value="前臂" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="背部" class="chk_3" value="背部" />

                    </div>

                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="胸部" class="chk_3" value="胸部" />

                    </div>

                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="腹部" class="chk_3" value="腹部" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="臀部" class="chk_3" value="臀部" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="大腿" class="chk_3" value="大腿" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="小腿" class="chk_3" value="小腿" />
                    </div>
                </div>
            </div>
        </div>
        <div class="line-full t-line-36 ">
            <div class="wp100wrap" id="mubiaojirou">
                <div class="t-15-r">目标肌肉：</div>
                <input type="text" placeholder="" class="input-50-r none" name="updatetargetmuscles" id="updatetargetmuscles"/>&nbsp;&nbsp;                
                <div class="input-50-r none" style="height:auto;text-indent: 0px;" id="updatetargetmusclesDiv"></div>
                <a href="<?php echo U('MuscleReference/index');?>" class="instrument-name" target="_blank">肌肉名称参考</a>
            </div>
        </div>
        <div class=" fleft wp100 h50 line-full save-line">
        	<!--  
            <button class="md-trigger md-close blue" data-modal="modal-2">保&nbsp;&nbsp; &nbsp; &nbsp;存</button>
            <button class="md-trigger md-close blue" data-modal="modal-2">取&nbsp;&nbsp; &nbsp; &nbsp;消</button>
            -->
            <input id="subm" name="提交" type="button" class="blue hand" value="保&nbsp;&nbsp;&nbsp; &nbsp;存"/>
            <input  id="cance" type="button" value="取&nbsp;&nbsp; &nbsp; &nbsp;消" class="blue hand"/>
            <input id="outline_detail_sportitem_id" type="hidden" name="outline_detail_sportitem_id"/>
        </div>
    </div>
<script type="text/javascript">
$(function(){
	//查看页面1
   	if(<?php echo $actiontype;?> == 1)
   	{
   	   	//隐藏保存按钮
		$('#subm').addClass('none');
		//禁用一些选项
		$('#updategrouptype').attr('disabled',true);
		//updatecount
		$('#updatecount').attr('disabled',true);
		//updategroupcount
		$('#updategroupcount').attr('disabled',true);
		//updatetargetbodypart
		$('input[name="updatetargetbodypart"]').attr('disabled',true);
		//updatetargetmuscles
		//$('#updatetargetmuscles').attr('disabled',true);
		$('#updatetargetmuscles').addClass('none');
		$('#updatetargetmusclesDiv').removeClass('none');		
   	}
   	//编辑页面
   	if(<?php echo $actiontype;?> == 2)
   	{
   		$('#updatetargetmuscles').removeClass('none');
   	   	$('#updatetargetmusclesDiv').addClass('none');
   	}
   	//新建页面的编辑
   	if(<?php echo $actiontype;?> == 3)
   	{
   		$('#updatetargetmuscles').removeClass('none');
   	   	$('#updatetargetmusclesDiv').addClass('none');
   	} 	
	$('#updatename').attr('disabled',true);
	//$(':input').labelauty();
	//取消按钮
	$("#cance").click(function(){
//		$("#updatename").val("");
//		//$("#updatecount").val("");
//		$('input[name="updatetargetmuscles"]:checked').attr('checked',false);
		$("#modal-2").removeClass('md-show');
		$('input[name="updatetargetbodypart"]:checked').attr('checked',false);
	});
	//修改保存按钮
	$("#subm").click(function(){
		//alert('2add');
		var updatename = $('#updatename').val();
		var updategrouptype = $('#updategrouptype').children('option:selected').val();
		var updatecount = $('#updatecount').val();
		var updategroupcount = $('#updategroupcount').val();
		var chk_value =[];
		$('input[name="updatetargetbodypart"]:checked').each(function(){ 
			chk_value.push($(this).val());
		});
		updatetargetbodypart = chk_value.join(',');
		var updatetargetmuscles = $('#updatetargetmuscles').val();		
		var id = $("#outline_detail_sportitem_id").val();		
		if(updatename == '')
		{
			alert('请填写动作名称');
		}
		else if($('#updategrouptype option:selected').val() == '')
		{
			alert('请选择方式');
		}	
		else if(updatecount == '')
		{
			alert("请填写个数");
		}
		else if(isNumber(updatecount) == false)
		{
			alert('请以数字形式填写个数');
		}
		else if(parseInt(updatecount)>2147483647)
		{
			alert('个数的数字不能超过2147483647');
		}
		else if(updategroupcount == '')
		{
			alert("请填写组数");
		}
		else if(isNumber(updategroupcount) == false)
		{
			alert('请以数字形式填写组数');
		}
		else if(parseInt(updategroupcount)>2147483647)
		{
			alert('组数的数字不能超过2147483647');
		}
		else if(updatetargetbodypart == '')
		{
			alert('请选择目标部位');
		}
		else if(updatetargetmuscles == '')
		{
			alert('请填写目标肌肉,包含多个时,请用 / 隔开');
		}
		else if(updatetargetmuscles.toString().length >100)
		{
			alert('目标肌肉不超过100个字');
		}
		else
		{
			$('#modal-2').removeClass('md-show');
			//alert('add');
			if(confirm('确认修改'))
			{
				$.ajax({
					url:"__URL__/sportitemgUpdate",
					type:'post',
					data: {'updatename':updatename,'updatecount':updatecount,'updatetargetmuscles':updatetargetmuscles,'id':id,
						'updategroupcount':updategroupcount,'updategrouptype':updategrouptype,'updatetargetbodypart':updatetargetbodypart 
					},
					'datatype':'json',
					success:function(jsondata)
					{
						if(jsondata.code ==1)
						{
							//alert('修改成功');
							alert(jsondata.msg);
							window.location.reload();
						}
						if(jsondata == -1)
						{
							//alert('修改失败');
							alert(jsondata.msg);							
						}
//						if(jsondata == -1)
//						{
//							alert('动作已存在，请重新填写动作名称');
//						}
					},
				});
			}
			else
			{
				$('#modal-2').addClass('md-show');
			}		
		}
	});
});
</script>
    </div>
</div>
<div class="md-modal md-effect-1 box4" id="modal-3">
    <h2></h2>
    <div class="mainlist">
			<div class="mainlist">
        <div class="wp100wrap tcenter ft16">
            课程大纲已提交审核，请耐心等待
            <p>共有<span class="forange ft30" id="listCount"></span>个动作解析，需要您继续完善
        </div>
    </div>
    <div class="line-full save-line wp100 fleft">
        <input id="btnView" type="button" value="查&nbsp;&nbsp;&nbsp;看" class="blue md-close hand" id="close">
    </div>
    
    <script type="text/javascript">
    	$(function(){
			$("#btnView").click(function(){
				window.location.href='<?php echo U("SportitemBaseList/index");?>';
			});
       	})
    </script>
    </div>
</div>
<?php }?>

<?php
 if($addtype==6){?>
<div class="md-modal md-effect-1 box4" id="modal-3">
    <h2></h2>
    <div class="mainlist">    	
			<div class="mainlist">
        <div class="wp100wrap tcenter ft16">
            课程大纲已提交审核，请耐心等待
            <p>共有<span class="forange ft30" id="listCount"></span>个动作解析，需要您继续完善
        </div>
    </div>
    <div class="line-full save-line wp100 fleft">
        <input id="btnView" type="button" value="查&nbsp;&nbsp;&nbsp;看" class="blue md-close hand" id="close">
    </div>
    
    <script type="text/javascript">
    	$(function(){
			$("#btnView").click(function(){
				window.location.href='<?php echo U("SportitemBaseList/index");?>';
			});
       	})
    </script>
    </div>
</div>
<?php }?>

<?php
if($addtype==2){?>
<div class="md-modal md-effect-1 box4" id="modal-4">
    <h2>添加动作</h2>
    <div class="mainlist">
		    <div class="mainlist">
        <!-- 行3-->
        <div class="line-full t-line-36">
            <div class="wp100wrap  ">
                <div class="t-15-r  fleft">动作选择：</div>
                <div class="wp80 lh30 fright"  id="asportitem_base_id">
                
                </div>
            </div>
            <!-- 行2-->
            <div class="line-full t-line-36 h30">
                <div class="wp100wrap  h30">
                    <div class="t-15-r ">方式：</div>
                    <!--<input type="text" placeholder="" class="input-70-r">-->
                    <select name="agrouptype" id="agrouptype">
                    	<option value="">请选择</option>
                        <option value="1">按数量</option>
                        <option value="2">按时间</option>
                    </select>
                </div>
            </div>
            <div class="line-full t-line-36 h30">
                <div class="wp100wrap  h30">
                    <div class="t-15-r">运动量：</div>
                    <input type="text" name="acount" id="acount" />个/秒 <input type="text" name="agroupcount" id="agroupcount" /> 组
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
             	<!--
                <button id="tj" class="blue">保&nbsp;&nbsp; &nbsp; &nbsp;存</button>
                <button id="qx" class="blue">取&nbsp;&nbsp; &nbsp; &nbsp;消</button>
           		 -->
                <input id="tj" name="提交" type="button" class="blue hand" value="保&nbsp;&nbsp;&nbsp; &nbsp;存"/>
            	<input  id="qx" type="button" value="取&nbsp;&nbsp; &nbsp; &nbsp;消" class="blue hand"/>
            	 
            	<input id="stype" type="hidden" name="stype"/>
            	<input id="oid" type="hidden" name="oid"/>
            	<input id="odid" type="hidden" name="odid"/>
            	<input id="tbid" type="hidden" name="tbid"/>
            	<input id="addsort" type="hidden" name="addsort"/>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).ready(function(){
	//$(':input').labelauty();
	//动作组添加的切换按钮
	$(".spid").click(function(){
		$(this).children('.labelauty-unchecked-image').attr('class','labelauty-checked-image');
	});
	//取消按钮
	$("#qx").click(function(){
		$('#modal-4').removeClass('md-show');
		//清空
		$('#agrouptype option:selected').attr('selected',false);
		$("input[name='acount']").val('');
		$("input[name='agroupcount']").val('');
	});
	//保存按钮
	$("#tj").click(function(){
		//alert(22222);
		//动作id
//		var sportitem_base_value =[];
//		$('input[name="asportitem_base_id"]:checked').each(function(){ 
//			sportitem_base_value.push($(this).val());
//		});
//		var sportitem_base_id = sportitem_base_value.join(',');
		var sportitem_base_id = $('input[name="asportitem_base_id"]:checked').val();
		//alert(sportitem_base_id);
		//trainingplan_base_id
		var trainingplan_base_id = $("#tbid").val();
		//个数
		var acount = $("input[name='acount']").val();
		//组数
		var agroupcount = $("input[name='agroupcount']").val();
		var agrouptype = $("#agrouptype option:selected").val();
		//addsort
		var addsort = $("#addsort").val();
		if(typeof(sportitem_base_id) == 'undefined')
		{
			alert('请选择动作');
		}
		else if($("#agrouptype option:selected").val() == '')
		{
			alert('请选择方式');
		}
		else if(acount == '')
		{
			alert("请填写个数");
		}
		else if(isNumber(acount) == false)
		{
			alert('请以数字形式填写个数');
		}
		else if(parseInt(acount)>2147483647)
		{
			alert('个数的数字不能超过2147483647');
		}
		else if(agroupcount == '')
		{
			alert("请填写组数");
		}
		else if(isNumber(agroupcount) == false)
		{
			alert('请以数字形式填写组数');
		}
		else if(parseInt(agroupcount)>2147483647)
		{
			alert('组数的数字不能超过2147483647');
		}
		else
		{
			$('#modal-4').removeClass('md-show');
			//alert('add');
			if(confirm('确认添加?'))
			{
				$.ajax({
					url:"__URL__/sportitemgAdd",
					type:'post',
					data: {
						'trainingplan_base_id':trainingplan_base_id,
						'sportitem_base_id':sportitem_base_id,
						'agrouptype':agrouptype,
						'acount':acount,
						'agroupcount':agroupcount,
						'addsort':addsort
						},
					'datatype':'json',
					success:function(jsondata){
						if(jsondata.code  == -1)
						{
							//alert('动作已经选择过了');
							alert(jsondata.msg);
							$('#modal-4').addClass('md-show');
						}
						if(jsondata.code  == 1)
						{
							//alert("动作组添加成功");
							//alert(jsondata.msg);							
							window.location.reload();
							//火狐
							$('#agrouptype option:selected').attr('selected',false);
							$("input[name='acount']").val('');
							$("input[name='agroupcount']").val('');
						}
						if(jsondata.code  == -2)
						{
							//alert("动作组添加失败");
							//window.location.reload();
							alert(jsondata.msg);
						}
						
					},
				});
			}
			else
			{
				$('#modal-4').addClass('md-show');
			}
			
		}
	});	
})
</script>
    </div>
</div>
<div class="md-modal md-effect-1 box4" id="modal-5">
    <h2>修改动作</h2>
    <div class="mainlist">
		    <div class="mainlist">
        <!-- 行3-->
        <div class="line-full t-line-36">
            <div class="wp100wrap  ">
                <div class="t-15-r  fleft">动作选择：</div>
                <div class="wp80 lh30 fright"  id="usportitem_base_id">
                    <div class="fleft wp25 h50 mr20">
                    </div>                                                                             
                </div>
            </div>
            <!-- 行2-->
            <div class="line-full t-line-36 h30">
                <div class="wp100wrap  h30">
                    <div class="t-15-r ">方式：</div>
                    <!--<input type="text" placeholder="" class="input-70-r">-->
                    <select name="ugrouptype" id="ugrouptype">
                    	<option value="">请选择</option>
                        <option value="1">按数量</option>
                        <option value="2">按时间</option>
                    </select>
                </div>
            </div>
            <div class="line-full t-line-36 h30">
                <div class="wp100wrap  h30">
                    <div class="t-15-r">运动量：</div>
                    <input type="text" name="ucount" id="ucount" />个/秒 <input type="text" name="ugroupcount" id="ugroupcount" /> 组
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
             	<!--
                <button id="tj" class="blue">保&nbsp;&nbsp; &nbsp; &nbsp;存</button>
                <button id="qx" class="blue">取&nbsp;&nbsp; &nbsp; &nbsp;消</button>
           		 -->
                <input id="tjiao" name="提交" type="button" class="blue hand" value="保&nbsp;&nbsp;&nbsp; &nbsp;存"/>
            	<input  id="qxiao" type="button" value="取&nbsp;&nbsp; &nbsp; &nbsp;消" class="blue hand"/>
            	 
            	<input id="sptype" type="hidden" name="sptype"/>
            	<!--  
            	<input id="ouid" type="hidden" name="ouid"/>
            	<input id="oudid" type="hidden" name="oudid"/>
            	-->
            	<input id="btsdid" type="hidden" name="btsdid"/>
            	<input id="btbid" type="hidden" name="btbid"/>
            	<input id="usort" type="hidden" name="usort"/>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).ready(function(){
	//$(':input').labelauty();
	//查看页面
    if(<?php echo $actiontype;?> == 1)
	{
    	//禁用一些选项
		$('input[name="usportitem_base_id"]').attr('disabled',true);
		//ugrouptype
		$('#ugrouptype').attr('disabled',true);
		//ucount
		$('#ucount').attr('disabled',true);
		//ugroupcount
		$('#ugroupcount').attr('disabled',true);
		//tjiao
		$("#tjiao").addClass('none');
	}
	//取消按钮
	$("#qxiao").click(function(){
		$('#modal-5').removeClass('md-show');
	});
	//保存按钮
	$("#tjiao").click(function(){
		//alert(22222);
		//动作id
//		var sportitem_base_value =[];
//		$('input[name="addsportitem_base_id"]:checked').each(function(){ 
//			sportitem_base_value.push($(this).val());
//		});
		var btb_trainingplan_sportitemgroup_detail_id = $("#btsdid").val();
		//sportitem_base_id
		var sportitem_base_id = $('input[name="usportitem_base_id"]:checked').val();
		//alert(sportitem_base_id);
		//trainingplan_base_id
		//var trainingplan_base_id = $("#btsdid").val();
		var trainingplan_base_id = $("#btbid").val();
		//个数
		var ucount = $("input[name='ucount']").val();
		//组数
		var ugroupcount = $("input[name='ugroupcount']").val();
		var ugrouptype = $("#ugrouptype option:selected").val();
		//usort
		var usort = $("#usort").val();
		if(sportitem_base_id == '')
		{
			alert('请选择动作');
		}
		else if($("#ugrouptype option:selected").val() == '')
		{
			alert('请选择方式');
		}
		else if(ucount == '')
		{
			alert("请填写个数");
		}
		else if(isNumber(ucount) == false)
		{
			alert('请以数字形式填写个数');
		}
		else if(parseInt(ucount)>2147483647)
		{
			alert('个数的数字不能超过2147483647');
		}
		else if(ugroupcount == '')
		{
			alert("请填写组数");
		}
		else if(isNumber(ugroupcount) == false)
		{
			alert('请以数字形式填写组数');
		}
		else if(parseInt(ugroupcount)>2147483647)
		{
			alert('组数的数字不能超过2147483647');
		}
		else
		{
			//alert('add');			
			$('#modal-5').removeClass('md-show');
			if(confirm('确认保存?'))
			{
				$.ajax({
					url:"__URL__/sportitemgUpdate",
					type:'post',
					data: {
						'btb_trainingplan_sportitemgroup_detail_id':btb_trainingplan_sportitemgroup_detail_id,
						'trainingplan_base_id':trainingplan_base_id,
						'sportitem_base_id':sportitem_base_id,
						'ugrouptype':ugrouptype,
						'ucount':ucount,
						'ugroupcount':ugroupcount,
						'usort':usort
						},
					'datatype':'json',
					success:function(jsondata){
						if(jsondata.code == 1)
						{
							//alert("动作修改成功");
							alert(jsondata.msg);
							window.location.reload();
						}
						if(jsondata.code == -1)
						{
							//alert("动作修改失败");
							//window.location.reload();
							alert(jsondata.msg);
						}
//						if(jsondata == -1)
//						{
//							alert('动作已经选择过了');
//						}
					},
				});
			}
			else
			{
				$('#modal-5').addClass('md-show');
			}	
		}
	});	
})
</script>
    </div>
</div>
<?php }?>

<?php  if($addtype == 3){?>
<div class="pop-container " id="pop1">
    <div class="pop-content">
        <h2>添加批注</h2>
        <div class="mainlist">
            <!-- 行 1-->
            <!--  
            <div class="line-full wp100">
                <div class="wp100wrap tcenter">
                    <textarea placeholder="请在此输入批注……" class="comment-input"></textarea>
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
                <a href="#" class="md-trigger md-close blue mr10" id="save">保&nbsp;&nbsp; &nbsp; &nbsp;存</a>
                <a href="#" class="md-trigger md-close blue" id="close" >取&nbsp;&nbsp; &nbsp; &nbsp;消
                </a>
            </div>
            -->
            		<div class="mainlist">
			<div class="line-full wp100">
                <div class="wp100wrap tcenter">
                    <textarea placeholder="请在此输入批注……" class="comment-input" id="auditreply"><?php echo isset($trainingplanOutlineList['auditreply'])?trim($trainingplanOutlineList['auditreply']):null;?></textarea>
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
                <a href="javascript:void(0);" class="md-trigger md-close blue mr10" id="save" onclick="comment(<?php echo $trainingplanOutlineList['id'];?>);">保&nbsp;&nbsp; &nbsp; &nbsp;存</a>
                <a href="javascript:void(0);" class="md-trigger md-close blue" id="close">取&nbsp;&nbsp; &nbsp; &nbsp;消
                </a>
            </div>
          </div>
             <script type="text/javascript">
				function comment(outline_id)
				{
					$('#pop1').css('display', 'none');
					if(confirm('确认保存批注?'))
                    {
	                    var auditreply = $('#auditreply').val();
	                    if(auditreply.toString().length > 200)
	                    {
							alert('批注不超过200字');
		                }
	                    else
	                    {
	                    	//console.log(auditreply);
							$.ajax({
		               		 url:"__URL__/comment",
		            			type:'post',
		            			data: {
		            				'outline_id':outline_id,
		            				'auditreply':auditreply
		            				},
		            			'datatype':'json',
		            			success:function(jsondata){
		                    			//alert(jsondata);
		            				if(jsondata.code == 1)
		            				{
		            					//alert('保存批注成功');
		            					//window.location.reload();
		            					alert(jsondata.msg);
		            				}
		            				if(jsondata.code == -1)
		            				{
		            					//alert('保存批注失败');
		            					alert(jsondata.msg);         					
		            				}
		            			},
							});
		                }                    
                    }					
				}				
             </script>
        </div>
    </div>
</div>
<div class="pop-container " id="pop2">
    <div class="pop-content">
    	<!--  
        <div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                确定大纲无误，审核通过
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">
            <a href="javascript:void(0);" class="blue md-close">通&nbsp;&nbsp;&nbsp;过</a>
            <a class="blue md-close" id="close2">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        -->
        		<div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                确定大纲无误，审核通过
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">
            <!--  
            <a href="javascript:void(0);" class="blue md-close pass" onclick="pass(<?php ?>);">通&nbsp;&nbsp;&nbsp;过</a>
            -->
            <a href="javascript:void(0);" class="blue md-close" id="detailpass">通&nbsp;&nbsp;&nbsp;过</a> 
            <a class="blue md-close" id="close2">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        
    </div>
</div>
<div class="pop-container " id="pop3">
    <div class="pop-content">
    <!--  
        <div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                审核未通过，退件修改
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">
            <a href="javascript:void(0);" class="blue md-close">退&nbsp;&nbsp;&nbsp;件</a>
            <a class="blue md-close" id="close3">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        -->
        	<div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                审核未通过，退件修改
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">
        	<!--  
            <a href="javascript:void(0);" class="blue md-close" onclick="bounce(<?php ?>);">退&nbsp;&nbsp;&nbsp;件</a>
            -->
           <a href="javascript:void(0);" class="blue md-close" id="detailBounce">退&nbsp;&nbsp;&nbsp;件</a>
            
            <a class="blue md-close" id="close3">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        <script type="text/javascript">
//	        function bounce(outline_id)
//			{
//	        	if(confirm('确认退件?'))
//                {
                    //var auditreply = $('#auditreply').val();
                    //console.log(auditreply);
//					$.ajax({
//               		 url:"__URL__/outlineBounce",
//            			type:'post',
//            			data: {
//            				'outline_id':outline_id,
//            				'auditreply':auditreply
//            				},
//            			'datatype':'json',
//            			success:function(jsondata){
//                    			//alert(jsondata);
//            				if(jsondata == 1)
//            				{
//            					alert('保存批注成功');
//            					//window.location.reload();
//            				}
//            				if(jsondata == 0)
//            				{
//            					alert('保存批注失败');            					
//            				}	
//            			},
////					});
//                }
//			}
		</script>
        
    </div>
</div>
<div class="md-modal md-effect-1 box4" id="modal-2">
    <h2>查看动作</h2>
    <div class="mainlist">
		    <div class="mainlist">
        <!-- 行 1-->
        <div class="line-full t-line-36 h30">
            <div class="wp100wrap  h30">
                <div class="t-15-r">名称：</div>
                <input type="text" id="updatename" name="updatename" placeholder="" class="input-50-r">
            </div>
        </div>
        <div class="line-full t-line-36 h30">
            <div class="wp100wrap  h30">
                <div class="t-15-r">方式：</div>
                <select class="wp50" name="updategrouptype" id="updategrouptype">
                	<option value="">请选择</option>
                    <option value="1">按数量</option>
                    <option value="2">按时间</option>
                </select>
            </div>
        </div>
        <!-- 行2-->
        <div class="line-full t-line-36 h30">
            <div class="wp100wrap  h30">
                <div class="t-15-r">运动量：</div>
                <input type="text" name="updatecount" placeholder="" class="wp21" id="updatecount" />个/秒
                <input type="text" name="updategroupcount" placeholder="" class="wp21" id="updategroupcount" />组
            </div>
        </div>
        <!-- 行3-->
        <div class="line-full t-line-36">
            <div class="wp100wrap  ">
                <div class="t-15-r  fleft">目标部位：<br>（可多选）&nbsp;</div>
                <div class="wp80 lh30 fright">
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="肩部" class="chk_3" value="肩部" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="上臂" class="chk_3" value="上臂" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="前臂" class="chk_3" value="前臂" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="背部" class="chk_3" value="背部" />

                    </div>

                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="胸部" class="chk_3" value="胸部" />

                    </div>

                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="腹部" class="chk_3" value="腹部" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="臀部" class="chk_3" value="臀部" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="大腿" class="chk_3" value="大腿" />

                    </div>
                    <div class="fleft wp25 h50 mr20">
                        <input type="checkbox" name="updatetargetbodypart" data-labelauty="小腿" class="chk_3" value="小腿" />
                    </div>
                </div>
            </div>
        </div>
         <!--
        <div class="line-full t-line-36 h30">
        -->
         <div class="line-full t-line-36">
        <!--  
            <div class="wp100wrap  h30">
        -->
        	<div class="wp100wrap">
                <div class="t-15-r">目标肌肉：</div>
                <!--  
                <input type="text" placeholder="" class="input-50-r" name="updatetargetmuscles" id="updatetargetmuscles"/>&nbsp;&nbsp;
                -->
                
                	<div class="input-50-r" style="height:auto;text-indent: 0px;" id="updatetargetmuscles"></div>
                
                <a href="<?php echo U('MuscleReference/index');?>" class="instrument-name" target="_blank">肌肉名称参考</a>
            </div>
        </div>
        <div class=" fleft wp100 h50 line-full save-line">
        	<!--  
            <button class="md-trigger md-close blue" data-modal="modal-2">保&nbsp;&nbsp; &nbsp; &nbsp;存</button>
            <button class="md-trigger md-close blue" data-modal="modal-2">取&nbsp;&nbsp; &nbsp; &nbsp;消</button>
            -->
            <input id="subm" name="提交" type="button" class="blue hand" value="保&nbsp;&nbsp;&nbsp; &nbsp;存"/>
            <input  id="cance" type="button" value="取&nbsp;&nbsp; &nbsp; &nbsp;消" class="blue hand"/>
            <input id="outline_detail_sportitem_id" type="hidden" name="outline_detail_sportitem_id"/>
        </div>
    </div>
<script type="text/javascript">
$(function(){
	
    //隐藏保存按钮
	$('#subm').addClass('none');
	//禁用一些选项
	$('#updategrouptype').attr('disabled',true);
	//updatecount
	$('#updatecount').attr('disabled',true);
	//updategroupcount
	$('#updategroupcount').attr('disabled',true);
	//updatetargetbodypart
	$('input[name="updatetargetbodypart"]').attr('disabled',true);
	//updatetargetmuscles
	//$('#updatetargetmuscles').attr('disabled',true);
   	
	$('#updatename').attr('disabled',true);
	//$(':input').labelauty();
	//取消按钮
	$("#cance").click(function(){
//		$("#updatename").val("");
//		//$("#updatecount").val("");
//		$('input[name="updatetargetmuscles"]:checked').attr('checked',false);
		$("#modal-2").removeClass('md-show');
		$('input[name="updatetargetbodypart"]:checked').attr('checked',false);
	});
});
</script>
    </div>
</div>
<?php }?>
<?php  if($addtype == 4){?>
<div class="pop-container " id="pop1">
    <div class="pop-content">
        <h2>添加批注</h2>
        <div class="mainlist">
            <!-- 行 1-->
            <!--  
            <div class="line-full wp100">
                <div class="wp100wrap tcenter">
                    <textarea placeholder="请在此输入批注……" class="comment-input"></textarea>
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
                <a href="#" class="md-trigger md-close blue mr10" id="save">保&nbsp;&nbsp; &nbsp; &nbsp;存</a>
                <a href="#" class="md-trigger md-close blue" id="close" >取&nbsp;&nbsp; &nbsp; &nbsp;消
                </a>
            </div>
            -->
            		<div class="mainlist">
			<div class="line-full wp100">
                <div class="wp100wrap tcenter">
                    <textarea placeholder="请在此输入批注……" class="comment-input" id="auditreply"><?php echo isset($sportitemBaseList['auditreply'])?trim($sportitemBaseList['auditreply']):null;?></textarea>
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
                <a href="javascript:void(0);" class="md-trigger md-close blue mr10" id="save" onclick="comment(<?php echo $sportitemBaseList['id'];?>);">保&nbsp;&nbsp; &nbsp; &nbsp;存</a>
                <a href="javascript:void(0);" class="md-trigger md-close blue" id="close">取&nbsp;&nbsp; &nbsp; &nbsp;消
                </a>
            </div>
          </div>
             <script type="text/javascript">
				function comment(sportitem_base_id)
				{
					$('#pop1').css('display', 'none');
					if(confirm('确认保存批注?'))
                    {
	                    var auditreply = $('#auditreply').val();
	                    var sportitem_base_id = sportitem_base_id;
	                    if(auditreply.toString().length > 200)
	                    {
							alert('批注不超过200字');
		                }
	                    else
	                    {
	                    	$.ajax({
	   	               		 url:"__URL__/sportitemBaseComment",
	   	            			type:'post',
	   	            			data: {
	   	            				'sportitem_base_id':sportitem_base_id,
	   	            				'auditreply':auditreply
	   	            				},
	   	            			'datatype':'json',
	   	            			success:function(jsondata){
	   	                    			//alert(jsondata);
	   	            				if(jsondata.code == 1)
	   	            				{
	   	            					//alert('保存批注成功');
	   	            					alert(jsondata.msg);
	   	            					//window.location.reload();
	   	            				}
	   	            				if(jsondata.code == -1)
	   	            				{
	   	            					//alert('保存批注失败');
	   	            					alert(jsondata.msg);         					
	   	            				}	
	   	            			},
	   						});
	                    }						
                    }
				}				
             </script>
        </div>
    </div>
</div>
<div class="pop-container " id="pop2">
    <div class="pop-content">
    	<!--  
        <div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                确定大纲无误，审核通过
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">
            <a href="javascript:void(0);" class="blue md-close">通&nbsp;&nbsp;&nbsp;过</a>
            <a class="blue md-close" id="close2">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        -->
        		<div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                确定动作无误，审核通过
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">
            <!--  
            <a href="javascript:void(0);" class="blue md-close pass" onclick="pass(<?php ?>);">通&nbsp;&nbsp;&nbsp;过</a>
            -->
            <a href="javascript:void(0);" class="blue md-close" id="sportitemBasepass">通&nbsp;&nbsp;&nbsp;过</a> 
            <a class="blue md-close" id="close2">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        
    </div>
</div>
<div class="pop-container " id="pop3">
    <div class="pop-content">
    <!--  
        <div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                审核未通过，退件修改
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">
            <a href="javascript:void(0);" class="blue md-close">退&nbsp;&nbsp;&nbsp;件</a>
            <a class="blue md-close" id="close3">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        -->
        	<div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                审核未通过，退件修改
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">
        	<!--  
            <a href="javascript:void(0);" class="blue md-close" onclick="bounce(<?php ?>);">退&nbsp;&nbsp;&nbsp;件</a>
            -->
           <a href="javascript:void(0);" class="blue md-close" id="sportitemBaseBounce">退&nbsp;&nbsp;&nbsp;件</a>
            
            <a class="blue md-close" id="close3">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        
    </div>
</div>
<?php }?>
<?php  if($addtype == 5){?>
<div class="pop-container " id="pop1">
    <div class="pop-content">
        <h2>添加批注</h2>
        <div class="mainlist">
            <!-- 行 1-->
            <!--  
            <div class="line-full wp100">
                <div class="wp100wrap tcenter">
                    <textarea placeholder="请在此输入批注……" class="comment-input"></textarea>
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
                <a href="#" class="md-trigger md-close blue mr10" id="save">保&nbsp;&nbsp; &nbsp; &nbsp;存</a>
                <a href="#" class="md-trigger md-close blue" id="close" >取&nbsp;&nbsp; &nbsp; &nbsp;消
                </a>
            </div>
            -->
            		<div class="mainlist">
			<div class="line-full wp100">
                <div class="wp100wrap tcenter">
                    <textarea placeholder="请在此输入批注……" class="comment-input" id="auditreply"><?php echo isset($trainingplanBaseList['auditreply'])?trim($trainingplanBaseList['auditreply']):null;?></textarea>
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
                <a href="javascript:void(0);" class="md-trigger md-close blue mr10" id="save" onclick="comment(<?php echo $trainingplanBaseList['id'];?>);">保&nbsp;&nbsp; &nbsp; &nbsp;存</a>
                <a href="javascript:void(0);" class="md-trigger md-close blue" id="close">取&nbsp;&nbsp; &nbsp; &nbsp;消
                </a>
            </div>
          </div>
             <script type="text/javascript">
				function comment(trainingplan_base_id)
				{
					$('#pop1').css('display', 'none');
					if(confirm('确认保存批注?'))
                    {
	                    var auditreply = $('#auditreply').val();
	                    var trainingplan_base_id = trainingplan_base_id;
	                    if(auditreply.toString().length > 200)
	                    {
							alert('批注不超过200字');
		                }
	                    else
	                    {		
	                    	$.ajax({
	   	               		 url:"__URL__/trainingplanBaseComment",
	   	            			type:'post',
	   	            			data: {
	   	            				'trainingplan_base_id':trainingplan_base_id,
	   	            				'auditreply':auditreply
	   	            				},
	   	            			'datatype':'json',
	   	            			success:function(jsondata){
	   	                    			//alert(jsondata);
	   	            				if(jsondata.code == 1)
	   	            				{
	   	            					//alert('保存批注成功');
	   	            					alert(jsondata.msg);
	   	            					//window.location.reload();
	   	            				}
	   	            				if(jsondata.code == -1)
	   	            				{
	   	            					//alert('保存批注失败');  
	   	            					alert(jsondata.msg);         					
	   	            				}	
	   	            			},
	   						});
	                    }					
                    }
				}				
             </script>
        </div>
    </div>
</div>
<div class="pop-container " id="pop2">
    <div class="pop-content">
    	<!--  
        <div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                确定大纲无误，审核通过
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">
            <a href="javascript:void(0);" class="blue md-close">通&nbsp;&nbsp;&nbsp;过</a>
            <a class="blue md-close" id="close2">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        -->
        		<div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                确定方案无误，审核通过
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">          
            <a href="javascript:void(0);" class="blue md-close" id="trainingplanBasePass">通&nbsp;&nbsp;&nbsp;过</a> 
            <a class="blue md-close" id="close2">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        
    </div>
</div>
<div class="pop-container " id="pop3">
    <div class="pop-content">
    <!--  
        <div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                审核未通过，退件修改
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">
            <a href="javascript:void(0);" class="blue md-close">退&nbsp;&nbsp;&nbsp;件</a>
            <a class="blue md-close" id="close3">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        -->
        	<div class="mainlist">
            <div class="wp100wrap tcenter ft16 mt30">
                审核未通过，退件修改
            </div>
        </div>
        <div class="line-full save-line wp100 fleft">        	
           <a href="javascript:void(0);" class="blue md-close" id="trainingplanBaseBounce">退&nbsp;&nbsp;&nbsp;件</a>
            
            <a class="blue md-close" id="close3">取&nbsp;&nbsp;&nbsp;消</a>
        </div>
        
    </div>
</div>
<div class="md-modal md-effect-1 box4" id="modal-5">
    <h2>查看动作</h2>
    <div class="mainlist">
		    <div class="mainlist">
        <!-- 行3-->
        <div class="line-full t-line-36">
            <div class="wp100wrap  ">
                <div class="t-15-r  fleft">动作选择：</div>
                <div class="wp80 lh30 fright"  id="usportitem_base_id">
                    <div class="fleft wp25 h50 mr20">
                    </div>                                                                             
                </div>
            </div>
            <!-- 行2-->
            <div class="line-full t-line-36 h30">
                <div class="wp100wrap  h30">
                    <div class="t-15-r ">方式：</div>
                    <!--<input type="text" placeholder="" class="input-70-r">-->
                    <select name="ugrouptype" id="ugrouptype">
                    	<option value="">请选择</option>
                        <option value="1">按数量</option>
                        <option value="2">按时间</option>
                    </select>
                </div>
            </div>
            <div class="line-full t-line-36 h30">
                <div class="wp100wrap  h30">
                    <div class="t-15-r">运动量：</div>
                    <input type="text" name="ucount" id="ucount" />个/秒 <input type="text" name="ugroupcount" id="ugroupcount" /> 组
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
             	<!--
                <button id="tj" class="blue">保&nbsp;&nbsp; &nbsp; &nbsp;存</button>
                <button id="qx" class="blue">取&nbsp;&nbsp; &nbsp; &nbsp;消</button>
           		 -->
                <input id="tjiao" name="提交" type="button" class="blue hand" value="保&nbsp;&nbsp;&nbsp; &nbsp;存"/>
            	<input  id="qxiao" type="button" value="取&nbsp;&nbsp; &nbsp; &nbsp;消" class="blue hand"/>
            	 
            	<input id="sptype" type="hidden" name="sptype"/>
            	<!--  
            	<input id="ouid" type="hidden" name="ouid"/>
            	<input id="oudid" type="hidden" name="oudid"/>
            	-->
            	<input id="btsdid" type="hidden" name="btsdid"/>
            	<input id="btbid" type="hidden" name="btbid"/>
            	<input id="usort" type="hidden" name="usort"/>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).ready(function(){
	//$(':input').labelauty();   
    //禁用一些选项
	$('input[name="usportitem_base_id"]').attr('disabled',true);
	//ugrouptype
	$('#ugrouptype').attr('disabled',true);
	//ucount
	$('#ucount').attr('disabled',true);
	//ugroupcount
	$('#ugroupcount').attr('disabled',true);
	//tjiao
	$("#tjiao").addClass('none');	
	//取消按钮
	$("#qxiao").click(function(){
		$('#modal-5').removeClass('md-show');
	});	
})
</script>
    </div>
</div>
<?php }?>
            <div class="bgwrap">
             <!-- 左菜单 开始-->
                 <!-- 左菜单 开始-->
                <div class="menu-left-warp">
                    <div class="logo">
                        <div class="t1">
                            BTB课程设计平台
                        </div>
                    </div>
                    <div class="menu-left">
                        <ul>
              <!-- on 选中状态-->
                            <li class="l1 <?php echo $headtype==1?'on':'';?>">
                                <a href="<?php echo $coachtype==1?U('OutlineList/index'):U('OutlineCheckList/index?auditstatus=1');?>" class="sicon1" >
                                    课程大纲
                                </a>
                            </li>
                            <li class="l2 <?php echo $headtype==2?'on':'';?>">
                                <a href="<?php echo $coachtype==1?U('SportitemBaseList/index'):U('SportitemBaseCheckList/index?auditstatus=1');?>"  class="sicon2" >
                                   动作库
                                </a>
                            </li>
                            <li class="l3 <?php echo $headtype==3?'on':'';?>">
                                <a href="<?php echo $coachtype==1?U('TrainingplanBaseList/index'):U('TrainingplanBaseCheckList/index?status=1');?>" class="sicon3" >
                                    课程设计
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <script type="text/javascript">         
                //导航栏选中状态
//				  var urlstr = location.href;
//				  var urlstatus = false;
				 // $(".menu-left a").each(function(){
//					    if((urlstr + '/').indexOf($(this).attr('href')) > -1 && $(this).attr('href')!='') 
//						{
//					      	$(this).parent("li").addClass('on'); 
//					      	urlstatus = true;
//					    }
//					    else
//						{
//					      	$(this).parent("li").removeClass('on');
//					    }

//				if((urlstr + '/').indexOf('Outline') > -1) 
//				{
//			      	$('.l1').addClass('on'); 
//			      	urlstatus = true;
//			    }
//				if((urlstr + '/').indexOf('SportitemBase') > -1)
//				{
//					$('.l2').addClass('on'); 
//			      	urlstatus = true;
//				}
//				if((urlstr + '/').indexOf('TrainingplanBase') > -1)
//				{
//					$('.l3').addClass('on'); 
//			      	urlstatus = true;
//				}
//				  if(!urlstatus)
//				  {
//					  $(".menu-left li").eq(0).addClass('on'); 
//				  }
				</script>
 

                <!-- 左菜单 结束 左结束-->
                <!-- 右全部内容开始 开始-->
                <div class="menu-right-warp">
                     <!-- 右头部 开始-->
     			                  
                                <div class="top-right-warp">
                        <div class="line-full">
                            <div class="top-right-menu">
                               
                               
                               <nav class="nav">
	<!--  
	<menu class="menu1">
		<li>
			<a href="#"><span> <img src="__PUBLICROOT__/TrainingManage/images/home1.png" width="17" height="19"></span>
				<span >首页</span>
			</a>
		</li>
		<li>
			<a href="#">
			<span><img src="__PUBLICROOT__/TrainingManage/images/l1.png" width="17" height="17"></span>
				<span>用户管理</span>
			</a>
		</li>
		<li  class="just">
			<a href="#">
				<span> <img src="__PUBLICROOT__/TrainingManage/images/l2.png" width="14" height="20"></span>
				<span>课程管理</span>
			</a>
		</li>
		<li>
			<a href="#">
				<span> <img src="__PUBLICROOT__/TrainingManage/images/l3.png" width="20" height="20"></span>
				<span>动作管理</span>
			</a>
		</li>
        <li>
			<a href="#">
				<span> <img src="__PUBLICROOT__/TrainingManage/images/l4.png" width="18" height="18"></span>
				<span>设置</span>
			</a>
		</li>
	</menu>
	-->
	<div class="ribbon left"></div>
	<div class="ribbon right"></div>
</nav>                                                
                                                           </div>
                            <div class="fright">
                                <a class="login-out" href="">
                                    <div id="logout" class="t1">
                                         &nbsp;&nbsp;注销
                                    </div>
                                </a>
                                <div class="t2">
                                    欢迎您，<?php echo $LoginInfo['name'];?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 右头部 结束-->
 <script type="text/javascript">
 	$(function(){
		$(".login-out").click(function(){
			$(this).attr('href','<?php echo U("Login/logout");?>');
		});
 	 })
 </script>
                    <!-- 右头部 结束-->
		           <!-- 内容开始-->
		                  <!-- 内容开始-->
        <div class="line-full content-wrap">
            <div class="line-full t-position">
                <span>当前位置：</span>
                <span>课程管理</span>
                <!-- <span>&gt;</span>
                <span>用户管理</span> -->
            </div>
            <!-- 蓝包开始2  table  -->
            <div class="cls_tab_nav">
                <ul>
                    <li class="cls_tab_nav_li <?php echo $auditstatus==''?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst('');">全部</a></li>
                    <li class="cls_tab_nav_li <?php echo $auditstatus=='2'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(2);">已审核</a></li>
                    <li class="cls_tab_nav_li <?php echo $auditstatus=='1'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(1);">审核中</a></li>
                    <li class="cls_tab_nav_li <?php echo $auditstatus=='-1'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(-1);">未通过</a></li>
                    <li class="cls_tab_nav_li <?php echo $auditstatus=='0'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(0);">未提交</a></li>
                </ul>
                <div class="fright-o none"><a href="javascript:void(0);">新建</a></div>
            </div>
            <div class="line-full content-blue">
                <div class="line-full">
                    <div class="wp96auto">
                    </div>
                </div>
                <div class="line-full content posr">
                    <div class="loading2  none mt-12"></div>
                    <div class="loading mt-12 none">处理中</div>
                    <div class="wp96auto">
                        <!-- table 包-->
                        <table class="table-100">
                            <colgroup>
                                <!--	1	 -->
                                <col width="" align="" class="wp15">
                                <!--	4	 -->
                                <col width="" align="" class="wp15">
                                <!--	5	 -->
                                <col width="" align="" class="wp14">
                                <!--	6	 -->
                                <col width="" align="" class="wp14">
                                <!--	7	 -->
                                <col width="" align="" class="wp14">
                                <!--	8	 -->
                                <col width="" align="" class="wp20">
                            </colgroup>
                            <thead class="tcenter">
                            <td>动作名称</td>
                            <td>动作来源</td>
                            <td>审核状态</td>
                            <td>创建日期</td>
                            <td>审核时间</td>
                            <td>操作</td>
                            </thead>
                            <tbody class="tcenter">
                            <tr class="tr-blank">
                                <td colspan="6"></td>
                            </tr>
                          <?php if(isset($sportitemBaseList)){foreach($sportitemBaseList as $sbList){?>
							<tr>
                                <td class="lihidden"><?php echo $sbList['name'];?></td>
                                <td class="lihidden"><?php echo $sbList['source'];?></td>
                                <td class="<?php echo $sbList['auditstatus']==-1?'fred':'';?>"><?php  switch ($sbList['auditstatus']) { case 0: echo '未提交 '; break; case 1: echo '审核中'; break; case 2: echo '已审核'; break; case -1: echo '未通过'; break; } ?></td>
                                <td><?php echo date('Y-m-d H:i',strtotime($sbList['obj_createdate']));?></td>
                                <td><?php  if($sbList['auditdate'] != '') { echo date('Y-m-d H:i',strtotime($sbList['auditdate'])); } else { echo '--'; } ;?></td>
                                <td>                                    
			                <!--  
			                0未提交 1审核中 2 已审核  -1 审核未通过
			                	未提交   只能编辑
			                	审核中  可以查看和编辑
			                	已审核   只能查看
			                -->
			                <!--  
			                <a href="<?php  ?>" class="a1">查看</a>
			                -->
		                	<?php if( $sbList['auditstatus'] == 0 ) { echo '<a href="" class="a1 none">查看</a>'; } else { echo '<a href=" '; echo U('SportitemBaseList/view', array('sportitem_base_id'=>$sbList['id'])); echo ' " class="a1">查看</a>'; } ?>
			                		                
			                <?php if( $sbList['auditstatus'] == 2 ) { echo '<a href="" class="a1 none">编辑</a>'; } else { echo '<a href=" '; echo U('SportitemBaseList/update', array('sportitem_base_id'=>$sbList['id'])); echo ' " class="a1">编辑</a>'; } ?>			                
			                </td>                                
                            </tr>                
                            <?php }}?>
                            <!--  
                            <tr>
                                <td>分腿俯卧撑</td>


                                <td>竖脊肌，斜方肌</td>
                                <td>待审核</td>
                                <td>2016/03/09 15:31</td>
                                <td>2016/03/09 15:31</td>
                                <td>
                                    <a href="" class="a1">查看</a>
                                    <a href="" class="a1">编辑</a>
                                    <a href="" class="a1">提交</a>
                                </td>
                            </tr>
							-->
                            </tbody>
                        </table>
                        <!-- 分页符开始 --> <!-- pagechoosen 为当前页样式-->
					<div class="thepage-wrap">
                        <span class="total">共<?php echo $totalcount;?>条记录</span>                        							 							                        
                        <div class="thepage fright" >
                        <?php echo $page; ?>                        	
                            <input type="hidden" name="pageIndex" id="pageIndex"/>                           
                        </div>                    							                                                                             
                    </div>                      
                        <!-- 分页符结束 -->
                    </div>
                </div>
            </div>
            <!-- 蓝包结束2 table-->
        </div>
        <!-- 内容结束-->
        <!-- <div class="line-full copyright">

           公司版权所有<br>公司版权所有@公司版权所有@公司版权所有@公司版权所有@

         </div> -->
    <!-- 右全部内容 结束-->

<script>
    $(function () {
      //  var lheight = $(".menu-right-warp").height();

     //   $(".menu-left-warp").css("min-height", lheight);


        //$.fn.TableLock({table: 'lockTable', lockRow: 1, lockColumn: 2, width: '100%', height: '300px'});

//        var auditstatus = "<?php ?>";
//		if(auditstatus == '')
//		{
//			$("#first1").addClass('cls_tab_nav_li_first');
//		}
//		if(auditstatus == '2')
//		{
//			$("#first2").addClass('cls_tab_nav_li_first');
//		}
//		if(auditstatus == '1')
//		{
//			$("#first3").addClass('cls_tab_nav_li_first');
//		}
//		if(auditstatus == '-1')
//		{
//			$("#first4").addClass('cls_tab_nav_li_first');
//		}
//		if(auditstatus == '0')
//		{
//			$("#first5").addClass('cls_tab_nav_li_first');
//		}
    });
	//点击跳转
    function addFirst(auditstatus)
	{    	
    	//console.log($(obj).html());
		var url = "<?php echo U('SportitemBaseList/index',array('auditstatus'=>'auditstatusVal'));?>".replace('auditstatusVal',auditstatus);
		window.location.href = url;
		//$(obj).parent('li').addClass('cls_tab_nav_li_first');
	}
//    function commit(id)
//    {
//    	if(confirm('确认提交?'))
//        {
//       	//alert('hfjk');
//       	 $.ajax({
//       		 url:"__URL__/sportitemBaseCommit",
//    			type:'post',
//    			data: {
//       				'sportitem_base_id':id
//    				},
//    			'datatype':'json',
//    			success:function(jsondata){
//            			//alert(jsondata);
//    				if(jsondata == 1)
//    				{
//    					alert('提交成功');
//    					window.location.reload();
//    				}
//    				if(jsondata == 0)
//    				{
//    					alert('提交失败');
//    					//window.location.reload();
//    				}	
//    			},
//			});
//        } 
//    }
    
</script>
<style type="text/css">
                 	.content-blue .thepage-wrap {
				margin:10px auto ;
				width:96%;
			
			}

			.content-blue .thepage,.content-blue1 .thepage-wrap {
				 margin:0px auto;
				 display:inline-block;
				 margin-left:280px;
			
			 }

			.thepage a { display:inline-block;padding:3px 10px; height:22px; line-height:24px; color:#000;}
			.thepage a.on,.thepage a:hover{ background:#47b4a7;color:#fff;}
			.lihidden{
overflow: hidden; white-space: nowrap; text-overflow: ellipsis
}
</style>
		          <!-- 内容结束-->
                   <!-- <div class="line-full copyright">

                      公司版权所有<br>公司版权所有@公司版权所有@公司版权所有@公司版权所有@

                    </div> -->


                     </div>
                     <!-- 右全部内容 结束-->
                     
                     
                 </div>
                 
                 <div class="md-overlay <?php echo $addtype == 6?'none':'';?>"></div>
                                
               <script type="text/javascript">
                     $(function(){
                    	 //$(':input').labelauty();
                          // var lheight=$(".menu-right-warp").height();
							
                         //  $(".menu-left-warp").css("min-height",lheight);


                         // $.fn.TableLock({table:'lockTable',lockRow:1,lockColumn:2,width:'100%',height:'300px'});
                     });
                 </script>
              </body>
          </html>