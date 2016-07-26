        <!-- 内容开始-->
        <div class="line-full content-wrap">
            <div class="line-full t-position">
                <span>当前位置：</span>
                <span>课程管理</span>
                <div class="fright pdl30 <?php echo $sportitemBaseList['auditstatus'] == 2?'none':'';?>" style="border-left:2px solid #000;">
                    <a href="javascript:void(0);" class="a1 blue pass-a" id="pass">通过</a>
                    <a href="javascript:void(0);" class="a1 blue pass-a" id="fail">退件</a>
                </div>
                <div class="fright mr40 <?php echo $sportitemBaseList['auditstatus'] == 2?'none':'';?>">
                    <a href="javascript:void(0);" class="a1 pass-a comment-a" id="comment">批注</a>
                </div>
            </div>


            <!-- 蓝包开始1 -->
            <div class="line-full content-blue1 ">
                <div class="line-full">
                    <div class="wp96auto h40 mt20 ft14 fgree1 fleft">
                        <span class="w130 fleft ml20"> <!--  <a href="javascript:void(0);">动作库 </a>--> 动作库:</span>
                    </div>

                    <div class="whiteline border-b fleft mb20"></div>
                    <div class="line-full content">
                        <div class="wp96auto ">


                            <!-- 行 1-->
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-55-r">名称：</div>
                                    <div class="input-50-r"><?php echo isset($sportitemBaseList['name']) ? $sportitemBaseList['name']:null;?></div>
                                </div>
                            </div>												
                            <!-- 行2-->

                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-55-r">难易：</div>
                                    <div class="input-50-r">
                                    <?php if(isset($sportitemBaseList['level'])){?>
                                    	<?php 
                                    	switch($sportitemBaseList['level'])
                                    	{
                                    		case 1: echo '入门级';break;
                                    		case 2: echo '初级';break;
                                    		case 3: echo '中级';break;
                                    		case 4: echo '高级';break;
                                    		case 5: echo '挑战级';break;
                                    	}
                                    	?>
                                    <?php }
                                    else 
                                    {
                                    	echo '';                                  	
                                    }
                                   ?>
                                    </div>
                                </div>
                            </div>										
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-55-r">类别：</div>
                                    <div class="input-50-r">
                                    <?php if(isset($sportitemBaseList['type'])){?>
                                    	<?php 
                                    	switch($sportitemBaseList['type'])
                                    	{
                                    		case 1: echo '热身';break;
                                    		case 2: echo '练习';break;
                                    		case 3: echo '拉伸';break;                                 
                                    	}
                                    	?>
                                    <?php }
                                    else 
                                    {
                                    	echo '';                                   	
                                    }
                                   ?></div>
                                </div>
                            </div>

                            <!-- 行3-->

                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  ">
                                    <div class="t-55-r">使用器械：</div>
                                    <div class="input-50-r" style="height:auto;text-indent: 0px;"><?php echo isset($sportitemBaseList['useequipment']) ? $sportitemBaseList['useequipment']:null;?>&nbsp;&nbsp;
                                        <a href="<?php echo U('InstrumentReference/index');?>" class="instrument-name" target="_blank">器械名称参考</a></div>
                                </div>
                            </div>
                            <!-- 行4-->
                            <!-- 行5-->

                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  ">
                                    <div class="t-55-r">目标部位：</div>
                                    <div class="input-50-r "><?php echo isset($targetbodypart) ? $targetbodypart:null;?></div>
                                </div>
                            </div>
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap  ">
                                    <div class="t-55-r">目标肌肉：</div>
                                    <div class="input-50-r" style="height:auto;text-indent: 0px;"><?php echo isset($sportitemBaseList['target']) ? $sportitemBaseList['target']:null;?>&nbsp;&nbsp;
                                        <a href="<?php echo U('MuscleReference/index');?>" class="instrument-name" target="_blank">肌肉名称参考</a>
                                    </div>

                                </div>
                            </div>
                            <!-- 行6-->
                            <div class="line-full t-line-36 h120">
                                <div class="wp100wrap  h120" style="height:auto !important;min-height:120px;">
                                    <div class="t-55-r">
                                        描述：
                                    </div>
                                    <div class="input-50-r" style="height:auto !important;min-height:100px;">
                                    	<!--  
                                        <textarea style="overflow-x:auto;overflow-y:auto" class="wp100wrap h100" cols="12" rows="12"><?php //echo isset($sportitemBaseList['intro']) ? $sportitemBaseList['intro']:null;?>                                       
                                        </textarea>
                                        -->
                                        <div class="wp100wrap h100" style="height:auto !important;min-height:100px;">
                                        	<?php echo isset($sportitemBaseList['intro']) ? $sportitemBaseList['intro']:null;?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 行 7-->
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40" style="height:auto !important;min-height:40px;">
                                    <div class="t-55-r">要点：</div>
                                    <div class="input-50-r" style="height:auto !important;min-height:22px;">
                                        <span class="on">1</span>
                                        <div style="height:auto !important;min-height:22px;"><?php echo isset($sportitemBaseList['content1'])?$sportitemBaseList['content1']:null;?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="line-full t-line-36 h40 <?php echo $sportitemBaseList['content2']==''?'none':'';?>">
                                <div class="wp100wrap  h40" style="height:auto !important;min-height:40px;">
                                    <div class="t-55-r">&nbsp;&nbsp;</div>
                                    <div class="input-50-r" style="height:auto !important;min-height:22px;">
                                        <span class="on">2</span>
                                        <div style="height:auto !important;min-height:22px;"><?php echo isset($sportitemBaseList['content2'])?$sportitemBaseList['content2']:null;?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="line-full t-line-36 h40 <?php echo $sportitemBaseList['content3']==''?'none':'';?>">
                                <div class="wp100wrap  h40" style="height:auto !important;min-height:40px;">
                                    <div class="t-55-r">&nbsp;&nbsp;</div>
                                    <div class="input-50-r" style="height:auto !important;min-height:22px;">
                                        <span class="on">3</span>
                                        <div style="height:auto !important;min-height:22px;"><?php echo isset($sportitemBaseList['content3'])?$sportitemBaseList['content3']:null;?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="line-full t-line-36 h40 <?php echo $sportitemBaseList['content4']==''?'none':'';?>">
                                <div class="wp100wrap  h40" style="height:auto !important;min-height:40px;">
                                    <div class="t-55-r">&nbsp;&nbsp;</div>
                                    <div class="input-50-r" style="height:auto !important;min-height:22px;">
                                        <span class="on">4</span>
                                        <div style="height:auto !important;min-height:22px;"><?php echo isset($sportitemBaseList['content4'])?$sportitemBaseList['content4']:null;?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="line-full save-line h40">
                                <a href="<?php echo U('SportitemBaseCheckDetail/update',array('id'=>$sportitemBaseList['id']));?>" class="blue">编 辑</a>
                           		<input type="hidden" name="hiddensportitem_base_id" id="hiddensportitem_base_id" value="<?php echo isset($sportitemBaseList['id'])?$sportitemBaseList['id']:null;?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 蓝包结束1-->

            </div>
        </div>
    </div>
<!-- 右全部内容 结束-->
 <link href="__PUBLICROOT__/TrainingManage/css/form.css" rel="stylesheet" type="text/css">
<script src="__PUBLICROOT__/TrainingManage/js/jquery-1.8.3.min.js"></script>
<script>
    $(function () {
        $('#comment').on('click', function () {
            $('#pop1').css('display', 'block');
        });
        $('#save').on('click', function () {
            $('#pop1').css('display', 'none');
        });
        $('#close').on('click', function () {
            $('#pop1').css('display', 'none');
        });
        $('#pass').on('click', function () {
            $('#pop2').css('display', 'block');
        });
        $('#close2').on('click', function () {
            $('#pop2').css('display', 'none');
        });
        $('#fail').on('click', function () {
            $('#pop3').css('display', 'block');
        })
        $('#close3').on('click', function () {
            $('#pop3').css('display', 'none');
        });
        
      	//通过按钮
        $('#sportitemBasepass').click(function(){
    		var sportitem_base_id = $("#hiddensportitem_base_id").val();
    		$('#pop2').css('display', 'none');
    		if(confirm('确认通过吗?'))
    		{
    			$.ajax({
              		 url:"__URL__/sportitemBasepass",
           			type:'post',
           			data: {
           				'sportitem_base_id':sportitem_base_id
           				},
           			'datatype':'json',
           			success:function(jsondata){
                   			//alert(jsondata);
           				if(jsondata.code  == 1)
           				{
           					//alert('动作审核通过');
           					alert(jsondata.msg);
           					var url = "<?php echo U('SportitemBaseCheckList/index?auditstatus=2');?>";
           					window.location.href = url;
           				}
           				if(jsondata.code  == -1)
           				{
           					//alert('动作审核失败'); 
           					alert(jsondata.msg);          					
           				}
//           				
           			},
    			});
    		}
        });
        
      	//退件按钮
        $("#sportitemBaseBounce").click(function(){
            //alert(1111);
    		var sportitem_base_id = $("#hiddensportitem_base_id").val();
    		$('#pop3').css('display', 'none');
        	if(confirm('确认退件吗?'))
    		{
    			$.ajax({
              		 url:"__URL__/sportitemBaseBounce",
           			type:'post',
           			data: {
           				'sportitem_base_id':sportitem_base_id
           				},
           			'datatype':'json',
           			success:function(jsondata){
                   			//alert(jsondata);
           				if(jsondata.code  == 1)
           				{
           					//alert('退件成功');
           					alert(jsondata.msg);
           					var url = "<?php echo U('SportitemBaseCheckList/index?auditstatus=-1');?>";
           					window.location.href = url;
           				}
           				if(jsondata.code  == -1)
           				{
           					//alert('退件失败'); 
           					alert(jsondata.msg);          					
           				}         				
           			},
    			});
    		}
        });	
    });
</script>