<!-- 内容开始-->
        <div class="line-full content-wrap">
            <div class="line-full t-position">
                <span class="pdt8 in-block">当前位置：</span>
                <span class="pdt8 in-block">课程管理</span>
                <div class="fright pdl30 <?php echo $trainingplanBaseList['status'] == 2?'none':'';?>" style="border-left:2px solid #000;">
                    <a href="javascript:void(0);" class="a1 blue pass-a" id="pass">通过</a>
                    <a href="javascript:void(0);" class="a1 blue pass-a" id="fail">退件</a>
                </div>
                <div class="fright mr40 <?php echo $trainingplanBaseList['status'] == 2?'none':'';?>">
                    <a href="javascript:void(0);" class="a1 pass-a comment-a" id="comment">批注</a>
                    <input type="hidden" name="hiddentrainingplan_base_id" id="hiddentrainingplan_base_id" value="<?php echo isset($trainingplanBaseList['id'])?trim($trainingplanBaseList['id']):null;?>"/>
                	<input type="hidden" name="hiddenoutline_id" value="<?php echo isset($trainingplanBaseList['outline_id']) ? $trainingplanBaseList['outline_id']:'';?>"/>
					<input type="hidden" name="hiddenoutline_detail_id" value="<?php echo isset($trainingplanBaseList['outline_detail_id']) ? $trainingplanBaseList['outline_detail_id']:'';?>"/>
                    <input type="hidden" name="hiddensportitemgroupcount" value="<?php echo isset($trainingplanConfig['sportitemgroupcount']) ? trim($trainingplanConfig['sportitemgroupcount']):'';?>"/>
                </div>
            </div>
            <!--主体-->
            <div class="line-full content-blue1" style="min-height:400px;">

                <div class="tab-right " style="width:88%; margin:0 auto;">
                    <div class="mt20 ft14 fgree1  h40">
                        <span id="circle">1</span> <span class="w130 fleft"> <a class="fgray" href="javascript:void(0);" onclick="doTrainingplanBaseCheckDetail(<?php echo $trainingplanBaseList['id'];?>);">基本信息 >> </a> </span>
                        <span id="on">2</span> <span class="w130 fleft"> <a href="javascript:void(0);">动作设计 >> </a> </span>
                        <a href="<?php echo U('ActionReference/index');?>" class="instrument-name ml30 " style="color:#47B4A7;" target="_blank">动作名称参考</a>
                    </div>
                    <div class="mb20">
                        <span style="color:red;margin-left:12px;">  单天重点</span>
                        <span class="pdl10">
                        <?php if(isset($trainingplanBaseList['bodypart']))
                        {
                        	 switch($trainingplanBaseList['bodypart'])
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
                        }?>
                        </span>
                    </div>
                    <div class=" content-blue1 fright ml20 reshen">
                        <div class="line-full head" style="border-radius: 6px;">
                            <div class="wp96auto">
                                <div class="fleft">热身阶段</div>
                                <a class="new-a1 showbox3" href="javascript:void(0);">
                                    <!--<button class="md-trigger new-a1 showbox3 " data-modal="modal-1">+ 添加</button>-->
                                </a>
                            </div>
                        </div>
                        <?php if(isset($sl1)){foreach($sl1 as $s1){?> 	
                        <div>                    
                            <div class="wp48 m20 fleft mb15">
                                <ul class="wp100 fleft">
                                    <li class="tableg lihidden"><?php echo $s1['sname'];?></li>                                   
                                    <li class="tableg lihidden"><?php 
                        			//个数1时间2
					                switch ($s1['grouptype'])
					                {
					                	case 1:
					                		echo $s1['count'].'个/'.$s1['groupcount'].'组';
					                		break;
					                	case 2:
					                		echo $s1['count'].'秒/'.$s1['groupcount'].'组';
					                		break;
					                }
                                    ?></li>
                                    <li class="bianji"><a href="javascript:void(0);" class="tableb btn btn-primary" onclick="adit(<?php echo $s1['id'];?>,1,'');">查看</a></li>
                                    <li></li>
                                </ul>
                            </div>                       
                        </div>                 	
                        <?php }}?>                        
                    </div>
                    
                    <?php $sportitemgroupcount = isset($trainingplanConfig['sportitemgroupcount'])?trim($trainingplanConfig['sportitemgroupcount']):1;?>
                    <?php for($i=0;$i<$sportitemgroupcount;$i++){?>
                    <div class=" content-blue1 fright ml20 lianxi">
                        <div class="line-full head" style="border-radius: 6px;">
                            <div class="wp96auto">
                                <div class="fleft">练习阶段</div>
                                <a class="new-a1 showbox3" href="javascript:void(0);">                               	
                                </a>
                            </div>
                        </div>
                        <?php if(isset($sl2)){foreach($sl2 as $s2){?>
                        <div class="<?php echo isset($s2[$i])?'':'none';?>">                    
                            <div class="wp48 m20 fleft mb15">
                                <ul class="wp100 fleft">
                                    <li class="tableg lihidden"><?php echo isset($s2[$i]['sname'])?$s2[$i]['sname']:null;?></li>                                   
                                    <li class="tableg lihidden"><?php 
                        			//个数1时间2
					                switch ($s2[$i]['grouptype'])
					                {
					                	case 1:
					                		echo $s2[$i]['count'].'个/'.$s2[$i]['groupcount'].'组';
					                		break;
					                	case 2:
					                		echo $s2[$i]['count'].'秒/'.$s2[$i]['groupcount'].'组';
					                		break;
					                }
                                    ?></li>
                                    <li class="bianji"><a href="javascript:void(0);" class="tableb btn btn-primary" onclick="adit(<?php echo isset($s2[$i]['id'])?$s2[$i]['id']:null;?>,2,<?php echo isset($s2[$i]['sort'])?$s2[$i]['sort']:null;?>);">查看</a></li>
                                    <li></li>
                                </ul>
                            </div>                       
                        </div>
                        <?php }}?>
                    </div>
                    <?php }?>  
                                                         
                    <div class=" content-blue1 fright ml20 lashen">
                        <div class="line-full head" style="border-radius: 6px;">
                            <div class="wp96auto">
                                <div class="fleft">拉伸阶段</div>
                                <a class="new-a1 showbox3" href="javascript:void(0);">
                                </a>
                            </div>
                        </div>
                        <?php if(isset($sl3)){foreach($sl3 as $s3){?>
                        <div>                    
                            <div class="wp48 m20 fleft mb15">
                                <ul class="wp100 fleft" style="overflow: hidden; white-space: nowrap; text-overflow: clip">
                                    <li class="tableg lihidden"><?php echo $s3['sname'];?></li>                                   
                                    <li class="tableg lihidden"><?php 
                        			//个数1时间2
					                switch ($s3['grouptype'])
					                {
					                	case 1:
					                		echo $s3['count'].'个/'.$s3['groupcount'].'组';
					                		break;
					                	case 2:
					                		echo $s3['count'].'秒/'.$s3['groupcount'].'组';
					                		break;
					                }
                                    ?></li>
                                    <li class="bianji"><a href="javascript:void(0);" class="tableb btn btn-primary" onclick="adit(<?php echo $s3['id'];?>,3,'');">查看</a></li>
                                    <li></li>
                                </ul>
                            </div>                       
                        </div>
                        <?php }}?>                        
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- 右全部内容 结束-->
<div class="md-overlay"></div>
<script src="__PUBLICROOT__/TrainingManage/js/jquery-1.8.3.min.js"></script>
<script src="__PUBLICROOT__/TrainingManage/js/jquery-labelauty.js"></script>
<link href="__PUBLICROOT__/TrainingManage/css/form.css" rel="stylesheet" type="text/css">
<script src="__PUBLICROOT__/TrainingManage/js/modernizr.custom.js"></script>
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
      	//热身练习拉伸是否显示
        if(<?php echo isset($trainingplanConfig['warmupstatus'])?trim($trainingplanConfig['warmupstatus']):-1;?> == 0)
        {
			$('.reshen').addClass('none');
        }
        if(<?php echo isset($trainingplanConfig['sportitemgroupcount'])?trim($trainingplanConfig['sportitemgroupcount']):-1;?> == 0)
        {
			$('.lianxi').addClass('none');
        }
        if(<?php echo isset($trainingplanConfig['stretchstatus'])?trim($trainingplanConfig['stretchstatus']):-1;?> == 0)
        {
			$('.lashen').addClass('none');
        }
      	//通过按钮
        $('#trainingplanBasePass').click(function(){
    		var trainingplan_base_id = $("#hiddentrainingplan_base_id").val();
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
    //跳转到课程设计基本属性页面
    function doTrainingplanBaseCheckDetail(id)
    {
    	var url = "<?php echo U('TrainingplanBaseCheckDetail/index',array('id'=>'idVal'));?>".replace('idVal',id);
    	window.location.href = url;
    }

    //查看动作
    function adit(id,utype,sort)
    {
    	var outline_id = $("input[name='hiddenoutline_id']").val();
    	var outline_detail_id = $("input[name='hiddenoutline_detail_id']").val();
    	var trainingplan_base_id =	$("input[name='hiddentrainingplan_base_id']").val();
    	var sportitemgroupcount = $("input[name='hiddensportitemgroupcount']").val();
    	//btbid
    	//document.getElementById('btsdid').value = id;
    	//document.getElementById('btbid').value = trainingplan_base_id;
    	//usort
    //	document.getElementById('usort').value = sort;
    	$.ajax({	
    		url:"__URL__/sportitemgUpdateIndex",
    		type:'post',
    		data: {
    			'trainingplan_outline_detail_sportitem_id':id,
    			'outline_id':outline_id,
    			'outline_detail_id':outline_detail_id,
    			'trainingplan_base_id':trainingplan_base_id,
    			'sportitemgroupcount':sportitemgroupcount,
    			'sportitemgrouptype':utype
    			},
    		'datatype':'json',
    		success:function(jsondata){
    			//console.log(jsondata);
    			var namehtml = '';
				//console.log(jsondata);
				//把数据展示到前台画面
				for(var i=0;i<jsondata.length-1;i++)
				{
					//console.log(jsondata[i]);
					//namehtml +='<div class="fleft wp25 h50 mr20"><input type="checkbox" name="addsportitem_base_id" data-labelauty="'+jsondata[i].name+'" class="chk_3" value="'+jsondata[i].sbid+'"/></div>';
					//console.log(html);
					namehtml +='<div class="fleft wp25 h50 mr20 spid">'
					+'<input id="labelauty-'+jsondata[i].sbid+'" class="chk_3 labelauty usportitem_base_id" style="overflow: hidden; white-space: nowrap; text-overflow: clip" type="radio" name="usportitem_base_id" style="display: none;" value="'+jsondata[i].sbid+'">'
					+'<label for="labelauty-'+jsondata[i].sbid+'">'
					+'<span class="labelauty-unchecked-image"></span>'
					+'<span class="labelauty-unchecked" style="">'+jsondata[i].name+'</span>'
					+'<span class="labelauty-checked-image"></span>'
					+'<span class="labelauty-checked">'+jsondata[i].name+'</span>'
					+'</label>'
					+'</div>';		
				}
				$("#usportitem_base_id").html(namehtml);
				var leng = jsondata.length;
				 //console.log(leng);
				$('#ucount').val(jsondata[leng-1]['count']);
				$('#ugroupcount').val(jsondata[leng-1]['groupcount']);
				$('#ugrouptype option').each(function(){
					//console.log($(this).val());
					if($(this).val() == jsondata[leng-1]['grouptype'])
					{
						$(this).attr('selected',true);
					}
				});
				//input[name='ucount']
				 $("input[name='usportitem_base_id']").each(function(){
					//console.log($(this).val());
			            if($(this).val() == jsondata[leng-1]['sbid'])
				        {  
			                $(this).attr('checked','checked');
			            }  
			    });
								
				//console.log(jsondata[leng-1]['sbid']);
    		},
    	});
    	$('#modal-5').addClass('md-show');
    }
</script>
<style>
.lihidden{
overflow: hidden; white-space: nowrap; text-overflow: ellipsis
}
</style>