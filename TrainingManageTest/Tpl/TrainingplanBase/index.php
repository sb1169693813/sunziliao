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
                    <li class="cls_tab_nav_li <?php echo $status==''?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst('');">全部</a></li>                   
                    <li class="cls_tab_nav_li <?php echo $status=='2'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(2);">已审核</a></li>
                    <li class="cls_tab_nav_li <?php echo $status=='1'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(1);">审核中</a></li>
                    <li class="cls_tab_nav_li <?php echo $status=='-1'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(-1);">未通过</a></li>
                    <li class="cls_tab_nav_li <?php echo $status=='0'?'cls_tab_nav_li_first':'';?>"><a href="javascript:void(0);" onclick="addFirst(0);">未提交</a></li>
                </ul>
                <div class="fright-o none"><a href="javascript:void(0);">新建</a></div>
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
                                    <col width="" align="" class="wp13">
                                    <!--	7	 -->
                                    <col width="" align="" class="wp13">
                                    <!--	8	 -->
                                    <col width="" align="" class="wp20">
                                </colgroup>
                                <thead class="tcenter">
                                <tr>
                                <td>课程名称</td>
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
                                <?php if(isset($trainingplanBaseList)){foreach ($trainingplanBaseList as $tbList){?>
                                <tr>
                                    <td><?php echo $tbList['name'];?></td>
                                    <td>
                                    <?php 
                                    switch ($tbList['equipmenttype'])
                                    {
                                    	case 1:
                                    		echo '徒手训练';
                                    	break;	
                                    	case 2:
                                    		echo '健身房训练';
                                    	break;
                                    	case 3:
                                    		echo '家庭健身';
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
                                    switch ($tbList['level'])
                                    {
                                    	case 1:
                                    		echo '入门级';
                                    	break;	
                                    	case 2:
                                    		echo '初级';
                                    	break;
                                    	case 3:
                                    		echo '中极';
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
                               	 	switch ($tbList['bodypart'])
                                    {
                                    	case 1:
                                    		echo '心肺耐力';
                                    	break;	
                                    	case 2:
                                    		echo '肌肉适能';
                                    	break;
                                    	case 3:
                                    		echo '柔韧';
                                    	break;
                                    	case 4:
                                    		echo '平衡';
                                    	break;
                                    	case 5:
                                    		echo '灵敏';
                                    	break;
                                    	case 6:
                                    		echo '全身';
                                    	break;
                                    	case 7:
                                    		echo '全身偏上';
                                    	break;
                                    	case 8:
                                    		echo '全身偏下';
                                    	break;
                                    	case 9:
                                    		echo '全身偏躯干';
                                    	break;
                                    	case 10:
                                    		echo '上肢下肢';
                                    	break;
                                    	case 11:
                                    		echo '上肢躯干';
                                    	break;
                                    	case 12:
                                    		echo '下肢躯干';
                                    	break;
                                    	case 13:
                                    		echo '上肢';
                                    	break;
                                    	case 14:
                                    		echo '躯干';
                                    	break;
                                    	case 15:
                                    		echo '下肢';
                                    	break;
                                    }
                                    ?></td>
                                    <td class="<?php echo $tbList['status']==-1?'fred':'';?>"><?php 
                               	 	switch ($tbList['status'])
                                    {
                                    	case 0:
                                    		echo '未提交';
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
                                    <td><?php echo date('Y-m-d H:i',strtotime($tbList['obj_createdate']));?></td>
					                <td><?php 
					                if($tbList['auditdate'] != '')
					                {
					                	echo date('Y-m-d H:i',strtotime($tbList['auditdate']));
					                }
					                else
					                {
					                	echo '--';
					                }
					                ;?></td>
                                    <td>
                                    <!--  
                0未提交 1审核中 2 已审核  -1 审核未通过     
                -->
                  <!--  
               <a href="<?php //echo U('TrainingplanBaseList/view',
               //array('trainingplan_base_id'=>$tbList['id']));?>" class="a1">查看</a>
                    -->
                 <?php if($tbList['status'] == 1)
                	{
                		echo '<a href="" class="a1 none">查看</a>';
                		
                	}
                	else
                	{
                		echo '<a href=" ';
                		echo U('TrainingplanBaseList/view',
                		array('trainingplan_base_id'=>$tbList['id']));
                	echo ' " class="a1">查看</a>';
                	}	
                ?>                                            
                <?php if($tbList['status'] == 2)
                	{
                		echo '<a href="" class="a1 none">编辑</a>';
                		
                	}
                	else
                	{
                		echo '<a href=" ';
                		echo U('TrainingplanBaseList/update',
                		array('trainingplan_base_id'=>$tbList['id']));
                	echo ' " class="a1">编辑</a>';
                	}	
                	?>
                <?php if($tbList['status'] == 2)
                {
                	echo '<a href="javascript:void(0);" class="a1 none commit">提交</a>';             
                }
                else
                {
                	echo '<a href="javascript:void(0);" class="a1 commit" onclick="commit('.$tbList['id'].');">提交</a>';
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
    <!-- 右全部内容 结束-->
<script>
    $(function () {
       // var lheight = $(".menu-right-warp").height();

        //$(".menu-left-warp").css("min-height", lheight);


       // $.fn.TableLock({table: 'lockTable', lockRow: 1, lockColumn: 2, width: '100%', height: '300px'});
        
//        var status = "<?php //echo isset($_GET['status'])?trim($_GET['status']):'';?>";
//		if(status == '')
//		{
//			$("#first1").addClass('cls_tab_nav_li_first');
//		}
//		if(status == '2')
//		{
//			$("#first2").addClass('cls_tab_nav_li_first');
//		}
//		if(status == '1')
//		{
//			$("#first3").addClass('cls_tab_nav_li_first');
//		}
//		if(status == '-1')
//		{
//			$("#first4").addClass('cls_tab_nav_li_first');
//		}
//		if(status == '0')
//		{
//			$("#first5").addClass('cls_tab_nav_li_first');
//		}
    });
    //点击跳转
    function addFirst(status)
	{
    	
    	//console.log($(obj).html());
		var url = "<?php echo U('TrainingplanBaseList/index',array('status'=>'statusVal'));?>".replace('statusVal',status);
		window.location.href = url;
		//$(obj).parent('li').addClass('cls_tab_nav_li_first');
	}
	
    //提交按钮
    function commit(id)
    {
   	 	if(confirm('确认提交?'))
        {
     	//alert('hfjk');
       		$.ajax({
       			
       		 url:"__URL__/trainingplanBaseCommit",
    			type:'post',
    			data: {
    				'trainingplan_base_id':id
    				},
    			'datatype':'json',
    			success:function(jsondata){
            			//alert(jsondata);
    				if(jsondata.code == 1)
    				{
    					alert('提交成功');
    					window.location.reload();
    				}
    				if(jsondata.code == -1)
    				{
    					//alert('提交失败');插入方案表日志失败
    					alert(jsondata.msg);
    				}
    				if(jsondata.code == -2)
    				{
    					//alert('提交失败');更新课程设计审核状态失败
    					alert(jsondata.msg);
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