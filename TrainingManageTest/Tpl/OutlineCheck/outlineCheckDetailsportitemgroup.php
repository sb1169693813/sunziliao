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
                    <a href="javascript:void(0);" class="a1 pass-a comment-a" id="comment">批注</a>
                </div>
            </div>
            <!--主体-->
            <div class="line-full content-blue1" style="min-height:400px;">
                <div class="tab-left fleft">
                    <ul class="btorange">
                        <?php if(isset($daycount)){for($i=0;$i<$daycount;$i++){?>                               
		                <li id="on<?php echo $i+1;?>" class="">
	                 	 <a href="javascript:void(0);" onclick="addOn(<?php echo $i+1;?>)">第<?php echo $i+1;?>节 </a>
	                 	</li>
	                 	<?php }}?>
                    </ul>                    
                </div>
                <div class="tab-right fleft">
                    <div class="mt20 ft14 fgree1  h40">
                        <span id="circle">1</span> <span class="w130 fleft"> <a class="fgray" href="javascript:void(0);" onclick="doOutlineCheckDetail();">大纲基本属性 >> </a> </span>
                        <span id="on">2</span> <span class="w130 fleft"> <a href="javascript:void(0);">大纲动作列表 >> </a> </span>
                        <a href="<?php echo U('ActionReference/index')?>" class="instrument-name ml30 " style="color:#47B4A7;" target="_blank">动作名称参考</a>
                    </div>
                    <div class="mb20">
                        <span style="color:red;margin-left:12px;">  单天重点</span>
                        <span class="pdl10">             
                        <?php if(isset($bodypart)){
                        	switch($bodypart)
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
							//echo $bodypart;
                         }
                         else
                         {
                         	echo '';
                         }
                         ?>
                        </span>
                    </div>
                    <div class=" content-blue1 fright ml20">
                        <div class="line-full head" style="border-radius: 6px;">
                            <div class="wp96auto">
                                <div class="fleft">热身阶段</div>
                                <a class="new-a1 showbox3" href="javascript:void(0);">
                                    <!--<button class="md-trigger new-a1 showbox3 " data-modal="modal-1">+ 添加</button>-->
                                </a>
                            </div>
                        </div>
                        <div class="<?php echo count($trainingplanOutlineDetailSportitemList1)>0?'pdt10':''?>">
                        <?php if(isset($trainingplanOutlineDetailSportitemList1)){foreach($trainingplanOutlineDetailSportitemList1 as $todsList1){?>
                            <div class="wp48 m20 fleft mb15">
                                <ul class="wp100 fleft" >
                                    <li class="tableg lihidden"><?php echo $todsList1['name'];?></li>
                                    <li class="tableg lihidden"><?php echo str_replace(',', '/', $todsList1['targetbodypart']);?></li>
                                    <li class="tableg lihidden"><?php 
                       				//个数1时间2
					                switch ($todsList1['grouptype'])
					                {
					                	case 1:
					                		echo $todsList1['count'].'个/'.$todsList1['groupcount'].'组';
					                		break;
					                	case 2:
					                		echo $todsList1['count'].'秒/'.$todsList1['groupcount'].'组';
					                		break;
					                }                                                                     
                                    ?></li>
                               		<li > <a href="javascript:void(0);" class="tableb btn btn-primary adit" onclick="adit(<?php echo $todsList1['id'];?>);">查看</a> </li>                                
                                    <!--  
                                    <li><a href="#" class="tableb btn btn-primary">编辑</a></li>
                                    <li><a href="#" class="tableb btn btn-primary">删除</a></li>
                                    -->
                                </ul>
                            </div>
                           <?php }}?>                           
                        </div>
                    </div>
                    <div class=" content-blue1 fright ml20">
                        <div class="line-full head" style="border-radius: 6px;">
                            <div class="wp96auto">
                                <div class="fleft">练习阶段</div>
                                <a class="new-a1 showbox3" href="javascript:void(0);">
                                </a>
                            </div>
                        </div>
                        <div class="<?php echo count($trainingplanOutlineDetailSportitemList2)>0?'pdt10':''?>">
                        <?php if(isset($trainingplanOutlineDetailSportitemList2)){foreach($trainingplanOutlineDetailSportitemList2 as $todsList2){?>
                            <div class="wp48 m20 fleft mb15">
                                <ul class="wp100 fleft">
                                    <li class="tableg lihidden"><?php echo $todsList2['name'];?></li>
                                    <li class="tableg lihidden"><?php echo str_replace(',', '/', $todsList2['targetbodypart']);?></li>
                                    <li class="tableg lihidden"><?php 
                                    //个数1时间2
					                switch ($todsList2['grouptype'])
					                {
					                	case 1:
					                		echo $todsList2['count'].'个/'.$todsList2['groupcount'].'组';
					                		break;
					                	case 2:
					                		echo $todsList2['count'].'秒/'.$todsList2['groupcount'].'组';
					                		break;
					                }                                    
                                    ?></li>                                 
                                	<li > <a href="javascript:void(0);" class="tableb btn btn-primary adit" onclick="adit(<?php echo $todsList2['id'];?>);">查看</a> </li>
                                </ul>

                            </div>
                         <?php }}?>                          
                        </div>
                    </div>
                    <div class=" content-blue1 fright ml20">
                        <div class="line-full head" style="border-radius: 6px;">
                            <div class="wp96auto">
                                <div class="fleft">拉伸阶段</div>
                                <a class="new-a1 showbox3" href="javascript:void(0);">
                                </a>
                            </div>
                        </div>
                        <div class="<?php echo count($trainingplanOutlineDetailSportitemList3)>0?'pdt10':''?>">
                            <?php if(isset($trainingplanOutlineDetailSportitemList3)){foreach($trainingplanOutlineDetailSportitemList3 as $todsList3){?>
                            <div class="wp48 m20 fleft mb15">
                                <ul class="wp100 fleft">
                                    <li class="tableg lihidden"><?php echo $todsList3['name'];?></li>
                                    <li class="tableg lihidden"><?php echo str_replace(',', '/', $todsList3['targetbodypart']);?></li>
                                    <li class="tableg lihidden"><?php 
                                     //个数1时间2
					                switch ($todsList3['grouptype'])
					                {
					                	case 1:
					                		echo $todsList3['count'].'个/'.$todsList3['groupcount'].'组';
					                		break;
					                	case 2:
					                		echo $todsList3['count'].'秒/'.$todsList3['groupcount'].'组';
					                		break;
					                }                             
                                    ?></li>                                    
                                	<li > <a href="javascript:void(0);" class="tableb btn btn-primary adit" onclick="adit(<?php echo $todsList3['id'];?>);">查看</a> </li>                               	
                                </ul>
                            </div>
                            <?php }}?>                            
                        </div>
                    </div>
                    <div class="line-full save-line ">
                    	<!--  
                        <a href="" class="blue mt50">保&nbsp;&nbsp;&nbsp;&nbsp;存</a>
						-->
						<input type="hidden" name="houtline_id" value="<?php echo isset($outline_id)?$outline_id:'';?>"/>
						<input type="hidden" name="houtline_detail_id" value="<?php echo isset($outline_detail_id)?$outline_detail_id:'';?>"/>
                    </div>
                </div>

            </div>
        </div>
        <!-- 右全部内容 结束-->
<div class="md-overlay"></div>


<script src="__PUBLICROOT__/TrainingManage/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="__PUBLICROOT__/TrainingManage/js/jquery-labelauty.js" type="text/javascript"></script>
<link href="__PUBLICROOT__/TrainingManage/css/form.css" rel="stylesheet" type="text/css">
<script src="__PUBLICROOT__/TrainingManage/js/modernizr.custom.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $(':input').labelauty();
    });
</script>
<script type="text/javascript">
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
        })
        $('#close3').on('click', function () {
            $('#pop3').css('display', 'none');
        });
      	//第几节显示高亮
        var day = "<?php echo isset($_GET['day'])?trim($_GET['day']):'1';?>";
        <?php for($i=0;$i<$daycount;$i++){?>
        	if(day == "<?php echo $i+1;?>")
 		{
     		//'"#first'+<?php //echo $i+1;?>+'"'
 			$("#on<?php echo $i+1;?>").addClass('on');
 		}
        
        <?php }?>

        //退件按钮
        $("#detailBounce").click(function(){
        	var outline_id = $("input[name='houtline_id']").val();
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
    
    //大纲基本属性链接
    function doOutlineCheckDetail()
    { 
       	var id = "<?php echo isset($_GET['id'])?trim($_GET['id']):null;?>";     
        var url = "<?php echo U('OutlineCheckDetail/index',array('id'=>'idVal'))?>".replace('idVal',id);
        window.location.href = url;
    }

    //通过按钮
    $('#detailpass').click(function(){
		var outline_id = $("input[name='houtline_id']").val();
		//var outline_detail_id = $("input[name='houtline_detail_id']").val();
		$('#pop2').css('display', 'none');
		if(confirm('确认通过吗?'))
		{
			$.ajax({
          		 url:"__URL__/outlinePass",
       			type:'post',
       			data: {
       				'outline_id':outline_id,
       				//'outline_detail_id':outline_detail_id
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
  	//第几节显示高亮
    function addOn(day)
	{   
    	var id = "<?php echo isset($_GET['id'])?trim($_GET['id']):null;?>";
		var url = "<?php echo U('OutlineCheckDetailsportitemgroup/index',array('id'=>'idVal','day'=>'dayVal'));?>".replace('dayVal',day).replace('idVal',id);
		window.location.href = url;
	}

  	//查看
    function adit(id)
    {
       //document.getElementById('outline_detail_sportitem_id').value = id;	
       $.ajax({	
       	url:"__URL__/sportitemgUpdateIndex",
       	type:'post',
       	data: {
       		'trainingplan_outline_detail_sportitem_id':id
       		},
       	'datatype':'json',
       	success:function(jsondata){
       		//console.log(jsondata);
       		$("#updatename").val(jsondata.name);
       		$("#updatecount").val(jsondata.count);
       		$("#updategroupcount").val(jsondata.groupcount);
       		//$("#updatetargetmuscles").val(jsondata.targetmuscles);
       		$("#updatetargetmuscles").html(jsondata.targetmuscles);
       		$("#updategrouptype option").each(function(){
					if(jsondata.grouptype == $(this).val())
					{
						$(this).attr('selected',true);
					}
           	});
       		$("input[name='updatetargetbodypart']").each(function(){
           		//包含就选中
       			if(jsondata.targetbodypart.indexOf($(this).val())!=-1)
       			{
       				$(this).attr('checked',true);
       			}
       		});
       	},
       });
       $('#modal-2').addClass('md-show');
     }
</script>
<style>
.lihidden{
overflow: hidden; white-space: nowrap; text-overflow: ellipsis;
}
</style>