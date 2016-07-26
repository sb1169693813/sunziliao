        <!-- 内容开始-->
        <div class="line-full content-wrap">
            <div class="line-full t-position">
                <span>当前位置：</span>
                <span>课程管理</span>
            </div>
            <!-- 蓝包开始2  table  -->
            <div class="cls_tab_nav">
                <ul>
                    <li class="cls_tab_nav_li <?php echo $auditstatus==''?'on':'';?>" style="margin-left:0px;" onclick="addFirst('');">全部</li>
                    <li class="cls_tab_nav_li <?php echo $auditstatus=='2'?'on':'';?>" onclick="addFirst(2);">已审核</li>
                    <li class="cls_tab_nav_li <?php echo $auditstatus=='-1'?'on':'';?>" onclick="addFirst(-1);">未通过</li>
                    <li class="cls_tab_nav_li <?php echo $auditstatus=='1'?'on':'';?>" onclick="addFirst(1);">待审核</li>
                </ul>
                <!--<div class="fright-o"><a href="1.2-course-outline.html">新建</a></div>-->
            </div>
            <div class="line-full content-blue">
                <div class="line-full content posr">
                    <div class="wp96auto">
                        <!-- table 包-->
                        <table class="table-100">
                            <colgroup>
                                <!--	1	 -->
                                <col width="" align="" class="wp16">
                                <!--	2	 -->
                                <col width="" align="" class="wp8">
                                <!--	3	 -->
                                <col width="" align="" class="wp7">
                                <!--	4	 -->
                                <col width="" align="" class="wp9">
                                <!--	5	 -->
                                <col width="" align="" class="wp9">
                                <!--	6	 -->
                                <col width="" align="" class="wp15">
                                <!--	7	 -->
                                <col width="" align="" class="wp15">
                                <!--	8	 -->
                                <col width="" align="" class="wp10">
                            </colgroup>
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
                                <td colspan="8"></td>
                            </tr>
                            <?php if(isset($trainingplanOutlineList)){foreach ($trainingplanOutlineList as $toList){?>
                            <tr>
                                <td><?php echo $toList['name'];?></td>
                                <td>
                                <?php 				
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
								?>
                                </td>
                                <td>
                                <?php 
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
				                ?>
                                </td>
                                <td>
                                <?php
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
				                 ?>
                                </td>
                                <td class="<?php echo $toList['auditstatus']==-1?'fred':'';?>">
                                <?php 
				                switch ($toList['auditstatus'])
				                {
				                	case 0:
				                		echo '未提交 ';
				                	break;
				                	case 1:
				                 		echo '待审核';
				                 	break;
				                 	case 2:
				                 		echo '已审核';
				                 	break;
				                 	case -1:
				                 		echo '未通过';
				                 	break;
				                }
				                ?>
                                </td>
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
				                ?></td>
                                <td>                                	
                                	<?php 
                                	//审核通过
                                	if($toList['auditstatus']==2)
                                	{
                                		echo "<a href=";
                                		 echo U('OutlineCheckList/check',array('id'=>$toList['id']));
                                		 echo  " class='a1'>查看</a>";
                                	}
                                	else
                                	{
                                		echo "<a href=";
                                		 echo U('OutlineCheckList/check',array('id'=>$toList['id']));
                                		 echo  " class='a1'>审核</a>";
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
    <!-- 右全部内容 结束-->
    <script type="text/javascript">
                     $(function(){                  		
                          // var lheight=$(".menu-right-warp").height();
                         //  $(".menu-left-warp").css("min-height",lheight);
                          //$.fn.TableLock({table:'lockTable',lockRow:1,lockColumn:2,width:'100%',height:'300px'});
//						var auditstatus = "<?php //echo isset($_GET['auditstatus'])?trim($_GET['auditstatus']):'';?>";
//						//全部
//						if(auditstatus == '')
//						{
//							$("#first1").addClass('on');
//						}
//						//已审核
//						if(auditstatus == '2')
//						{
//							$("#first2").addClass('on');
//						}
//						//未通过
//						if(auditstatus == '-1')
//						{
//							$("#first3").addClass('on');
//						}
//						//待审核
//						if(auditstatus == '1')
//						{
//							$("#first4").addClass('on');
//						}												
                     });

                    function addFirst(auditstatus)
                 	{            	
                 		var url = "<?php echo U('OutlineCheckList/index',array('auditstatus'=>'auditstatusVal'));?>".replace('auditstatusVal',auditstatus);
                 		window.location.href = url;
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