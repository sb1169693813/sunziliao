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
                                <col width="" align="" class="wp15">
                                <!--	4	 -->
                                <col width="" align="" class="wp15">
                                <!--	5	 -->
                                <col width="" align="" class="wp14">
                                <!--	6	 -->
                                <col width="" align="" class="wp14">
                                <!--	7	 -->
                                <col width="" align="" class="wp14">
                                <!--	8	 -->
                                <col width="" align="" class="wp20">
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
                                <td class="<?php echo $sbList['auditstatus']==-1?'fred':'';?>"><?php 
					                switch ($sbList['auditstatus'])
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
			                0未提交 1审核中 2 已审核  -1 审核未通过
			                	未提交   只能编辑
			                	审核中  可以查看和编辑
			                	已审核   只能查看
			                -->
			                <!--  
			                <a href="<?php //echo U('SportitemBaseList/view',
			                //array('sportitem_base_id'=>$sbList['id']));?>" class="a1">查看</a>
			                -->
		                	<?php if( $sbList['auditstatus'] == 0 )
		                	{
		                		echo '<a href="" class="a1 none">查看</a>';	                		
		                	}
		                	else
		                	{
		                		echo '<a href=" ';
		                		echo U('SportitemBaseList/view',
		                		array('sportitem_base_id'=>$sbList['id']));
		                		echo ' " class="a1">查看</a>';
		                	}	
		                	?>
			                		                
			                <?php if( $sbList['auditstatus'] == 2 )
			                	{
			                		echo '<a href="" class="a1 none">编辑</a>';
			                		
			                	}
			                	else
			                	{
			                		echo '<a href=" ';
			                		echo U('SportitemBaseList/update',
			                		array('sportitem_base_id'=>$sbList['id']));
			                	echo ' " class="a1">编辑</a>';
			                	}	
			                	?>			                
			                </td>                                
                            </tr>                
                            <?php }}?>
                            <!--  
                            <tr>
                                <td>分腿俯卧撑</td>


                                <td>竖脊肌，斜方肌</td>
                                <td>待审核</td>
                                <td>2016/03/09 15:31</td>
                                <td>2016/03/09 15:31</td>
                                <td>
                                    <a href="" class="a1">查看</a>
                                    <a href="" class="a1">编辑</a>
                                    <a href="" class="a1">提交</a>
                                </td>
                            </tr>
							-->
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
      //  var lheight = $(".menu-right-warp").height();

     //   $(".menu-left-warp").css("min-height", lheight);


        //$.fn.TableLock({table: 'lockTable', lockRow: 1, lockColumn: 2, width: '100%', height: '300px'});

//        var auditstatus = "<?php //echo isset($_GET['auditstatus'])?trim($_GET['auditstatus']):'';?>";
//		if(auditstatus == '')
//		{
//			$("#first1").addClass('cls_tab_nav_li_first');
//		}
//		if(auditstatus == '2')
//		{
//			$("#first2").addClass('cls_tab_nav_li_first');
//		}
//		if(auditstatus == '1')
//		{
//			$("#first3").addClass('cls_tab_nav_li_first');
//		}
//		if(auditstatus == '-1')
//		{
//			$("#first4").addClass('cls_tab_nav_li_first');
//		}
//		if(auditstatus == '0')
//		{
//			$("#first5").addClass('cls_tab_nav_li_first');
//		}
    });
	//点击跳转
    function addFirst(auditstatus)
	{    	
    	//console.log($(obj).html());
		var url = "<?php echo U('SportitemBaseList/index',array('auditstatus'=>'auditstatusVal'));?>".replace('auditstatusVal',auditstatus);
		window.location.href = url;
		//$(obj).parent('li').addClass('cls_tab_nav_li_first');
	}
//    function commit(id)
//    {
//    	if(confirm('确认提交?'))
//        {
//       	//alert('hfjk');
//       	 $.ajax({
//       		 url:"__URL__/sportitemBaseCommit",
//    			type:'post',
//    			data: {
//       				'sportitem_base_id':id
//    				},
//    			'datatype':'json',
//    			success:function(jsondata){
//            			//alert(jsondata);
//    				if(jsondata == 1)
//    				{
//    					alert('提交成功');
//    					window.location.reload();
//    				}
//    				if(jsondata == 0)
//    				{
//    					alert('提交失败');
//    					//window.location.reload();
//    				}	
//    			},
//			});
//        } 
//    }
    
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