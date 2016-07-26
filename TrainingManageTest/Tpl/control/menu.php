<!-- 左菜单 开始-->
                <div class="menu-left-warp">
                    <div class="logo">
                        <div class="t1">
                            BTB课程设计平台
                        </div>
                    </div>
                    <div class="menu-left">
                        <ul>
              <!-- on 选中状态-->
                            <li class="l1 <?php echo $headtype==1?'on':'';?>">
                                <a href="<?php echo $coachtype==1?U('OutlineList/index'):U('OutlineCheckList/index?auditstatus=1');?>" class="sicon1" >
                                    课程大纲
                                </a>
                            </li>
                            <li class="l2 <?php echo $headtype==2?'on':'';?>">
                                <a href="<?php echo $coachtype==1?U('SportitemBaseList/index'):U('SportitemBaseCheckList/index?auditstatus=1');?>"  class="sicon2" >
                                   动作库
                                </a>
                            </li>
                            <li class="l3 <?php echo $headtype==3?'on':'';?>">
                                <a href="<?php echo $coachtype==1?U('TrainingplanBaseList/index'):U('TrainingplanBaseCheckList/index?status=1');?>" class="sicon3" >
                                    课程设计
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <script type="text/javascript">         
                //导航栏选中状态
//				  var urlstr = location.href;
//				  var urlstatus = false;
				 // $(".menu-left a").each(function(){
//					    if((urlstr + '/').indexOf($(this).attr('href')) > -1 && $(this).attr('href')!='') 
//						{
//					      	$(this).parent("li").addClass('on'); 
//					      	urlstatus = true;
//					    }
//					    else
//						{
//					      	$(this).parent("li").removeClass('on');
//					    }

//				if((urlstr + '/').indexOf('Outline') > -1) 
//				{
//			      	$('.l1').addClass('on'); 
//			      	urlstatus = true;
//			    }
//				if((urlstr + '/').indexOf('SportitemBase') > -1)
//				{
//					$('.l2').addClass('on'); 
//			      	urlstatus = true;
//				}
//				if((urlstr + '/').indexOf('TrainingplanBase') > -1)
//				{
//					$('.l3').addClass('on'); 
//			      	urlstatus = true;
//				}
//				  if(!urlstatus)
//				  {
//					  $(".menu-left li").eq(0).addClass('on'); 
//				  }
				</script>
 
