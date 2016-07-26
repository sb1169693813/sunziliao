<!-- 内容开始-->
        <div class="line-full content-wrap">
            <div class="line-full t-position">
                <span>当前位置：</span>
                <span>课程管理</span>
                <!-- <span>&gt;</span>
                <span>用户管理</span> -->
            </div>
            <!-- 蓝包开始1 -->
            <div class="line-full content-blue1">
                <div class="line-full">


                    <div class="wp96auto h40 mt20 ft14 fgree1 fleft">

                        <span id="on">1</span> <span class="w130 fleft"> <a href="javascript:void(0);">大纲基本属性 >> </a> </span>
                        <span id="circle">2</span> <span class="w130 fleft"> <a class="fgray" id="actionList" href="javascript:void(0);" onclick="doOutlineDetailsportitemgroup();">大纲动作列表 >> </a> </span>

                    </div>
                         <form name="MainForm" method="post" id="main_form" enctype="multipart/form-data">
                        <div class="whiteline border-b fleft mb20"></div>
                        <div class="line-full content">
                            <div class="wp96auto">
                            <!-- 行 0-->
                            	<div class="line-full <?php echo isset($trainingplanOutlineList['auditreply'])?'':'none';?>">
                                    <div class="wp100wrap ">
                                        <div class="t-55-r">审核批注：</div>
                                        <div class="input-50-r fred " style="height:auto;text-indent: 0px;"><?php echo isset($trainingplanOutlineList['auditreply'])?trim($trainingplanOutlineList['auditreply']):null;?></div>
                                    </div>
                                </div>
                                <!-- 行 1-->
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">专题名称：</div>
                                        <input id ="name" name="name" type="text" placeholder="" class="input-50-r" value="<?php echo isset($trainingplanOutlineList['name'])?trim($trainingplanOutlineList['name']):null;?>"/>
                                    </div>
                                </div>	
                                <!-- 行2-->			
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">课程类型：</div>
                                        <div class="input-50-r">
                                            <div class="sel-01 line-full">
                                                <!--<span class="on-select"></span>-->
                                                <select name="type" id="type">
				                               		<option value="">请选择</option>  
				                              		<option value="1">徒手训练</option>
				                            		<option value="2">健身房设备</option>
				                            		<option value="3">家庭器械</option>
				                            		<option value="4">HIIT</option>
				                            		<option value="5">体育舞蹈</option>
				                            		<option value="6">特殊小器械</option>
				                            		<option value="7">Cross fit</option>
				                            	</select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <!-- 行3-->
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  ">
                                        <div class="t-55-r">使用器械：</div>
                                        <input type="text" id="useequipment" name="useequipment" value="<?php echo isset($trainingplanOutlineList['useequipment'])?trim($trainingplanOutlineList['useequipment']):null;?>" class="input-50-r">&nbsp;&nbsp;
                                        <a href="<?php echo U('InstrumentReference/index');?>" class="instrument-name" target="_blank" >器械名称参考</a><br>
                                        <span style="padding-left: 290px;font-size:12px; color:#aaa;">包含多个时，请用 / 隔开</span>
                                    </div>
                                </div>
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">难易程度：</div>
                                        <div class="input-50-r">
                                            <div class="sel-01 line-full">
                                                <!--<span class="on-select"></span>-->
                                                <select name="level" id="level">
					                               	<option value="">请选择</option>
					                               	<option value="1">入门级</option>
					                              	<option value="2">初级</option>
					                            	<option value="3">中级</option>
					                            	<option value="4">高级</option>
					                            	<option value="5">挑战级</option>
					                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 行4-->
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">课程重点：</div>
                                        <div class="input-50-r">
                                            <div class="sel-01 line-full">
                                                <!--<span class="on-select"></span>-->
                                                <select name="bodypart" id="bodypart">
					                              	<option value="">请选择</option>
					                              	<option value="1">体适能训练</option>
					                            	<option value="2">全身偏上肢</option>
					                            	<option value="3">全身偏下肢</option>
					                            	<option value="4">全身偏躯干</option>
					                            	<option value="5">上肢下肢</option>
					                            	<option value="6">上肢躯干</option>
					                            	<option value="7">躯干下肢</option>
					                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- 行5-->

                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">课程数量：</div>
                                        <input name="daycount" id="daycount" type="text" value="<?php echo isset($trainingplanOutlineList['daycount'])?trim($trainingplanOutlineList['daycount']):null;?>" class="input-50-r">&nbsp;&nbsp;节
                                    </div>
                                </div>


                                <div class="line-full save-line">
                                	<!--  
                                    <a href="" class="blue">下&nbsp;&nbsp;一&nbsp;&nbsp;步</a>
                                	-->
                                	<input id="bjsubmit"  name="提交" type="button" class="blue hand" value="下&nbsp;&nbsp;一&nbsp;&nbsp;步"/>
                                	<input id="cksubmit"  name="提交" type="button" class="blue hand" value="下&nbsp;&nbsp;一&nbsp;&nbsp;步"/>
                                	<input id="xjsubmit"  name="提交" type="button" class="blue hand" value="下&nbsp;&nbsp;一&nbsp;&nbsp;步"/>
                                	<input id="hiddenoutline_id"  name="outline_id" type="hidden"  value="<?php echo isset($trainingplanOutlineList['id'])?trim($trainingplanOutlineList['id']):null;?>"/>
                                	<input id="hiddeday"  name="day" type="hidden"  value="<?php echo isset($_GET['day'])?trim($_GET['day']):1;?>"/>                                	
                                </div>

                            </div>
                        </div>

                        <!-- 蓝包结束1-->
                    </form>
                </div>
            </div>
            <!-- 内容结束-->
            <!-- <div class="line-full copyright">

               公司版权所有<br>公司版权所有@公司版权所有@公司版权所有@公司版权所有@

             </div> -->

        </div>
        
        <script type="text/javascript">
$(function(){
//	$('select').change(function(){
//		$html = $(this).children('option:selected').html();
//		//console.log($html);
//		//$(this).prev(".on-select").html($html);
//	});
	$("#type option").each(function(){
		if($(this).val() == "<?php echo isset($trainingplanOutlineList['type'])?trim($trainingplanOutlineList['type']):'';?>")
		{
			//console.log($(this).val());
			$(this).attr('selected',true);
//			$html = $(this).html();
//			$(this).parents('select').prev(".on-select").html($html);
		}
	});
	$("#level option").each(function(){
		if($(this).val() == "<?php echo isset($trainingplanOutlineList['level'])?trim($trainingplanOutlineList['level']):'';?>")
		{
			//console.log($(this).val());
			$(this).attr('selected',true);
		}
	});
	$("#bodypart option").each(function(){
		if($(this).val() == "<?php echo isset($trainingplanOutlineList['bodypart'])?trim($trainingplanOutlineList['bodypart']):'';?>")
		{
			//console.log($(this).val());
			$(this).attr('selected',true);	
		}
	});
	//查看页面1
	if(<?php echo $actiontype;?> == 1)
	{
		//name
		$("#name").attr('disabled',true);
		//type
		$("#type").attr('disabled',true);
		//useequipment
		$("#useequipment").attr('disabled',true);
		//level
		$("#level").attr('disabled',true);
		//bodypart
		$("#bodypart").attr('disabled',true);
		//daycount
		$("#daycount").attr('disabled',true);
		//隐藏编辑和新建的下一步
		$("#bjsubmit").addClass("none");
		$("#xjsubmit").addClass("none");
		$("#cksubmit").click(function(){
			//outline_id
			//var outline_id = $("#hiddenoutline_id").val();
			//var daycount = $("#daycount").val();
			var url = "<?php  echo U('OutlineDetailsportitemgroup/index',array('actiontype'=>1,'outline_id'=>$outline_id));?>";	
			window.location.href = url;
		});
	}
	
	//编辑页面2
	if(<?php echo $actiontype;?> == 2)
	{
		//name
		//$("#name").attr('disabled',true);
		//daycount
		$("#daycount").attr('disabled',true);
		//隐藏查勘和新建的下一步
		$("#cksubmit").addClass("none");
		$("#xjsubmit").addClass("none");
		//下一步按钮
		$("#bjsubmit").click(function(){
			//name
			var name = $("#name").val();
			//outline_id
			var outline_id = $("#hiddenoutline_id").val();
			//console.log(outline_id);
			//课程类型
			var type = $('#type').val();
			//使用器械
			var useequipment = $('#useequipment').val();
			//难易程度
			var level = $('#level').val();
			//课程重点
			var bodypart = $('#bodypart').val();
			//课程数量
			var daycount = $('#daycount').val();			
			if(name=="")
			{
				alert('请填写专题名称');
			}
			else if(name.toString().length >10)
			{
				alert('专题名称不超过10个字');
			}
			else if(type=='')
			{
				alert('请选择课程类型');
			}
			else if(useequipment == '')
			{
				alert('请填写使用器械,包含多个时,请用 / 隔开');		
			}
			else if(useequipment.toString().length > 100)
			{
				alert('使用器械不超过100个字');
			}
//			else if(useequipment.indexOf('/')==-1)
//			{
//				alert('包含多个时，请用 / 隔开');	
//			}
			else if(level == '')
			{
				alert('请选择难易程度');
			}
			else if(bodypart == '')
			{
				alert('请选择课程重点');
			}
			else if(daycount == '')
			{	
				alert('请填写课程数量');
			}
//			else if(isNaN(daycount))
//			{
//				alert('课程数量必须为数字');
//			}
			else
			{
				$.ajax({
					url:"__URL__/outlineUpdate",
					type:'post',
					data: {'name':name,'outline_id':outline_id,'type':type,'useequipment':useequipment,'level':level,'bodypart':bodypart,'daycount':daycount
						},
					datatype:'json',
					success:function(jsondata)
					{					
						if(jsondata.code == -1)
						{
							//编辑大纲失败;
							alert(jsondata.msg);
							//window.location.reload();
						}						
						if(jsondata.code == 1 ) 
						{
							var url = "<?php  echo U('OutlineDetailsportitemgroup/index',array('actiontype'=>2,'outline_id'=>$outline_id));?>";
							window.location.href = url;
						}
//						if(jsondata == -1 )
//						{
//							alert('大纲以存在');
//						}
					}
				});
			}
		});
	}
	
	//新建页面3
	if(<?php echo $actiontype;?> == 3)
	{
		//隐藏查看和编辑的下一步
		$("#cksubmit").addClass("none");
		$("#bjsubmit").addClass("none");
		//大纲动作列表的链接不能用
		$("#actionList").removeAttr("onclick");
		//新建下一步按钮
		$("#xjsubmit").click(function(){
			//专题名称
			var name = $('#name').val();
			//课程类型
			var type = $('#type').val();
			//使用器械
			var useequipment = $('#useequipment').val();
			//难易程度
			var level = $('#level').val();
			//课程重点
			var bodypart = $('#bodypart').val();
			//课程数量
			var daycount = $('#daycount').val();			
			if(name == '')
			{
				alert('请填写专题名称');
			}
			else if(name.toString().length >10)
			{
				alert('专题名称不超过10个字');
			}
			else if(type=='')
			{
				alert('请选择课程类型');
			}
			else if(useequipment == '')
			{
				alert('请填写使用器械,包含多个时,请用 / 隔开');
			}
			else if(level == '')
			{
				alert('请选择难易程度');
			}
			else if(bodypart == '')
			{
				alert('请选择课程重点');
			}
			else if(daycount == '')
			{	
				alert('请填写课程数量');
			}
			else if(!isNumber(daycount))
			{
				alert('课程数量必须为数字');
			}
			else if(daycount == 0)
			{
				alert('课程数量必须大于0');
			}
			else if(daycount > 10)
			{
				alert('课程数量不可大于10');
			}
			else
			{
				$.ajax({
					url:"__URL__/outlineAdd",
					type:'post',
					data: {'name':name,'type':type,'useequipment':useequipment,'level':level,'bodypart':bodypart,'daycount':daycount
						},
					datatype:'json',
					success:function(jsondata)
					{
						if(jsondata.code == -1)
						{
							//大纲以存在
							alert(jsondata.msg);
							//window.location.reload();
						}
						else if(jsondata.code == -3)
						{
							//alert('新建大纲失败');
							alert(jsondata.msg);
							//window.location.reload();
						}
						else if(jsondata.code == -2)
						{
							//alert('新建大纲详情失败');
							alert(jsondata.msg);
							//window.location.reload();
						}
						else 
						{
							//alert('新建大纲详情成功');
							var url = "<?php echo U('OutlineDetailsportitemgroup/index',array('actiontype'=>1));?>";
							window.location.href = url;
							//alert(jsondata);
						}	
					}
				});
			}
		});
	}	
});
function doOutlineDetailsportitemgroup()
{
	var day = $('#hiddeday').val();
	var url = "<?php echo U('OutlineDetailsportitemgroup/index',array('day'=>'dayVal'));?>".replace('dayVal',day);
	window.location.href = url;
} 
</script>
        