<!-- 内容开始-->
                    <div class="line-full content-wrap">
                       <div class="line-full t-position">
                          <span>当前位置：</span>
                        <span>课程管理</span>
                        <!-- <span>&gt;</span>
                        <span>用户管理</span> -->
                         </div>

                          <!-- 蓝包开始2  table  -->
                              <div class="cls_tab_nav">
  <ul>
   <li class="cls_tab_nav_li <?php echo $auditstatus==''?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst('');">全部</a></li>
   <li class="cls_tab_nav_li <?php echo $auditstatus=='2'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(2);">已审核</a></li>
   <li class="cls_tab_nav_li <?php echo $auditstatus=='1'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(1);">审核中</a></li>
   <li class="cls_tab_nav_li <?php echo $auditstatus=='-1'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(-1);">未通过</a></li>
    <li class="cls_tab_nav_li <?php echo $auditstatus=='0'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(0);">未提交</a></li>
  </ul> <div class="fright-o"><a href="<?php echo U('OutlineList/add');?>">新建</a></div>
 </div>
           <div class="line-full content-blue">       
             <div class="line-full">
                <div class="wp96auto">
                  </div>
                </div>
            <div class="line-full content posr">
            <div class="loading2  none mt-12"></div>
               <div class="loading mt-12 none">处理中</div>
                <div class="wp96auto">
               <!-- table 包-->
               <table class="table-100">
                 <colgroup >
            <!--	1	 --><col width="" align="" class="wp16">
            <!--	2	 --><col width="" align="" class="wp8">
            <!--	3	 --><col width="" align="" class="wp7">
            <!--	4	 --><col width="" align="" class="wp9">
            <!--	5	 --><col width="" align="" class="wp9">
            <!--	6	 --><col width="" align="" class="wp13">
            <!--	7	 --><col width="" align="" class="wp13">
            <!--	8	 --><col width="" align="" class="wp20">
                            </colgroup >
              <thead class="tcenter">
              	<tr>
                <td>大纲名称</td>
                <td>类型</td>
                <td>难易</td>
                <td>重点</td>
                <td>审核状态</td>
                <td>创建日期</td>
                <td>审核时间</td>
                <td>操作</td>
                </tr>
              </thead>
              <tbody class="tcenter">
	              <tr class="tr-blank">
	                <td colspan="8" ></td>
	               </tr>
              	<?php
              	if(isset($trainingplanOutlineList)){foreach ($trainingplanOutlineList as $toList){?>
  			   <tr>
                <td><?php echo $toList['name'];?></td>
				<td><?php 				
				switch ($toList['type'])
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
				?></td>
                <td><?php 
                switch($toList['level'])
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
                ?></td>
                <td><?php
                 switch ($toList['bodypart'])
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
                 ;?></td>
                <td class="<?php echo $toList['auditstatus']==-1?'fred':'';?>"><?php 
                switch ($toList['auditstatus'])
                {
                	case 0:
                		echo '未提交 ';
                	break;
                	case 1:
                 		echo '审核中';
                 	break;
                 	case 2:
                 		echo '已审核';
                 	break;
                 	case -1:
                 		echo '未通过';
                 	break;
                }
                ?></td>
                <td><?php echo date('Y-m-d H:i',strtotime($toList['obj_createdate']));?></td>
                <td><?php 
                if($toList['auditdate'] != '')
                {
                	echo date('Y-m-d H:i',strtotime($toList['auditdate']));
                }
                else
                {
                	echo '--';
                }
                ;?></td>
                <td>
                <!--  
                0未提交 1审核中 2 已审核  -1 审核未通过
审核中  可以编辑和提交
未提交  可以查看,编辑和提交 
未通过  可以查看,编辑和提交
已审核  只能查看        
                -->
                  
                <a href="<?php echo U('OutlineList/view',
                array('outline_id'=>$toList['id']));?>" class="a1">查看</a>
                
               <?php 
                //if($toList['auditstatus'] == 1)
//                	{
//                		echo '<a href="" class="a1 none">查看</a>';
//                		
//                	}
//                	else
//                	{
//                		echo '<a href=" ';
//                		echo U('OutlineList/view',
//                		array('outline_id'=>$toList['id']));
//                	echo ' " class="a1">查看</a>';
//                	}	
                ?>
                
                <?php if($toList['auditstatus'] == 2)
                	{
                		echo '<a href="" class="a1 none">编辑</a>';
                		
                	}
                	else
                	{
                		echo '<a href=" ';
                		echo U('OutlineList/update',
                		array('outline_id'=>$toList['id']));
                	echo ' " class="a1">编辑</a>';
                	}	
                	?>
                <?php if($toList['auditstatus'] == 2 )
                {
                	echo '<a href="javascript:void(0);" class="a1 none commit">提交</a>';
                	
                }
                else
                {
                	echo '<a href="javascript:void(0);" class="a1 commit" onclick="commit('.$toList['id'].');">提交</a>';
                }
               	?>
                </td>
               </tr>
    		   <?php }}?>
              </tbody>
              </table>
                 <!-- 分页符开始 --> <!-- pagechoosen 为当前页样式-->                   
				  <div class="thepage-wrap">
                        <span class="total">共<?php echo $totalcount;?>条记录</span>                        							 							                        
                        <div class="thepage fright" >
                        <?php echo $page; ?>
                        	<!--  					
                            <a class="page" href="#"> 第一页</a>
                            <a class="page" href="#"> 上一页</a>
                            <a class="on" href="#"> 1</a>
                            <a class="page" href="#"> 2</a>
                            <a class="page" href="#"> 3</a>
                            <a class="page" href="#"> 4</a>
                            <a class="page" href="#"> 5</a>
                            <a class="page" href="#"> 下一页</a>
                            <a class="page" href="#"> 最后一页</a>
                            -->
                            <input type="hidden" name="pageIndex" id="pageIndex"/>                           
                        </div>                    							                                                                             
                    </div>
				  
				 <!-- 分页符结束 -->
                  </div>
                </div>
             </div>
           <!-- 蓝包结束2 table-->

                 </div>
          <!-- 内容结束-->
           <script type="text/javascript">
                     $(function(){       		
                          // var lheight=$(".menu-right-warp").height();
                         //  $(".menu-left-warp").css("min-height",lheight);
                          //$.fn.TableLock({table:'lockTable',lockRow:1,lockColumn:2,width:'100%',height:'300px'});
//						var auditstatus = "<?php //echo isset($_GET['auditstatus'])?trim($_GET['auditstatus']):'';?>";
//						if(auditstatus == '')
//						{
//							$("#first1").addClass('cls_tab_nav_li_first');
//						}
//						if(auditstatus == '2')
//						{
//							$("#first2").addClass('cls_tab_nav_li_first');
//						}
//						if(auditstatus == '1')
//						{
//							$("#first3").addClass('cls_tab_nav_li_first');
//						}
//						if(auditstatus == '-1')
//						{
//							$("#first4").addClass('cls_tab_nav_li_first');
//						}
//						if(auditstatus == '0')
//						{
//							$("#first5").addClass('cls_tab_nav_li_first');
//						}
                     });

                    function addFirst(auditstatus)
                 	{
                     	
                 		var url = "<?php echo U('OutlineList/index',array('auditstatus'=>'auditstatusVal'));?>".replace('auditstatusVal',auditstatus);
                 		window.location.href = url;
                 	}
                     function commit(outline_id)
                     {
                    	 if(confirm('确认提交?'))
                         {
                        	//alert('hfjk');
                        	 $.ajax({
                        		 url:"__URL__/outlineCommit",
                     			type:'post',
                     			data: {
                     				'outline_id':outline_id
                     				},
                     			'datatype':'json',
                     			success:function(jsondata){
                             			//alert(jsondata);
                             		//console.log(jsondata[0].code);
                             		if(jsondata[0].code == -3)
		               				{
		                   				//部分课时还未添加动作，请补充完整再提交审核
		               					alert(jsondata[0].msg);
		               				}
			           				if(jsondata[0].code == 1)
			           				{
			           					//alert('提交成功');
			           					//window.location.reload();
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
		                     		if(jsondata[0].code == 0)
		                     		{
		                         		//请添加动作后再提交审核
		                     			alert('请添加动作后再提交审核');
		                     		}
		                     		if(jsondata[0].code == -4)
			           				{
			           					//alert('请添加动作后再提交审核');请选择当天的单天重点
			           					alert(jsondata[0].msg);
			           				}
		                     		if(jsondata[0].code == -5)
			           				{
			           					//大纲详情动作表更新失败
			           					alert(jsondata[0].msg);
			           				}
                     			},
    						});
                         } 
                     }
                 </script>
           <style type="text/css">
                 	.content-blue .thepage-wrap {
				margin:10px auto ;
				width:96%;
			
			}

			.content-blue .thepage,.content-blue1 .thepage-wrap {
				 margin:0px auto;
				 display:inline-block;
				 margin-left:280px;
			
			 }

			.thepage a { display:inline-block;padding:3px 10px; height:22px; line-height:24px; color:#000;}
			.thepage a.on,.thepage a:hover{ background:#47b4a7;color:#fff;}
            </style>