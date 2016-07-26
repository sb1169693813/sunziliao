<!-- 内容开始-->
        <div class="line-full content-wrap">
            <div class="line-full t-position">
                <span>当前位置：</span>
                <span>课程管理</span>
                <div class="fright pdl30 <?php echo $trainingplanBaseList['status'] == 2?'none':'';?>" style="border-left:2px solid #000;">
                    <a href="javascript:void(0);" class="a1 blue pass-a" id="pass">通过</a>
                    <a href="javascript:void(0);" class="a1 blue pass-a" id="fail">退件</a>
                </div>
                <div class="fright mr40 <?php echo $trainingplanBaseList['status'] == 2?'none':'';?>">
                    <a href="javascript:void(0);" class="a1 pass-a comment-a" id="comment">批注</a>
                </div>
            </div>


            <!-- 蓝包开始1 -->
            <div class="line-full content-blue1 ">
                <div class="wp96auto mt20 ft14 fgree1 fleft h40">
                    <span id="on">1</span> <span class="w130 fleft"> <a href="javascript:void(0);">基本信息 >> </a> </span>
                    <span id="circle">2</span> <span class="w130 fleft"> <a class="fgray" href="javascript:void(0);" onclick="doTrainingplanBaseCheckDetailSportitemgroup(<?php echo $trainingplanBaseList['id'];?>);">动作设计 >> </a> </span>
                </div>
                <div class="whiteline border-b fleft mb20"></div>
                <!--  
                <form action="wanshalist.html" method="post">
                -->
                    <div class="line-full content">
                        <div class="wp96auto">
                            <!-- 行 1-->
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap ">
                                    <div class="t-20-r">教&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;练：</div>
                                    <?php echo isset($coach_name)?trim($coach_name):null;?>
                                </div>
                            </div>

                            <!-- 行2-->
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap ">
                                    <div class="t-20-r">课程名称：</div>
                                    <?php echo isset($trainingplanBaseList['name'])?trim($trainingplanBaseList['name']):null;?>
                                </div>
                            </div>                       
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap ">
                                    <div class="t-20-r">难易程度：</div>
                                  	<?php if(isset($trainingplanBaseList['level']))
                                  	{
                                  		switch ($trainingplanBaseList['level'])
                                  		{
                                        		case 1:
                                        			echo '入门级';
                                        		break;
                                        		case 2:
                                        			echo '初级';
                                        		break;
                                        		case 3:
                                        			echo '中级';
                                        		break;
                                        		case 4:
                                        			echo '高级';
                                        		break;
                                        		case 5:
                                        			echo '挑战级';
                                        		break;                                   
                                        	}  	
                                  	
                                  	}
                                  	else
                                  	{
                                  		echo '';
                                  	}
                                  	?>	
                                </div>
                            </div>

                            <!-- 行3-->

                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap ">
                                    <div class="t-20-r">课程目标：</div>
                                    <div class="input-50-r">
                                       <?php if(isset($trainingplanBaseList['coursestarget']))
                                  	{
                                  			switch ($trainingplanBaseList['coursestarget'])
                                  			{
                                        		case 1:
                                        			echo '增肌塑性';
                                        		break;
                                        		case 2:
                                        			echo '体适能训练';
                                        		break;
                                        		case 3:
                                        			echo '减脂塑形';
                                        		break;                                        	                                   
                                        	}                                 	
                                  	}
                                  	else
                                  	{
                                  		echo '';
                                  	}
                                  	?>
                                    </div>
                                </div>
                            </div>
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap ">
                                    <div class="t-20-r">单天重点：</div>                                   
					          <?php if(isset($trainingplanBaseList['bodypart']))
                                  	{
                                  			switch ($trainingplanBaseList['bodypart'])
                                  			{
                                        		case 1: echo '心肺耐力';break;
                                        		case 2: echo '肌肉适能';break;
                                        	    case 3: echo '柔韧';break;                              	                                   
                                        	    case 4: echo '平衡';break;                              	                                   
                                        	    case 5: echo '灵敏';break;                              	                                   
                                        	    case 6: echo '全身';break;                              	                                   
                                        	    case 7: echo '全身偏上';break;                              	                                   
                                        	    case 8: echo '全身偏下';break;                              	                                   
                                        	    case 9: echo '全身偏躯干';break;                              	                                   
                                        	    case 10: echo '上肢下肢';break;                              	                                   
                                        	    case 11: echo '上肢躯干';break;                              	                                   
                                        	    case 12: echo '下肢躯干';break;                              	                                   
                                        	    case 13: echo '上肢';break;                              	                                   
                                        	    case 14: echo '躯干';break;                              	                                   
                                        	    case 15: echo '下肢';break;                                        	                                	                                   
                                        	}                                 	
                                  	}
                                  	else
                                  	{
                                  		echo '';
                                  	}
                                  	?>         
                                </div>
                            </div>
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap ">
                                    <div class="t-20-r">课程类型：</div>
                                    <?php if(isset($trainingplanBaseList['equipmenttype']))
                                  	{
                                  			switch ($trainingplanBaseList['equipmenttype'])
                                  			{
                                        		case 1: echo '徒手训练';break;
                                        		case 2: echo '健身房训练';break;
                                        	    case 3: echo '家庭健身';break;                              	                                   
                                        	    case 4: echo 'HIIT';break;                              	                                   
                                        	    case 5: echo '体育舞蹈';break;                              	                                   
                                        	    case 6: echo '特殊小器械';break;                              	                                   
                                        	    case 7: echo 'Cross fit';break;                                        	                                           	                                	                                   
                                        	}                                 	
                                  	}
                                  	else
                                  	{
                                  		echo '';
                                  	}
                                  	?> 
                                </div>
                            </div>


                            <!-- 行4-->


                            <!-- 行5-->

                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap  ">
                                    <div class="t-20-r">使用器械：</div>
                                    <?php echo isset($trainingplanBaseList['equipment'])?trim($trainingplanBaseList['equipment']):null;?>&nbsp;&nbsp;
                                    <a href="<?php echo U('InstrumentReference/index');?>" class="instrument-name" target="_blank">器械名称参考</a><br>
                                </div>
                            </div>

                            <div class="line-full t-line-36">
                                <div class="wp100wrap  ">
                                    <div class="t-20-r">目标部位：<br>（可多选）</div>
                                    <?php echo isset($targetbodypart)?trim($targetbodypart):null;?>
                                </div>
                            </div>
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap  ">
                                    <div class="t-20-r">目标肌肉：</div>
                                    <?php echo isset($trainingplanBaseList['targetmuscle'])?trim($trainingplanBaseList['targetmuscle']):null;?>&nbsp;&nbsp;
                                    <a href="<?php echo U('MuscleReference/index');?>" class="instrument-name" target="_blank">肌肉名称参考</a><br>
                                </div>
                            </div>


                            <!-- 行7-->

                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap ">
                                    <div class="t-20-r">热量消耗：</div>
                                    <?php echo isset($trainingplanBaseList['kcal'])?trim($trainingplanBaseList['kcal']):null;?> kcal
                                </div>
                            </div>

                            <!-- 行8-->

                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap ">
                                    <div class="t-20-r">课程参考链接：<br>（非必填）</div>
									<?php echo isset($trainingplanBaseList['referenceurl'])?trim($trainingplanBaseList['referenceurl']):null;?>
                                </div>
                            </div>


                            <!-- 行9-->

                            <div class="line-full t-line-36">
                                <div class="wp100wrap   mb10 pdb30" style="border-bottom:1px solid #ccc; ">
                                    <div class="t-20-r">课程结构：</div>
                                    <div class="input-50-r">
                                        <span>
                                        <?php
                                            $trainingplanConfigList['warmupstatus'] = isset($trainingplanConfigList['warmupstatus'])?trim($trainingplanConfigList['warmupstatus']):'';
	                   						if($trainingplanConfigList['warmupstatus'] == 1)
	                   						{
	                   							echo '热身 +';
	                   						}
	                   						else
	                   						{
	                   							echo '';
	                   						}
	                   						?>
                                        </span><span><?php echo isset($trainingplanConfigList['sportitemgroupcount'])? trim($trainingplanConfigList['sportitemgroupcount']).'小段课程':NULL ;?>
                                        
                                        	</span><span>
                                        	<?php 
                                              $trainingplanConfigList['stretchstatus'] = isset($trainingplanConfigList['stretchstatus'])?trim($trainingplanConfigList['stretchstatus']):'';
							                   if($trainingplanConfigList['stretchstatus'] == 1)
							                   {
							                   	echo '+ 拉伸';
							                   }
							                   else
							                   {
							                   	echo '';
							                   }
							                   ?>
                                        	</span>
                                    </div>
                                </div>
                            </div>
                            <!-- 行10-->
                            <div class="line-full t-line-36">
                                <div class="wp50wrap  h200 pdl150">
                                    <div class="line-full t-line-36">
                                        <div class="t-45-r">心肺耐力：</div>
                                        <!--<input type="text" placeholder="" class="input-50-r">-->
                                        <div class="input-50-r"><?php echo isset($trainingplanBaseList['ability1'])?intval(trim($trainingplanBaseList['ability1'])):null;?>星</div>
                                    </div>
                                    <div class="line-full t-line-36">
                                        <div class="t-45-r">肌适能：</div>
                                        <div class="input-50-r"><?php echo isset($trainingplanBaseList['ability2'])?intval(trim($trainingplanBaseList['ability2'])):null;?>星</div>
                                    </div>
                                    <div class="line-full t-line-36">
                                        <div class="t-45-r">柔韧性：</div>
                                        <div class="input-50-r"><?php echo isset($trainingplanBaseList['ability3'])?intval(trim($trainingplanBaseList['ability3'])):null;?>星</div>
                                    </div>
                                    <div class="line-full t-line-36">
                                        <div class="t-45-r">灵敏性：</div>
                                        <div class="input-50-r"><?php echo isset($trainingplanBaseList['ability4'])?intval(trim($trainingplanBaseList['ability4'])):null;?>星</div>
                                    </div>
                                    <div class="line-full t-line-36">
                                        <div class="t-45-r">平衡性：</div>
                                        <div class="input-50-r"><?php echo isset($trainingplanBaseList['ability5'])?intval(trim($trainingplanBaseList['ability5'])):null;?>星</div>
                                    </div>
                                </div>
                                <div class="fright w300">
                                    <ul class="left ft12">
                                        <li class="fw">星级说明：</li>
                                        <li>1星：普通人群日常的生理功能水平</li>
                                        <li>2星：普通人群低强度运动的生理功能水平</li>
                                        <li>3星：普通人群中等强度运动的生理功能水平</li>
                                        <li>4星：规律运动人群高强度运动的生理功能水平</li>
                                        <li>5星：运动老手极限强度运动的生理功能水平</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="line-full save-line wp100wrap  h40">
                            <a href="<?php echo U('TrainingplanBaseCheckDetail/update',array('id'=>$trainingplanBaseList['id']));?>" class="blue">编&nbsp;&nbsp; &nbsp; &nbsp;辑</a>
                        	<input id="hiddentrainingplan_base_id"  name="hiddentrainingplan_base_id" type="hidden"  value="<?php echo isset($trainingplanBaseList['id'])?trim($trainingplanBaseList['id']):null;?>"/>                       	
                        </div>
                    </div>
               <!--  
                </form>
                -->
            </div>
            <!-- 蓝包结束1-->

        </div>
        <!-- 内容结束-->
        <!-- <div class="line-full copyright">

           公司版权所有<br>公司版权所有@公司版权所有@公司版权所有@公司版权所有@

         </div> -->

<!-- 右全部内容 结束-->
<script src="__PUBLICROOT__/TrainingManage/js/jquery-1.8.3.min.js"></script>
<script src="__PUBLICROOT__/TrainingManage/js/jquery-labelauty.js"></script>
<link href="__PUBLICROOT__/TrainingManage/css/form.css" rel="stylesheet" type="text/css">
<script>
    $(function () {
    	$(':input').labelauty();
        $('#comment').on('click', function () {
            $('#pop1').css('display', 'block');
        });
        $('#save').on('click', function () {
            $('#pop1').css('display', 'none');
        });
        $('#close').on('click', function () {
            $('#pop1').css('display', 'none');
        });
        $('#pass').on('click',function(){
            $('#pop2').css('display', 'block');
        });
        $('#close2').on('click', function () {
            $('#pop2').css('display', 'none');
        });
        $('#fail').on('click',function(){
            $('#pop3').css('display', 'block');
        })
        $('#close3').on('click', function () {
            $('#pop3').css('display', 'none');
        });
        
      	//通过按钮
        $('#trainingplanBasePass').click(function(){
    		var trainingplan_base_id = $("#hiddentrainingplan_base_id").val();
    		//隐藏弹出框
    		$('#pop2').css('display', 'none');
    		if(confirm('确认通过吗?'))
    		{
    			$.ajax({
              		 url:"__URL__/trainingplanBasePass",
           			type:'post',
           			data: {
           				'trainingplan_base_id':trainingplan_base_id
           				},
           			'datatype':'json',
           			success:function(jsondata){
                   			//alert(jsondata);
           				if(jsondata.code == 1)
           				{
           					alert('审核通过');
           					var url = "<?php echo U('TrainingplanBaseCheckList/index?status=2');?>";
           					window.location.href = url;
           				}
           				if(jsondata.code == -1)
           				{
           					//alert('审核失败'); 
           					alert(jsondata.msg);          					
           				} 
           				if(jsondata.code == -2)
           				{
           					//alert('审核失败'); 
           					alert(jsondata.msg);          					
           				}         				
           			},
    			});
    		}
        });
        
      	//退件按钮
        $("#trainingplanBaseBounce").click(function(){
            //alert(1111);
        	var trainingplan_base_id = $("#hiddentrainingplan_base_id").val();
        	$('#pop3').css('display', 'none');
        	if(confirm('确认退件吗?'))
    		{
    			$.ajax({
              		 url:"__URL__/trainingplanBaseBounce",
           			type:'post',
           			data: {
           				'trainingplan_base_id':trainingplan_base_id
           				},
           			'datatype':'json',
           			success:function(jsondata){
                   			//alert(jsondata);
           				if(jsondata.code == 1)
           				{
           					alert('退件成功');
           					var url = "<?php echo U('TrainingplanBaseCheckList/index?status=-1');?>";
           					window.location.href = url;
           				}
           				if(jsondata.code == -1)
           				{
           					//alert('审核失败'); 
           					alert(jsondata.msg);          					
           				} 
           				if(jsondata.code == -2)
           				{
           					//alert('审核失败'); 
           					alert(jsondata.msg);          					
           				}           				          				
           			},
    			});
    		}
        });	
    });
    function doTrainingplanBaseCheckDetailSportitemgroup(id)
    {
    	var url = "<?php echo U('TrainingplanBaseCheckDetailSportitemgroup/index',array('id'=>'idVal'));?>".replace('idVal',id);
    	window.location.href = url;
    }
</script>
<style>
        .t-line-36 {
            width: 100%;
            height: auto;
        }

        .select2 {
            width: 100%;
            height: 26px;
            border: none;
        }
</style>