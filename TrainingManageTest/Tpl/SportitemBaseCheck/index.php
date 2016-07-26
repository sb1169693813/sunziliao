<!-- 内容开始-->
        <div class="line-full content-wrap">
            <div class="line-full t-position">
                <span>当前位置：</span>
                <span>动作库</span>
                <!-- <span>&gt;</span>
                <span>用户管理</span> -->
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
                                <col width="" align="" class="wp12">
                                <!--	4	 -->
                                <col width="" align="" class="wp12">
                                <!--	5	 -->
                                <col width="" align="" class="wp12">
                                <!--	6	 -->
                                <col width="" align="" class="wp16">
                                <!--	7	 -->
                                <col width="" align="" class="wp16">
                                <!--	8	 -->
                                <col width="" align="" class="wp12">
                            </colgroup>
                            <thead class="tcenter">
                            <td>动作名称</td>
                            <td>动作来源</td>
                            <td>审核状态</td>
                            <td>创建日期</td>
                            <td>审核时间</td>
                            <td>操作</td>
                            </thead>
                            <tbody class="tcenter">
                            <tr class="tr-blank">
                                <td colspan="6"></td>
                            </tr>
                            <?php if(isset($sportitemBaseList)){foreach($sportitemBaseList as $sbList){?>
                            <tr>
                                <td class="lihidden"><?php echo $sbList['name'];?></td>
                                <td class="lihidden"><?php echo $sbList['source'];?></td>
                                <td class="<?php echo $sbList['auditstatus']==-1?'fred':'';?>">
                                	<?php 
					                switch ($sbList['auditstatus'])
					                {					                	
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
                                <td><?php echo date('Y-m-d H:i',strtotime($sbList['obj_createdate']));?></td>
                                <td><?php 
					                if($sbList['auditdate'] != '')
					                {
					                	echo date('Y-m-d H:i',strtotime($sbList['auditdate']));
					                }
					                else
					                {
					                	echo '--';
					                }
					                ;?></td>
                                <td>   
                                    <!--                          
                                    <a href="<?php //echo U('SportitemBaseCheckList/check',array('id'=>$sbList['id']));?>" class="a1">审核</a>
                                	-->
					                <?php 
                                	//审核通过
                                	if($sbList['auditstatus']==2)
                                	{
                                		echo "<a href=";
                                		 echo U('SportitemBaseCheckList/check',array('id'=>$sbList['id']));
                                		 echo  " class='a1'>查看</a>";
                                	}
                                	else
                                	{
                                		echo "<a href=";
                                		 echo U('SportitemBaseCheckList/check',array('id'=>$sbList['id']));
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
        <!-- 内容结束-->
        <!-- <div class="line-full copyright">
           公司版权所有<br>公司版权所有@公司版权所有@公司版权所有@公司版权所有@
         </div> -->
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
                 		var url = "<?php echo U('SportitemBaseCheckList/index',array('auditstatus'=>'auditstatusVal'));?>".replace('auditstatusVal',auditstatus);
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
			.lihidden{
overflow: hidden; white-space: nowrap; text-overflow: ellipsis
}
		</style>