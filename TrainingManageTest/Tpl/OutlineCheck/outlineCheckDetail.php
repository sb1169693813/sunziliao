       <!-- 内容开始-->
        <div class="line-full content-wrap">
            <div class="line-full t-position">
                <span class="pdt8 in-block">当前位置：</span>
                <span class="pdt8 in-block">课程管理</span>
                <div class="fright pdl30 <?php echo $trainingplanOutlineList['auditstatus'] == 2?'none':'';?>" style="border-left:2px solid #000;">
                    <a href="javascript:void(0);" class="a1 blue pass-a" id="pass">通过</a>
                    <a href="javascript:void(0);" class="a1 blue pass-a" id="fail">退件</a>
                </div>
                <div class="fright mr40 <?php echo $trainingplanOutlineList['auditstatus'] == 2?'none':'';?>">
                    <a href="javascript:void(0);" class="a1 pass-a comment-a" id="comment" >批注</a>
                </div>
            </div>
            <!-- 蓝包开始1 -->
            <div class="line-full content-blue1">
                <div class="line-full">
                    <div class="wp96auto h40 mt20 ft14 fgree1 fleft">
                        <span id="on">1</span> <span class="w130 fleft"> <a href="javascript:void(0);">大纲基本属性 >> </a> </span>
                        <span id="circle">2</span> <span class="w130 fleft"> <a class="fgray" id="actionList" href="javascript:void(0);" onclick="doOutlineCheckDetailsportitemgroup();">大纲动作列表 >> </a> </span>
                    </div>
                    <!--  
                    <form action="" method="post">
                    -->
                        <div class="whiteline border-b fleft mb20"></div>
                        <div class="line-full content">
                            <div class="wp96auto">
                                <!-- 行 1-->
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">专题名称：</div>
                                        <div class="input-50-r" id="name"><?php echo isset($trainingplanOutlineList['name'])?trim($trainingplanOutlineList['name']):null;?></div>
                                    </div>
                                </div>
                                <!-- 行2-->
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">课程类型：</div>
                                        <div class="input-50-r">
                                        <?php if(isset($trainingplanOutlineList['type'])){
                                        	switch ($trainingplanOutlineList['type'])
                                        	{
                                        		case 1:
                                        			echo '徒手训练';
                                        		break;
                                        		case 2:
                                        			echo '健身房设备';
                                        		break;
                                        		case 3:
                                        			echo '家庭器械';
                                        		break;
                                        		case 4:
                                        			echo 'HIIT';
                                        		break;
                                        		case 5:
                                        			echo '体育舞蹈';
                                        		break;
                                        		case 6:
                                        			echo '特殊小器械';
                                        		break;
                                        		case 7:
                                        			echo 'Cross fit';
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
                                <!-- 行3-->
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  ">
                                        <div class="t-55-r">使用器械：</div>
                                        <div class="input-50-r" style="height:auto;text-indent: 0px;" id="useequipment"><?php echo isset($trainingplanOutlineList['useequipment'])?trim($trainingplanOutlineList['useequipment']):null;?>&nbsp;&nbsp;
                                            <a href="<?php echo U('InstrumentReference/index')?>" class="instrument-name" target="_blank">器械名称参考</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">难易程度：</div>
                                        <div class="input-50-r">
                                        <?php if(isset($trainingplanOutlineList['level'])){
                                        	switch ($trainingplanOutlineList['level'])
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
                                </div>
                                <!-- 行4-->
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">课程重点：</div>
                                        <div class="input-50-r">
                                            <div class="input-50-r">
                                            <?php if(isset($trainingplanOutlineList['bodypart'])){
                                        	switch ($trainingplanOutlineList['bodypart'])
                                        	{
                                        		case 1:
                                        			echo '体适能训练';
                                        		break;
                                        		case 2:
                                        			echo '全身偏上肢';
                                        		break;
                                        		case 3:
                                        			echo '全身偏下肢';
                                        		break;
                                        		case 4:
                                        			echo '全身偏躯干';
                                        		break;
                                        		case 5:
                                        			echo '上肢下肢';
                                        		break;
                                        		case 6:
                                        			echo '上肢躯干';
                                        		break;
                                        		case 7:
                                        			echo '躯干下肢';
                                        		break;                                   
                                        	}     	
                                        }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 行5-->
                                <div class="line-full t-line-36 h40">
                                    <div class="wp100wrap  h40">
                                        <div class="t-55-r">课程数量：</div>
                                        <div class="input-50-r" id="daycount"><?php echo isset($trainingplanOutlineList['daycount'])?trim($trainingplanOutlineList['daycount']):null;?></div>
                                    </div>
                                </div>
                                <div class="line-full save-line">
                                    <a href="<?php echo U('OutlineCheckDetail/update',array('id'=>$trainingplanOutlineList['id']));?>" class="blue">编&nbsp;&nbsp;&nbsp;&nbsp;辑</a>
                             		<input id="hiddeday"  name="day" type="hidden"  value="<?php echo isset($_GET['day'])?trim($_GET['day']):1;?>"/>                       	
                                	<input id="hiddenoutline_id"  name="outline_id" type="hidden"  value="<?php echo isset($trainingplanOutlineList['id'])?trim($trainingplanOutlineList['id']):null;?>"/>
                                </div>
                            </div>
                        </div>

                        <!-- 蓝包结束1-->
                    <!-- 
                    </form>
                 	-->
                </div>
            </div>
        </div>
        <!-- 右全部内容 结束-->
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
        $('#pass').on('click',function(){
            $('#pop2').css('display', 'block');
        });
        $('#close2').on('click', function () {
            $('#pop2').css('display', 'none');
        });
        $('#fail').on('click',function(){
            $('#pop3').css('display', 'block');
        });
        $('#close3').on('click', function () {
            $('#pop3').css('display', 'none');
        });
      	//通过按钮
        $('#detailpass').click(function(){
    		var outline_id = $("#hiddenoutline_id").val();
    		//弹出框隐藏
    		$('#pop2').css('display', 'none');
    		if(confirm('确认通过吗?'))
    		{    			
    			$.ajax({
              		 url:"__URL__/outlinePass",
           			type:'post',
           			data: {
           				'outline_id':outline_id
           				},
           			'datatype':'json',
           			success:function(jsondata){
                   			//alert(jsondata);
           				if(jsondata.code  == 1)
           				{
           					alert('审核通过');
           					var url = "<?php echo U('OutlineCheckList/index?auditstatus=2');?>";
           					window.location.href = url;
           				}       				
           				if(jsondata.code  == -1)
           				{
           					//alert('审核失败');
           					alert(jsondata.msg);
           				}
           				if(jsondata.code  == -2)
           				{
           					alert(jsondata.msg);
           				}
           				if(jsondata.code  == -3)
           				{
           					alert(jsondata.msg);
           				}
           			},
    			});
    		}
        });
      	//退件按钮
        $("#detailBounce").click(function(){
            //alert(1111);
        	var outline_id = $("#hiddenoutline_id").val();
        	//弹出框隐藏
        	$('#pop3').css('display', 'none');
        	if(confirm('确认退件吗?'))
    		{
    			$.ajax({
              		 url:"__URL__/outlineBounce",
           			type:'post',
           			data: {
           				'outline_id':outline_id
           				},
           			'datatype':'json',
           			success:function(jsondata){
                   			//alert(jsondata);
           				if(jsondata.code == 1)
           				{
           					alert('退件成功');
           					var url = "<?php echo U('OutlineCheckList/index?auditstatus=-1');?>";
           					window.location.href = url;
           				}           				
           				if(jsondata.code == -1)
           				{
           					//alert('退件失败');更改大纲审核状态失败
           					alert(jsondata.msg);
           				}
           				if(jsondata.code == -2)
           				{
           					//alert('退件失败');更改方案审核状态失败
           					alert(jsondata.msg);
           				}           				
           			},
    			});
    		}
        });	
    });
    //大纲动作列表链接
    function doOutlineCheckDetailsportitemgroup()
    {
    	var day = $('#hiddeday').val();
    	//hiddenoutline_id
    	var id = $('#hiddenoutline_id').val();
    	var url = "<?php echo U('OutlineCheckDetailsportitemgroup/index',array('id'=>'idVal','day'=>'dayVal'));?>".replace('dayVal',day).replace('idVal',id);
    	window.location.href = url;
    }
</script>