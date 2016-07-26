 <!--  
<div class="md-modal md-effect-1 box4" id="modal-4">
    <h2>添加动作</h2>
</div>
-->
<!--
<div class="md-modal md-effect-2 box4" id="modal-6">
    <h2>添加动作</h2>

    <div class="mainlist">

        <div class="wp100wrap tcenter ft16">
            您的课程大纲已保存
            <p>有<span class="forange ft30">18</span>个动作需要提交详细
        </div>
    </div>
    <div class="line-full save-line wp100 fleft">
        <input type="button" value="查&nbsp;&nbsp;&nbsp;看" class="blue md-close">
    </div>
</div> 
 -->
        <!-- 内容开始-->
        <div class="line-full content-wrap">
            <div class="line-full t-position">
                <span>当前位置：</span>
                <span>课程管理</span>
                <!-- <span>&gt;</span>
                <span>用户管理</span> -->
            </div>
            <!-- 蓝包开始1 -->
            <div class="line-full content-blue1 ">
                <div class="tab-right " style="margin:0 auto;">
                    <div class="mt20 ft14 fgree1  h40 ml0">
                        <span id="circle">1</span> <span class="w130 fleft"> <a class="fgray" href="javascript:void(0);" onclick="doTrainingplanBaseDetail();">基本信息 >> </a> </span>
                        <span id="on">2</span> <span class="w130 fleft"> <a href="javascript:void(0);">动作设计 >> </a> </span>
                    </div>
                    <div class="mb20">
                    </div>
                    
                    <div class=" content-blue1 fright ml20 reshen">
                        <div class="line-full head" style="border-radius: 6px;">
                            <div class="wp96auto">
                                <div class="fleft">热身阶段</div>
                                <a class="new-a1 showbox3" href="javascript:void(0);">
                                	<!--  
                                    <button class="md-trigger new-a1 showbox3 " data-modal="modal-1">+ 添加</button>
                                	-->
                                	<button class=" new-a1 hand" onclick="addType(1,'');">+ 添加</button>
                                </a>
                            </div>
                        </div>
                        <?php if(isset($sList1)){foreach($sList1 as $s1){?> 	
                        <div>                    
                            <div class="wp48 m20 fleft mb15">
                                <ul class="wp100 fleft">
                                    <li class="tableg lihidden"><?php echo $s1['sname'];?></li>                                   
                                    <li class="tableg lihidden">
                                    <?php 
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
				                	?>                                   
                                    </li>
                                    <li class="bianji"><a href="javascript:void(0);" class="tableb btn btn-primary" onclick="adit(<?php echo $s1['id'];?>,1,'');">编辑</a></li>
                                    <li class="shanchu"><a href="javascript:void(0);" class="tableb btn btn-primary" onclick="del(<?php echo $s1['id'];?>);">删除</a></li>
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
                                	<!--
                                    <button class="md-trigger new-a1 showbox3 " data-modal="modal-1">+ 添加</button>
                                    -->
                                    <button class=" new-a1 hand" onclick="addType(2,<?php echo $i+1;?>);">+ 添加</button>
                                </a>
                            </div>
                        </div>
                        <?php if(isset($sList2)){foreach($sList2 as $s2){?>
                        <div class="<?php echo isset($s2[$i])?'':'none';?>">                    
                            <div class="wp48 m20 fleft mb15">
                                <ul class="wp100 fleft">
                                    <li class="tableg lihidden"><?php echo isset($s2[$i]['sname'])?$s2[$i]['sname']:null;?></li>                                   
                                    <li class="tableg lihidden"><?php 
                        			//个数1时间2
                        			if(isset($s2[$i]['grouptype']) || isset($s2[$i]['count']) || isset($s2[$i]['groupcount']))
                        			{
	                        			switch ($s2[$i]['grouptype'])
						                {
						                	case 1:
						                		echo $s2[$i]['count'].'个/'.$s2[$i]['groupcount'].'组';
						                		break;
						                	case 2:
						                		echo $s2[$i]['count'].'秒/'.$s2[$i]['groupcount'].'组';
						                		break;
						                }                        				
                        			}
					                
					                
                                    ?></li>
                                    <li class="bianji"><a href="javascript:void(0);" class="tableb btn btn-primary" onclick="adit(<?php echo isset($s2[$i]['id'])?$s2[$i]['id']:null;?>,2,<?php echo isset($s2[$i]['sort'])?$s2[$i]['sort']:null;?>);">编辑</a></li>
                                    <li class="shanchu"><a href="javascript:void(0);" class="tableb btn btn-primary" onclick="del(<?php echo isset($s2[$i]['id'])?$s2[$i]['id']:null;?>);">删除</a></li>
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
                                	<!--  
                                    <button class="md-trigger new-a1 showbox3 " data-modal="modal-1">+ 添加</button>
                                    -->
                                    <button class=" new-a1 hand" onclick="addType(3,'');">+ 添加</button>
                                </a>
                            </div>
                        </div>
                        <?php if(isset($sList3)){foreach($sList3 as $s3){?>
                        <div>                    
                            <div class="wp48 m20 fleft mb15">
                                <ul class="wp100 fleft">
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
                                    <li class="bianji"><a href="javascript:void(0);" class="tableb btn btn-primary" onclick="adit(<?php echo $s3['id'];?>,3,'');">编辑</a></li>
                                    <li class="shanchu"><a href="javascript:void(0);" class="tableb btn btn-primary" onclick="del(<?php echo $s3['id'];?>);">删除</a></li>
                                </ul>
                            </div>                       
                        </div>
                        <?php }}?>
                    </div>
                    
                    <div class="line-full save-line ">
                    <!--  
                        <a href="" class="blue mt50 id="tijiaoshenhe">提交审核</a>
						-->
						<input type="button" class="blue mt50 hand" id="tijiaoshenhe" value="提交审核"/>
						<input type="hidden" name="hiddenoutline_id" value="<?php echo isset($trainingplanBase['outline_id']) ? $trainingplanBase['outline_id']:'';?>"/>
						<input type="hidden" name="hiddenoutline_detail_id" value="<?php echo isset($trainingplanBase['outline_detail_id']) ? $trainingplanBase['outline_detail_id']:'';?>"/>
                    	<input type="hidden" name="hiddensportitemgroupcount" value="<?php echo isset($trainingplanConfig['sportitemgroupcount']) ? trim($trainingplanConfig['sportitemgroupcount']):'';?>"/>
                    	<input type="hidden" name="hiddentrainingplan_base_id" value="<?php echo isset($trainingplanBase['id']) ? $trainingplanBase['id']:'';?>"/>
                    </div>
                </div>


                <!-- 蓝包结束1-->

            </div>

            <!-- 内容结束-->
            <!-- <div class="line-full copyright">

               公司版权所有<br>公司版权所有@公司版权所有@公司版权所有@公司版权所有@

             </div> -->


        </div>
        <!-- 右全部内容 结束-->
<div class="md-overlay"></div>

<!--  
<script src="__PUBLICROOT__/TrainingManage/js/jquery-1.8.3.min.js"></script>
-->
<script src="__PUBLICROOT__/TrainingManage/js/jquery-labelauty.js"></script>
<script>
    $(function () {
        $(':input').labelauty();        
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
		//查看页面
        if(<?php echo $actiontype;?> == 1)
        {
			//添加按钮隐藏
			$('.new-a1').addClass('none');
			//编辑按钮改为查看
			//$('.bianji').addClass('none');
			$('.bianji a').html('查看');
			//删除按钮隐藏
			$('.shanchu').addClass('none');
			//隐藏提交审核按钮
			$('#tijiaoshenhe').addClass('none');
        }

        //编辑页面
        if(<?php echo $actiontype;?> == 2)
        {
        	//提交审核按钮
            $("#tijiaoshenhe").click(function(){     
                var trainingplan_base_id = $("input[name='hiddentrainingplan_base_id']").val();
                if(confirm('确认提交审核?'))
            	{
                	$.ajax({
                		url:"__URL__/commit",
                		type:'post',
                		data: {
                			'trainingplan_base_id':trainingplan_base_id
                			},
                		'datatype':'json',
                		success:function(jsondata){
                    		//alert(jsondata);
                			if(jsondata.code == 1)
                			{
                				alert('提交审核成功');
                				//alert(jsondata.msg);
                				window.location.href="<?php echo U('TrainingplanBaseList/index');?>";
                			}
                			if(jsondata.code == -1)
                			{
                				//alert('提交审核失败');插入方案表日志失败
                				alert(jsondata.msg);
                			}
                			if(jsondata.code == -2)
                			{
                				//alert('提交审核失败');更新课程设计审核状态失败
                				alert(jsondata.msg);
                			}
//                			if(jsondata.code == -3)
//                			{
//                				alert(jsondata.msg);
//                			}
                		},
                	});	
            	}           	
            });
        }      
    });
  	//添加动作
    function addType(atype,sort)
    {             
    	var outline_id = $("input[name='hiddenoutline_id']").val();
    	var outline_detail_id = $("input[name='hiddenoutline_detail_id']").val();
    	var trainingplan_base_id =	$("input[name='hiddentrainingplan_base_id']").val();
    	var sportitemgroupcount = $("input[name='hiddensportitemgroupcount']").val();
		//alert(atype);
    	document.getElementById('stype').value = atype;
    	document.getElementById('oid').value = outline_id;
    	document.getElementById('odid').value = outline_detail_id;
    	document.getElementById('tbid').value = trainingplan_base_id;
    	document.getElementById('addsort').value = sort;
//    	console.log(outline_id);
//    	console.log(outline_detail_id);
//    	console.log(trainingplan_base_id);
//    	console.log(sportitemgroupcount);
    	$.ajax({
    		url:"__URL__/sportitemgAddIndex",
    		type:'post',
    		data: {
    			'outline_id':outline_id,
    			'outline_detail_id':outline_detail_id,
    			'trainingplan_base_id':trainingplan_base_id,
    			'sportitemgroupcount':sportitemgroupcount,
    			'sportitemgrouptype':atype,
    			},
    		'datatype':'json',
    		success:function(jsondata){	
    			
				var namehtml = '';
				//console.log(jsondata.length);
				for(var i=0;i<jsondata.length;i++)
				{
					//console.log(jsondata[i]);
					//namehtml +='<div class="fleft wp25 h50 mr20"><input type="checkbox" name="addsportitem_base_id" data-labelauty="'+jsondata[i].name+'" class="chk_3" value="'+jsondata[i].sbid+'"/></div>';
					//console.log(html);
					namehtml +='<div class="fleft wp25 h50 mr20 spid">'
					+'<input id="labelauty-'+jsondata[i].sbid+'" class="chk_3 labelauty" type="radio" name="asportitem_base_id" style="display: none;" value="'+jsondata[i].sbid+'">'
					+'<label for="labelauty-'+jsondata[i].sbid+'">'
					+'<span class="labelauty-unchecked-image"></span>'
					+'<span class="labelauty-unchecked" style="">'+jsondata[i].name+'</span>'
					+'<span class="labelauty-checked-image"></span>'
					+'<span class="labelauty-checked">'+jsondata[i].name+'</span>'
					+'</label>'
					+'</div>';
					//console.log(jsondata[i]);
				}
				$("#asportitem_base_id").html(namehtml);
				//console.log(namehtml);
				//console.log(namehtml);
				
    		},
    	});	
    	$('#modal-4').addClass('md-show');
    }
    
    //编辑动作
    function adit(id,utype,sort)
    {
    	var outline_id = $("input[name='hiddenoutline_id']").val();
    	var outline_detail_id = $("input[name='hiddenoutline_detail_id']").val();
    	var trainingplan_base_id =	$("input[name='hiddentrainingplan_base_id']").val();
    	var sportitemgroupcount = $("input[name='hiddensportitemgroupcount']").val();
    	//btbid
    	document.getElementById('btsdid').value = id;
    	document.getElementById('btbid').value = trainingplan_base_id;
    	//usort
    	document.getElementById('usort').value = sort;
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
					namehtml +='<div class="fleft wp25 mr20 h50 spid">'
					+'<input id="labelauty-'+jsondata[i].sbid+'" class="chk_3 labelauty usportitem_base_id"  style="overflow: hidden; white-space: nowrap; text-overflow: clip" type="radio" name="usportitem_base_id" style="display: none;" value="'+jsondata[i].sbid+'">'
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

    //删除动作
    function del(id)
    {	
    	if(confirm('确认删除'))
    	{
    		$.ajax({
    			url:"__URL__/sportitemgDel",
    			type:'post',
    			data: {
    				'id':id
    				},
    			'datatype':'json',
    			success:function(jsondata){
    	    		//alert(jsondata);
    				if(jsondata.code == 1)
    				{
    					//alert('删除成功');
    					alert(jsondata.msg);
    					window.location.reload();
    				}
    				if(jsondata.code == -1)
    				{
    					//alert('删除失败');
    					alert(jsondata.msg);
    				}
    			},
    		});
    	}
    }

    //大纲基本属性按钮
    function doTrainingplanBaseDetail()
    {
        //alert(111);
    	<?php SessionData::setPageData('TrainingplanBaseDetail', 'trainingplan_base_id',$trainingplanBase['id']);?>
		var url = "<?php echo U('TrainingplanBaseDetail/index')?>";
		//alert(url);
    	window.location.href = url;
    }
</script>

  <!--  
<script src="__PUBLICROOT__/TrainingManage/js/gg_bd_ad_720x90.js" type="text/javascript"></script>
<script src="__PUBLICROOT__/TrainingManage/js/follow.js" type="text/javascript"></script>
-->

<script src="__PUBLICROOT__/TrainingManage/js/classie.js"></script>
<script src="__PUBLICROOT__/TrainingManage/js/modalEffects.js"></script>
<link href="__PUBLICROOT__/TrainingManage/css/form.css" rel="stylesheet" type="text/css">
<script src="__PUBLICROOT__/TrainingManage/js/modernizr.custom.js"></script>
<!-- for the blur effect -->
<!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
<script>
    // this is important for IEs
    var polyfilter_scriptpath = '/js/';
</script>
<script src="__PUBLICROOT__/TrainingManage/js/cssParser.js"></script>
<script src="__PUBLICROOT__/TrainingManage/js/css-filters-polyfill.js"></script>
<style>
.lihidden{
overflow: hidden; white-space: nowrap; text-overflow: ellipsis
}
</style>