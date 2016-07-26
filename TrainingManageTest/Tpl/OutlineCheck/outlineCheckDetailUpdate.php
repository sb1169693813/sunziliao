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
                        <span id="on">1</span> <span class="w130 fleft"> <a href="javascript:void(0);" onclick="doOutlineCheckDetail();">大纲基本属性 >> </a> </span>
                        <span id="circle">2</span> <span class="w130 fleft"> <a class="fgray" href="javascript:void(0);" onclick="doOutlineCheckDetailsportitemgroup();">大纲动作列表 >> </a> </span>

                    </div>
                    <form action="" method="post">
                        <div class="whiteline border-b fleft mb20"></div>
                        <div class="line-full content">
                            <div class="wp96auto">
                                <!-- 行 1-->
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">专题名称：</div>
                                        <input id="name" type="text" placeholder="" class="input-50-r" value="<?php echo isset($trainingplanOutlineList['name'])?trim($trainingplanOutlineList['name']):null;?>">
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
                                                    <option value="2">健身房训练</option>
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
                                        <input id="useequipment" type="text" placeholder="" class="input-50-r" value="<?php echo isset($trainingplanOutlineList['useequipment'])?trim($trainingplanOutlineList['useequipment']):null;?>">&nbsp;&nbsp;
                                        <a href="<?php echo U('InstrumentReference/index')?>" class="instrument-name" target="_blank">器械名称参考</a><br>
                                        <span style="padding-left: 290px;font-size:12px; color:#aaa;">包含多个时，请用 / 隔开</span>
                                    </div>
                                </div>

                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">难易程度：</div>
                                        <div class="input-50-r">
                                            <div class="sel-01 line-full">                                               
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
                                        <input disabled="disabled" name="daycount" id="daycount" type="text" placeholder="" class="input-50-r" value="<?php echo isset($trainingplanOutlineList['daycount'])?trim($trainingplanOutlineList['daycount']):null;?>">&nbsp;&nbsp;节
                                    </div>
                                </div>
                                <div class="line-full save-line">
                                	<!--  
                                    <a href="" class="blue mr10">保&nbsp;&nbsp;&nbsp;&nbsp;存</a>
                                    <a href="" class="blue">取&nbsp;&nbsp;&nbsp;&nbsp;消</a>
                                    -->                                 
                                	<input id="baocun"  name="保存" type="button" class="blue mr10 hand" value="保&nbsp;&nbsp;&nbsp;&nbsp;存"/>
                                	<input id="quxiao"  name="取消" type="button" class="blue  hand" value="取&nbsp;&nbsp;&nbsp;&nbsp;消"/>
                                	<input id="hiddenoutline_id"  name="outline_id" type="hidden"  value="<?php echo isset($trainingplanOutlineList['id'])?trim($trainingplanOutlineList['id']):null;?>"/>                               	
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
        <!-- 右全部内容 结束-->
        <script type="text/javascript">
		$(function(){
			$("#type option").each(function(){
				if($(this).val() == "<?php echo isset($trainingplanOutlineList['type'])?trim($trainingplanOutlineList['type']):'';?>")
				{
					$(this).attr('selected',true);
				}
			});
			$("#level option").each(function(){
				if($(this).val() == "<?php echo isset($trainingplanOutlineList['level'])?trim($trainingplanOutlineList['level']):'';?>")
				{
					$(this).attr('selected',true);
				}
			});
			$("#bodypart option").each(function(){
				if($(this).val() == "<?php echo isset($trainingplanOutlineList['bodypart'])?trim($trainingplanOutlineList['bodypart']):'';?>")
				{
					$(this).attr('selected',true);	
				}
			});
			//点击保存时发生的事件
			$('#baocun').click(function(){
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
				if(name=='')
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
					alert('请填写使用器械，包含多个时，请用 / 隔开');
				}
				else if(useequipment.toString().length > 100)
    			{
    				alert('使用器械不超过100个字');
    			}
				else if(level == '')
				{
					alert('请选择难易程度');
				}
				else if(bodypart == '')
				{
					alert('请选择课程重点');
				}						
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
								//alert('编辑大纲失败');
								alert(jsondata.msg);
								//window.location.reload();
							}						
							if(jsondata.code == 1) 
							{
								//alert('编辑大纲成功');
								alert(jsondata.msg);
								var url = "<?php  echo U('OutlineCheckDetail/index',array('id'=>$trainingplanOutlineList['id']));?>";
								window.location.href = url;
							}							
						}
					});
				}
			});
			//点击取消时发生的事件
			$("#quxiao").click(function(){
				var url = "<?php  echo U('OutlineCheckDetail/index',array('id'=>$trainingplanOutlineList['id']));?>";
				window.location.href = url;
			});
		});
		//大纲动作列表链接
	    function doOutlineCheckDetailsportitemgroup()
		{
	    	//hiddenoutline_id
	    	var id = $('#hiddenoutline_id').val();
	    	var url = "<?php echo U('OutlineCheckDetailsportitemgroup/index',array('id'=>'idVal','day'=>1));?>".replace('idVal',id);
	    	window.location.href = url;
	    }
	  	//大纲基本属性链接
	    function doOutlineCheckDetail()
	    { 
	       	var id = "<?php echo isset($_GET['id'])?trim($_GET['id']):null;?>";     
	        var url = "<?php echo U('OutlineCheckDetail/index',array('id'=>'idVal'))?>".replace('idVal',id);
	        window.location.href = url;
	    }
        </script>