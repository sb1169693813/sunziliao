    <!-- 右全部内容开始 开始-->  
        <!-- 内容开始-->
        <div class="line-full content-wrap">
            <div class="line-full t-position">
                <span>当前位置：</span>
                <span>课程管理</span>
                <!-- <span>&gt;</span>
                <span>用户管理</span> -->
            </div>
            <!--主体-->
            <div class="line-full content-blue1" style="min-height:400px;">
                <div class="tab-left fleft">                             
                    <ul class="btorange">
                        <?php if(isset($daycount)){for($i=0;$i<$daycount;$i++){?>                               
		                <li id="on<?php echo $i+1;?>" class="">
		                <!--  
		                <a href="<?php //echo U('OutlineDetailsportitemgroup/index',
		                //array(
		                //	'day'=>$i+1
		                //)
	                 	//);?>">第<?php //echo $i+1;?>节 </a>
	                 	-->
	                 	 <a href="javascript:void(0);" onclick="addOn(<?php echo $i+1;?>)">第<?php echo $i+1;?>节 </a>
	                 	</li>
	                 	<?php }}?>
                    </ul>
                    <div class="fleft save-line1 line-full tcenter mt20 ">
                    	<!--
                        <a href="javascript:void(0);"  class="blue shangyibu">上一步</a>
                        <a href="javascript:void(0);" class="blue" id="cmit">提交审核</a>
                        -->
                        <input type="button" class="blue shangyibu hand" value="上一步"/>
                        <input type="button" class="blue hand" id="cmit" value="提交审核"/>
                    </div>
                </div>
                <div class="tab-right fleft">
                    <div class="mt20 ft14 fgree1  h40">
                        <span id="circle">1</span> <span class="w130 fleft"> <a class="fgray" href="javascript:void(0);" id="doOutlineDetail">大纲基本属性 >> </a> </span>
                        <span id="on">2</span> <span class="w130 fleft"> <a href="javascript:void(0);">大纲动作列表 >> </a> </span>
                        <a href="<?php echo U('ActionReference/index')?>" class="instrument-name ml30 " style="color:#47B4A7;" target="_blank">动作库名称参考</a>
                    </div>
                    <div class="mb20">
                        <span style="color:red;margin-left:12px;">  单天重点</span>
                        <select name="bodypart" id="bodypart">
                        	<option value="">请选择</option>
                            <option value="1">心肺耐力</option>
                            <option value="2">肌肉适能</option>
                            <option value="3">柔韧</option>
                            <option value="4">平衡</option>
                            <option value="5">灵敏</option>
                            <option value="6">全身</option>
                            <option value="7">全身偏上</option>
                            <option value="8">全身偏下</option>
                            <option value="9">全身偏躯干</option>
                            <option value="10">上肢下肢</option>
                            <option value="11">上肢躯干</option>
                            <option value="12">下肢躯干</option>
                            <option value="13">上肢</option>
                            <option value="14">躯干</option>
                            <option value="15">下肢</option>
                        </select>
                    </div>
                    <div class=" content-blue1 fright ml20">
                        <div class="line-full head" style="border-radius: 6px;">
                            <div class="wp96auto">
                                <div class="fleft">热身阶段</div>
                                <a class="new-a1 showbox3" href="javascript:void(0);">
                                    <!--<button class="md-trigger new-a1 showbox3 " data-modal="modal-1">+ 添加</button>-->
                                    <button class=" new-a1 hand" onclick="addType(1);">+ 添加</button>
                                </a>
                            </div>
                        </div>
                        <div class="<?php if(isset($trainingplanOutlineDetailSportitemList1)){echo count($trainingplanOutlineDetailSportitemList1)>0?'pdt10':'';}?>">
                            <?php if(isset($trainingplanOutlineDetailSportitemList1)){foreach($trainingplanOutlineDetailSportitemList1 as $todsList1){?>
								<div class="wp48 fleft mb10 ml10">           
					                    <ul class="wp100 fleft lihidden" >              
					                 <li class="tableg todsname lihidden"><?php echo $todsList1['name'];?></li>
					              <li class="tableg lihidden"><?php echo str_replace(',', '/', $todsList1['targetbodypart']);?></li>
					                <li class="tableg todscount lihidden"> 
					                <?php //个数1时间2
					                switch ($todsList1['grouptype'])
					                {
					                	case 1:
					                		echo $todsList1['count'].'个/'.$todsList1['groupcount'].'组';
					                		break;
					                	case 2:
					                		echo $todsList1['count'].'秒/'.$todsList1['groupcount'].'组';
					                		break;
					                }					                					             					                
					                ?>                           								                
					                </li>
					                  <li>
					                  <!--
					                  <a class="new-a1 showbox3" href="javascript:void(0);">
                                    	<button class=" new-a1 " onclick="addType(1);">+ 添加</button>
                                		</a>
                                		-->	                   
					                  <a href="javascript:void(0);" class="tableb btn btn-primary adit" onclick="adit(<?php echo $todsList1['id'];?>);">编辑</a>
					                  
					                  </li>
					                    <li> <a href="javascript:void(0);" class="tableb btn btn-primary del" onclick="del(<?php echo $todsList1['id'];?>);">删除</a> </li>
					                  </ul> 
					                  <input type="hidden" name="id"/>
				                  </div> 
							<?php }}?>                                                                                  
                        </div>
                    </div>
                    <div class=" content-blue1 fright ml20">
                        <div class="line-full head" style="border-radius: 6px;">
                            <div class="wp96auto">
                                <div class="fleft">练习阶段</div>
                                <a class="new-a1 showbox3" href="javascript:void(0);">
                                	<!--  
                                    <button class="md-trigger new-a1 showbox3 " data-modal="modal-1">+ 添加</button>
                                    -->
                                    <button class=" new-a1 hand" onclick="addType(2);">+ 添加</button>
                                </a>
                            </div>
                        </div>
                        <div class="<?php if(isset($trainingplanOutlineDetailSportitemList2)){echo count($trainingplanOutlineDetailSportitemList2)>0?'pdt10':'';}?>">
                            <?php if(isset($trainingplanOutlineDetailSportitemList2)){foreach($trainingplanOutlineDetailSportitemList2 as $todsList2){?>	
							<div class="wp48 fleft mb10 ml10">           
				                    <ul class="wp100 fleft" >              
				                 <li class="tableg todsname lihidden"><?php echo $todsList2['name'];?></li>
				              <li class="tableg lihidden"><?php echo str_replace(',', '/', $todsList2['targetbodypart']);?></li>
				                <li class="tableg todscount lihidden"> 
				                <?php 
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
					                ?> 				                				                 
					                </li>
				                  <li > <a href="javascript:void(0);" class="tableb btn btn-primary adit" onclick="adit(<?php echo $todsList2['id'];?>);">编辑</a> </li>
				                    <li > <a href="javascript:void(0);" class="tableb btn btn-primary del" onclick="del(<?php echo $todsList2['id'];?>);">删除</a> </li>
				                  </ul> 
				                  <input type="hidden" name="id"/>  
			                  </div> 
						<?php }}?>                                                                                  
                        </div>
                    </div>
                    <div class=" content-blue1 fright ml20">
                        <div class="line-full head" style="border-radius: 6px;">
                            <div class="wp96auto">
                                <div class="fleft">拉伸阶段</div>
                                <a class="new-a1 showbox3" href="javascript:void(0);">
                                	<!--  
                                    <button class="md-trigger new-a1 showbox3 " data-modal="modal-1">+ 添加</button>
                                	-->
                                	<button class=" new-a1 hand" onclick="addType(3);">+ 添加</button>
                                </a>
                            </div>
                        </div>
                        <div class="<?php if(isset($trainingplanOutlineDetailSportitemList3)){echo count($trainingplanOutlineDetailSportitemList3)>0?'pdt10':'';}?>">
                            <?php if(isset($trainingplanOutlineDetailSportitemList3)){foreach($trainingplanOutlineDetailSportitemList3 as $todsList3){?>	
							<div class="wp48 fleft mb10 ml10">           
				                    <ul class="wp100 fleft" >              
				                 <li class="tableg todsname lihidden"><?php echo $todsList3['name'];?></li>
				              <li class="tableg lihidden"><?php echo str_replace(',', '/', $todsList3['targetbodypart']);?></li>
				                <li class="tableg todscount lihidden">
				                	<?php 
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
				                	?> 
				                </li>
				                  <li > <a href="javascript:void(0);" class="tableb btn btn-primary adit" onclick="adit(<?php echo $todsList3['id'];?>);">编辑</a> </li>
				                    <li > <a href="javascript:void(0);" class="tableb btn btn-primary del" onclick="del(<?php echo $todsList3['id'];?>);">删除</a> </li>
				                  </ul>
				                  <input type="hidden" name="id"/>  
			                  </div> 
							<?php }}?>                                                                                  
                        </div>
                    </div>
                    <div class="line-full save-line ">
                    <!--  
                        <a href="#" class="blue mt50" id="sav">保&nbsp;&nbsp;&nbsp;&nbsp;存</a>
                        -->                      
                        <input type="button" class="blue mt50 hand none" id="sav" value="保    存"/>						
						<input type="hidden" name="houtline_id" value="<?php echo isset($outline_id)?$outline_id:'';?>"/>
						<input type="hidden" name="houtline_detail_id" value="<?php echo isset($outline_detail_id)?$outline_detail_id:'';?>"/>
                    </div>
                </div>

            </div>
        </div>
        <!-- 右全部内容 结束-->



<script src="__PUBLICROOT__/TrainingManage/js/jquery-1.8.3.min.js"></script>
<script src="__PUBLICROOT__/TrainingManage/js/jquery-labelauty.js"></script>
<script>
    $(function () {
        $(':input').labelauty();
    });
</script>
<script>
    $(function(){
//        $('#add').on('click',function(){
//            $('#modal-1').addClass('md-show');
//        });
//        $('#save').on('click',function(){
//            $('#modal-2').addClass('md-show');
//            $('#modal-1').removeClass('md-show');
//        });
//        $('#close').on('click',function(){
//            $('#modal-2').removeClass('md-show');
//            $('#modal-1').removeClass('md-show');
//        });
//        $('#return').on('click',function(){
//            $('#modal-2').removeClass('md-show');
//            $('#modal-1').removeClass('md-show');
//        });
		//$('#sav').on('click',function(){
            //$('#modal-1').removeClass('md-show');
       // });
       
       $("#bodypart option").each(function(){
			if($(this).val() == "<?php echo isset($bodypart) ? $bodypart:'';?>")
			{
				$(this).attr("selected",true);
			}
       });
       //第几节显示高亮
       var day = "<?php echo isset($_GET['day'])?trim($_GET['day']):'1';?>";
       <?php for($i=0;$i<$daycount;$i++){?>
       	if(day == "<?php echo $i+1;?>")
		{
			$("#on<?php echo $i+1;?>").addClass('on');
		}
       
       <?php }?>					
       
     	//查看页面1
	   	if(<?php echo $actiontype;?> == 1)
	   	{
			//添加按钮，保存按钮，提交审核按钮，隐藏
			$('.new-a1').addClass('none');
			$('#sav').addClass('none');
			$('#cmit').addClass('none');
			//$('.adit').addClass('none');
			//编辑改成查看
			$('.adit').html('查看');
			$('.del').addClass('none');
			//单天重点
			$("#bodypart").attr('disabled',true);
			//跳转到大纲基本属性
//		      function doOutlineDetail()
//		      {       
//		        <?php //SessionData::setPageData('OutlineDetail', 'outline_id',$outline_id);?>
//		        //var url = "<?php //echo U('OutlineDetail/index')?>";
//		        //window.location.href = url;
//		        		//window.location.href = '<?php //echo U("OutlineDetailsportitemgroup/prev");?>';
//		        		window.location.href = '<?php //echo U("OutlineDetail/index");?>';
//		      }
		      $("#doOutlineDetail").click(function(){
					//window.history.back();
					//window.location.href = '<?php //echo U("OutlineDetailsportitemgroup/prev");?>';
		    	   window.location.href = '<?php echo U("OutlineDetail/index");?>';
		       });
		    //上一步
		       $(".shangyibu").click(function(){
					//window.history.back();
					//window.location.href = '<?php //echo U("OutlineDetailsportitemgroup/prev");?>';
		    	   window.location.href = '<?php echo U("OutlineDetail/index");?>';
		       });
	   	}
		//编辑页面
		if(<?php echo $actiontype;?> == 2)
	   	{
			//跳转到大纲基本属性   
		      $("#doOutlineDetail").click(function(){
		    	   window.location.href = '<?php echo U("OutlineDetail/index");?>';
		       });
		    //上一步
		       $(".shangyibu").click(function(){
		    	   window.location.href = '<?php echo U("OutlineDetail/index");?>';
		       });
	   	}
		
		//新建页面
   		if(<?php echo $actiontype;?> == 3)
	   	{
	   		  //跳转到大纲基本属性
		   	   $("#doOutlineDetail").click(function(){
					window.location.href = '<?php echo U("OutlineDetailsportitemgroup/prev");?>';
		       });
	   	 	//上一步
		       $(".shangyibu").click(function(){
					window.location.href = '<?php echo U("OutlineDetailsportitemgroup/prev");?>';
		       });
	   	      
	   	}
   		
       	//提交审核按钮
		$('#cmit').on('click',function(){
			var outline_id = $("input[name='houtline_id']").val();
			//houtline_detail_id
			//var outline_detail_id = $("input[name='houtline_detail_id']").val();
			if(confirm('确认提交?'))
            {
//	            var bodypart = $('#bodypart').val();
//	            if(bodypart == '')
//	            {
//					alert('请选择单天重点');
//		        }
//	            else
//	            {
	             	$.ajax({
	              		 url:"__URL__/outlineCommit",
	           			type:'post',
	           			data: {
	           				'outline_id':outline_id,
	           				//'outline_detail_id':outline_detail_id,
	           				},
	           			'datatype':'json',
	           			success:function(jsondata)
	           			{
	    	           		//console.log(jsondata[0].code);
                   			if(jsondata[0].code == -3)
               				{
                   				//部分课时还未添加动作，请补充完整再提交审核
               					alert(jsondata[0].msg);
               				}
	           				if(jsondata[0].code == 1)
	           				{
	           					//alert('提交成功');
//	           					window.location.reload();
	           					$("#listCount").html(jsondata[1]);
	                   			$('#modal-3').addClass('md-show');
	           				}
	           				if(jsondata[0].code == -1)
	           				{
	           					//alert('提交失败');
	           					alert(jsondata[0].msg);
	           					//window.location.reload();
	           				}
	           				if(jsondata[0].code == -2)
	           				{
	           					//alert('提交失败');
	           					alert(jsondata[0].msg);
	           					//window.location.reload();
	           				}
//	           				if(jsondata[0].code == 0)
//	           				{
//	           					alert('请添加动作后再提交审核');
//	           				}
	           				if(jsondata[0].code == -4)
	           				{
	           					//请选择当天的单天重点
	           					alert(jsondata[0].msg);
	           				}	
	           				if(jsondata[0].code == -5)
	           				{
	           					//大纲详情动作表更新失败
	           					alert(jsondata[0].msg);
	           				}			
	           			},
	   				});

		       // }
           	//alert('hfjk');
           	
            } 
		});
		//单天重点改变按钮
		$("#bodypart").change(function(){
			//alert($(this).val());
			var outline_id = $("input[name='houtline_id']").val();
    		var outline_detail_id = $("input[name='houtline_detail_id']").val();
			//var bodypart = $("#bodypart option:selected").val();
			var bodypart = $(this).val();
			//alert(bodypart);
			//if(confirm('确认保存?'))
          //  {
           		//alert('hfjk');
           	 	$.ajax({
           		 url:"__URL__/outlineDetailSave",
        			type:'post',
        			data: {
        				'outline_id':outline_id,'bodypart':bodypart,
        				'outline_detail_id':outline_detail_id
        				},
        			'datatype':'json',
        			success:function(jsondata)
        			{
                			//alert(jsondata);
        				if(jsondata.code == 1)
        				{
        					//alert('单天重点保存成功');
        					//alert(jsondata.msg);
        				}
        				if(jsondata.code == -1)
        				{
        					//alert('单天重点保存失败');
        					alert(jsondata.msg);
        				}
        				if(jsondata.code == -2)
        				{
        					//大纲详情不存在
        					alert(jsondata.msg);
        				}
        			},
				});
           // }
		});
       //单天重点保存按钮
//		$("#sav").click(function(){
//			var outline_id = $("input[name='houtline_id']").val();
//    		var outline_detail_id = $("input[name='houtline_detail_id']").val();
//			var bodypart = $("#bodypart option:selected").val();
//			//alert(bodypart);
//			if(confirm('确认保存?'))
//            {
//           		//alert('hfjk');
//           	 	$.ajax({
//           		 url:"__URL__/outlineDetailSave",
//        			type:'post',
//        			data: {
//        				'outline_id':outline_id,'bodypart':bodypart,
//        				'outline_detail_id':outline_detail_id
//        				},
//        			'datatype':'json',
//        			success:function(jsondata)
//        			{
//                			//alert(jsondata);
//        				if(jsondata.code == 1)
//        				{
//        					//alert('单天重点保存成功');
//        					alert(jsondata.msg);
//        					window.location.reload();
//        				}
//        				if(jsondata.code == -1)
//        				{
//        					//alert('单天重点保存失败');
//        					alert(jsondata.msg);
//        				}
//        				if(jsondata.code == -2)
//        				{
//        					//大纲详情不存在
//        					alert(jsondata.msg);
//        				}
//        			},
//				});
//            } 
//		});
//        $("#point").change(function(){
//			var point = $(this).children("option:selected").val();
//			//alert(point);
//			var outline_id = <?php //echo isset($_GET['outline_id'])?trim($_GET['outline_id']):'';?>;
//        	var outline_detail_id = <?php //echo isset($_GET['outline_detail_id'])?trim($_GET['outline_detail_id']):'';?>;
//        	var daycount = <?php //echo isset($_GET['daycount'])?trim($_GET['daycount']):'';?>;
//			window.location.href = url;
//        });

    });
    //跳到第几天
    function addOn(day)
	{    	
		<?php //SessionData::setPageData('OutlineDetailsportitemgroup', 'day','dayVal');?>
		var url = "<?php echo U('OutlineDetailsportitemgroup/index',array('day'=>'dayVal'));?>".replace('dayVal',day);
		window.location.href = url;
	}
    //添加
    function addType(type)
    {
            //alert(type);
        $('#modal-1').addClass('md-show');
        //$('#modal-1').addClass('md-overlay');
        //var outline_id = <?php //echo isset($_GET['outline_id'])?trim($_GET['outline_id']):'';?>;
        //var outline_detail_id = <?php //echo isset($_GET['outline_detail_id'])?trim($_GET['outline_detail_id']):$outlineDetailId[0];?>;
        //alert(outline_detail_id);
        //console.log(type);
        var outline_id = $("input[name='houtline_id']").val();
    	var outline_detail_id = $("input[name='houtline_detail_id']").val(); 
        document.getElementById('sportitemgrouptype').value = type;
        document.getElementById('outline_id').value = outline_id;
        document.getElementById('outline_detail_id').value = outline_detail_id;
        //alert(outline_detail_id);
        //$('#sportitemgrouptype').val(type);
     }
        
     //编辑
     function adit(id)
     {
        document.getElementById('outline_detail_sportitem_id').value = id;	
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
        		//编辑
        		if(<?php echo $actiontype;?> == 2)
        	   	{
        			$("#updatetargetmuscles").val(jsondata.targetmuscles);
        	   	}
        	   	//新建页面的编辑
        		if(<?php echo $actiontype;?> == 3)
        	   	{
        			$("#updatetargetmuscles").val(jsondata.targetmuscles);
        	   	}
        	   	//查看
        		if(<?php echo $actiontype;?> == 1)
        	   	{
        			$("#updatetargetmusclesDiv").html(jsondata.targetmuscles);
        	   	}
        		
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

      //删除
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
        			if(jsondata.code ==1)
        			{
        				//alert('删除成功');
        				alert(jsondata.msg);
        				window.location.reload();
        			}
        			if(jsondata.code ==-1)
        			{
        				//alert('删除失败');
        				alert(jsondata.msg);
        			}
        		},
        	});
        }
      }

      
</script>
<script src="__PUBLICROOT__/TrainingManage/js/follow.js" type="text/javascript"></script>
<script src="__PUBLICROOT__/TrainingManage/js/classie.js"></script>
<script src="__PUBLICROOT__/TrainingManage/js/modalEffects.js"></script>
<link href="__PUBLICROOT__/TrainingManage/css/form.css" rel="stylesheet" type="text/css">
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