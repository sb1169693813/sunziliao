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
                        <span class="w130 fleft ml20" id="dongzuo"> <!--  <a id="dongzuo" href="javascript:void(0);"></a> --></span>
                    </div>
                    <div class="whiteline border-b fleft mb20"></div>
                    <div class="line-full content">
                        <div class="wp96auto">
                        	<!-- 行 0-->
                        	<div class="line-full  <?php echo isset($sportitemBaseList['auditreply'])?'':'none';?>">
                                <div class="wp100wrap ">
                                    <div class="t-55-r">审核批注：</div>
                                    <div class="input-50-r fred " style="height:auto;text-indent: 0px;"><?php echo isset($sportitemBaseList['auditreply']) ? $sportitemBaseList['auditreply']:null;?></div>
                                </div>
                            </div>
                            <!-- 行 1-->
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-55-r">名称：</div>                                      
                                    <input name="name" id="name" type="text" placeholder="" class="input-50-r" value="<?php echo isset($sportitemBaseList['name']) ? $sportitemBaseList['name']:null;?>"/>                               	
                                </div>
                            </div>
                            <!-- 行2-->
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-55-r">难易：</div>
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
                             <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-55-r">类别：</div>
                                    <div class="input-50-r">
                                        <div class="sel-01 line-full">
                                            <select name="type" id="type">
                                            	<option value="">请选择</option>
                                                <option value="1">热身</option>
                                                <option value="2">练习</option>
                                                <option value="3">拉伸</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 行3-->
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap  ">
                                    <div class="t-55-r">使用器械：</div>
                                    <input type="text" value="<?php echo isset($sportitemBaseList['useequipment']) ? $sportitemBaseList['useequipment']:null;?>" class="input-50-r" name="useequipment" id="useequipment"/>&nbsp;&nbsp;
                                    <a href="<?php echo U('InstrumentReference/index');?>" class="instrument-name" target="_blank">器械名称参考</a><br>
                                    <span style="padding-left: 290px;font-size:12px; color:#aaa;">包含多个时，请用 / 隔开</span>
                                </div>
                            </div>
                            <!-- 行4-->
                            <!-- 行5-->
                            <div class="line-full t-line-36" style="height:150px;">
                                <div class="wp100wrap" style="height:150px;">
                                    <div class="t-55-r">目标部位：<br>（可多选）</div>
                                    <div class="input-50-r lh30">
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="肩部" class="chk_1" value="肩部"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="上臂" class="chk_1" value="上臂"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="前臂" class="chk_1" value="前臂"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="背部" class="chk_1" value="背部"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="胸部" class="chk_1" value="胸部"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="腹部" class="chk_1" value="腹部"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="臀部" class="chk_1" value="臀部"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="大腿" class="chk_1" value="大腿"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="小腿" class="chk_1" value="小腿"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap  ">
                                    <div class="t-55-r">目标肌肉：</div>
                                    <input name="target" id="target" type="text" value="<?php echo isset($sportitemBaseList['target']) ? $sportitemBaseList['target']:null;?>" class="input-50-r">&nbsp;&nbsp;
                                    <a href="<?php echo U('MuscleReference/index');?>" class="instrument-name" target="_blank">肌肉名称参考</a><br>
                                    <span style="padding-left: 290px;font-size:12px; color:#aaa;">包含多个时，请用 / 隔开</span>
                                </div>
                            </div>
                            <!-- 行6-->
                            <div class="line-full t-line-36 h120">
                                <div class="wp100wrap  h120" style="height:auto !important;min-height:120px;">
                                    <div class="t-55-r">
                                        描述：
                                    </div>
                                    <div class="input-50-r" style="height:auto !important;min-height:100px;">
                                    
                                        	<!--//查看1,编辑2  
											<textarea  style="overflow-x:auto;overflow-y:auto" class="wp100wrap h100" cols="12" rows="12" name="intro" id="intro"><?php //echo isset($sportitemBaseList['intro']) ? $sportitemBaseList['intro']:null;?></textarea>                                       	
                                        	-->
                                        <?php 
                                        if($actiontype == 2)
                                        {
                                        	echo "<textarea  style='overflow-x:auto;overflow-y:auto' class='wp100wrap h100' cols='12' rows='12' name='intro' id='intro'>";
                                        	echo isset($sportitemBaseList['intro']) ? $sportitemBaseList['intro']:null;
                                        	 echo "</textarea>";
                                        	
                                        }                              
                                    ?>
                                    <?php if($actiontype == 1)
                                    {
                                    	echo '<div class="wp100wrap h100" style="height:auto !important;min-height:100px;">';
                                    	echo isset($sportitemBaseList['intro']) ? $sportitemBaseList['intro']:null;
                                    	echo "</div>";
                                    }?>
                                    
                                    	 
                                    
                                    </div>
                                </div>
                            </div>
                            <!-- 行 7-->                                                    
							<div class="line-full t-line-36 h40 content1">
                                <div class="wp100wrap  h40">
                                    <div class="t-55-r">要点：</div>
                                    <div class="input-50-r">
                                        <span class="on">1</span>
                                        <div><input type="text" class="wp89" name="content1" id="content1" value="<?php echo isset($sportitemBaseList['content1'])?$sportitemBaseList['content1']:null;?>"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="line-full t-line-36 h40 content2">
                                <div class="wp100wrap  h40">
                                    <div class="t-55-r">&nbsp;&nbsp;</div>
                                    <div class="input-50-r">
                                        <span class="on">2</span>
                                        <div><input type="text" class="wp89" name="content2" id="content2" value="<?php echo isset($sportitemBaseList['content2'])?$sportitemBaseList['content2']:null;?>"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="line-full t-line-36 h40 content3">
                                <div class="wp100wrap  h40">
                                    <div class="t-55-r">&nbsp;&nbsp;</div>
                                    <div class="input-50-r">
                                        <span class="on">3</span>
                                        <div><input type="text" class="wp89" name="content3" id="content3" value="<?php echo isset($sportitemBaseList['content3'])?$sportitemBaseList['content3']:null;?>"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="line-full t-line-36 h40 content4">
                                <div class="wp100wrap  h40">
                                    <div class="t-55-r">&nbsp;&nbsp;</div>
                                    <div class="input-50-r">
                                        <span class="on">4</span>
                                        <div><input type="text" class="wp89" name="content4" id="content4" value="<?php echo isset($sportitemBaseList['content4'])?$sportitemBaseList['content4']:null;?>"></div>
                                    </div>
                                </div>
                            </div>
							<!--  
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">&nbsp&nbsp</div>
                                        <div class="input-50-r">

                                            <span class="on">2</span> <input type="text" class="wp89">


                                        </div>
                                    </div>
								</div>
                                    <div class="line-full t-line-36 h40">
                                        <div class="wp100wrap  h40">
                                            <div class="t-55-r">&nbsp&nbsp</div>
                                            <div class="input-50-r">

                                                <span class="on">3</span> <input type="text" class="wp89">


                                            </div>
                                        </div>


                                        

                                    </div>
                                    -->
                                <div class="line-full save-line">
                                     <input id="commit" type="button" value="提 交 审 核" class="blue hand">
									 <input id="sportitem_base_id" type="hidden" name="sportitem_base_id" value="<?php echo isset($sportitemBaseList['id']) ? $sportitemBaseList['id']:null;?>" />			
                                </div>                            
                            <!-- 蓝包结束1-->
                        </div>
                        <!-- 内容结束-->
                        <!-- <div class="line-full copyright">
                           公司版权所有<br>公司版权所有@公司版权所有@公司版权所有@公司版权所有@
                         </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- 右全部内容 结束-->
    <script src="__PUBLICROOT__/TrainingManage/js/jquery-1.8.3.min.js"></script>
    <script src="__PUBLICROOT__/TrainingManage/js/jquery-labelauty.js"></script>
        <link href="__PUBLICROOT__/TrainingManage/css/form.css" rel="stylesheet" type="text/css">
    <script>
        $(function () {
            $(':input').labelauty();
          	//类别
        	$("#type option").each(function(){
        		if($(this).val() == "<?php echo isset($sportitemBaseList['type'])?trim($sportitemBaseList['type']):'';?>")
        		{
        			$(this).attr('selected',true);
        		}
        	});
        	//难易
        	$("#level option").each(function(){
        		if($(this).val() == "<?php echo isset($sportitemBaseList['level'])?trim($sportitemBaseList['level']):'';?>")
        		{
        			$(this).attr('selected',true);        		
        		}
        	});
        	//目标肌肉
        	var targetbodypart = "<?php echo isset($sportitemBaseList['targetbodypart'])?trim($sportitemBaseList['targetbodypart']):'';?>";
        	$("input[name='targetbodypart']").each(function(){
            	 
        		if(targetbodypart.indexOf($(this).val()) != -1)
        		{
        			//console.log($(this).val());
        			$(this).attr('checked',true);
        		}
        	});

        	//查看页面
        	if(<?php echo $actiontype;?> == 1)
        	{
            	//禁用一些选项
				//name
				$("#name").attr('disabled',true);
				//level
				$("#level").attr('disabled',true);
				//type
				$("#type").attr('disabled',true);
				//useequipment
				$("#useequipment").attr('disabled',true);
				//targetbodypart
				$("input[name='targetbodypart']").attr('disabled',true);
				//target
				$("#target").attr('disabled',true);
				//intro
				$("#intro").attr('disabled',true);
				//content				
				if($("#content4").val() == '')
				{
					$(".content4").addClass('none');
				}
//				if($("#content1").val() == '')
//				{
//					$(".content1").addClass('none');
//				}
				if($("#content2").val() == '')
				{
					$(".content2").addClass('none');
				}
				if($("#content3").val() == '')
				{
					$(".content3").addClass('none');
				}
				$("#content1").attr('disabled',true);
				$("#content2").attr('disabled',true);
				$("#content3").attr('disabled',true);
				$("#content4").attr('disabled',true);
				//隐藏提交审核按钮
				$("#commit").addClass("none");
				$("#dongzuo").html('查看动作:');
            }
            
        	//编辑页面
        	if(<?php echo $actiontype;?> == 2)
        	{
        		//禁用一些选项
        		//name
				$("#name").attr('disabled',true);
        		$("#dongzuo").html('编辑动作:');
        	  	//提交审核
            	$("#commit").click(function(){
                	//var sname = $("#sname").val();
            		//sportitem_base_id
            		var sportitem_base_id = $("#sportitem_base_id").val();
    				//名称
                	//var name = $("#name").val();
                	//难易
                	var level = $("#level").val();
                	//类别
                	var type = $("#type").val();
                	//使用器械
                	var useequipment = $("#useequipment").val();
                	//目标部位
                	var $chk_value =[];
    				$('input[name="targetbodypart"]:checked').each(function(){ 
    					$chk_value.push($(this).val());
    				});
    				var targetbodypart = $chk_value.join(',');
                	//目标肌肉
                	var target = $("#target").val();
                	//描述
                	var intro = $("#intro").val();
                	//要点content
                	var content1 = $("#content1").val();
                	var content2 = $("#content2").val();
                	var content3 = $("#content3").val();
                	var content4 = $("#content4").val();
                	//验证填写的信息
                	if(level=='')
	    			{
						alert('请选择难易');
	        		}
	    			else if(type == '')
	    			{
						alert('请选择类别');
	        		}
	    			else if(useequipment == '')
	    			{
						alert('请填写使用器械,包含多个时,请用 / 隔开');
	        		}
	    			else if(useequipment.toString().length > 100)
	    			{
	    				alert('使用器械不超过100个字');
	    			}
	    			else if(targetbodypart == '')
	    			{
						alert('请选择目标部位');
	        		}
	    			else if(target == '')
	    			{
						alert('请填写目标肌肉,包含多个时,请用 / 隔开');
	        		}
	    			else if(target.toString().length > 100)
	    			{
	    				alert('目标肌肉不超过100个字');
	    			}
	    			else if(intro == '')
	    			{
						alert('请填写描述');
	        		}
	    			else if(intro.toString().length > 200)
	    			{
	    				alert('描述不超过200个字');
	    			}
	    			else if(content1 == '')
	    			{
						alert('请填写要点');
	        		}
	    			else if(content1.toString().length > 40)
	    			{
	    				alert('要点1不超过40个字');
	    			}
	    			else if(content2.toString().length > 40)
	    			{
	    				alert('要点2不超过40个字');
	    			}
	    			else if(content3.toString().length > 40)
	    			{
	    				alert('要点3不超过40个字');
	    			}
	    			else if(content4.toString().length > 40)
	    			{
	    				alert('要点4不超过40个字');
	    			}
	    			else
	    			{
	    				if(confirm('确认提交?'))
	                    {
	                   	 $.ajax({
	                   		 url:"__URL__/sportitemBaseCommit",
	                			type:'post',
	                			data: {
	                   				'sportitem_base_id':sportitem_base_id,'level':level,'type':type,
	                   				'useequipment':useequipment,'targetbodypart':targetbodypart,
	                   				'target':target,'intro':intro,'content1':content1,
	                   				'content2':content2,'content3':content3,'content4':content4          				
	                				},
	                			'datatype':'json',
	                			success:function(jsondata)
	                			{
	                        		//console.log(jsondata);
	                				if(jsondata.code == 1)
	                				{
	                					//alert('提交成功');
	                					alert(jsondata.msg);
	                					window.location.href = '<?php echo U("SportitemBaseList/index");?>';
	                				}
	                				if(jsondata.code == 0)
	                				{
	                					//alert('提交失败');
	                					alert(jsondata.msg);
	                				}
	                			},
	    					});
	                    }
		    		}           		
                });
            }    
        });
    </script>
<script src="__PUBLICROOT__/TrainingManage/js/gg_bd_ad_720x90.js" type="text/javascript"></script>
<script src="__PUBLICROOT__/TrainingManage/js/follow.js" type="text/javascript"></script>