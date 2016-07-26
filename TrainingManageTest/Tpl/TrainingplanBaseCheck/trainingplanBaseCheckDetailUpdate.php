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
                <div class="wp96auto mt20 ft14 fgree1 fleft h40">
                    <span id="on">1</span> <span class="w130 fleft"> <a href="javascript:void(0);">基本信息 >> </a> </span>
                    <span id="circle">2</span> <span class="w130 fleft"> <a class="fgray" href="javascript:void(0);" onclick="doTrainingplanBaseCheckDetailSportitemgroup(<?php echo $trainingplanBaseList['id'];?>);">动作设计 >> </a> </span>
                </div>
                <div class="whiteline border-b fleft mb20"></div>
<!--  
                <form action="wanshalist.html" method="post">
-->
                    <div class="line-full content">
                        <div class="wp96auto">
                            <!-- 行 1-->
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-20-r">教练：</div>
                                    <?php echo isset($coach_name)?trim($coach_name):null;?>
                                </div>
                            </div>
                            <!-- 行2-->
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-20-r">课程名称：</div>
                                    <input type="text" name="name" id="name" placeholder="" class="input-50-r" value="<?php echo isset($trainingplanBaseList['name'])?trim($trainingplanBaseList['name']):null;?>">
                                </div>
                            </div>
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-20-r">难易程度：</div>
                                    <div class="input-50-r">
                                        <div class="sel-01 line-full">
                                            <!--<span class="on-select">杠铃课</span>-->
                                            <select name="level" id="level">
                                                <option value="">请选择</option>
				                               	<option value="1">入门级</option>
				                              	<option value="2">初级</option>
				                            	<option value="3">中级</option>
				                            	<option value="4">高级</option>
				                            	<option value="5">挑战级</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 行3-->
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-20-r">课程目标：</div>
                                    <div class="input-50-r">
                                        <div class="sel-01 line-full">
                                            <!--<span class="on-select">杠铃</span>-->
                                            <select name="coursestarget" id="coursestarget">
                                            	<option value="">请选择</option>
                                                <option value="1">增肌塑性</option>
                                                <option value="2">体适能训练</option>
                                                <option value="3">减脂塑形</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-20-r">单天重点：</div>
                                    <div class="input-50-r">
                                        <div class="sel-01 line-full">
                                            <!--<span class="on-select">杠铃</span>-->
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
                                    </div>
                                </div>
                            </div>
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-20-r">课程类型：</div>
                                    <div class="input-50-r">
                                        <div class="sel-01 line-full">
                                            <!--<span class="on-select">杠铃</span>-->
                                            <select name="equipmenttype" id="equipmenttype">
                                            	<option value="">请选择</option>
                                                <option value="1">徒手训练</option>
                                                <option value="2">健身房训练</option>
                                                <option value="3">家庭健身</option>
                                                <option value="4">HIIT</option>
                                                <option value="5">体育舞蹈</option>
                                                <option value="6">特殊小器械</option>
                                                <option value="7">Cross fit</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 行4-->
                            <!-- 行5-->
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap  ">
                                    <div class="t-20-r">使用器械：</div>
                                    <input type="text" name="equipment" id="equipment" value="<?php echo isset($trainingplanBaseList['equipment'])?trim($trainingplanBaseList['equipment']):null;?>" class="input-50-r">&nbsp;&nbsp;
                                    <a href="<?php echo U('InstrumentReference/index');?>" class="instrument-name" target="_blank">器械名称参考</a><br>
                                    <span style="padding-left: 250px;font-size:12px; color:#aaa;">包含多个时，请用 / 隔开</span>
                                </div>
                            </div>
                            <div class="line-full t-line-36" style="height:150px;">
                                <div class="wp100wrap" style="height:150px;">
                                    <div class="t-20-r">目标部位：<br>（可多选）</div>
                                    <div class="input-50-r lh30">
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="肩部" class="chk_1" value="肩部"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="上臂" class="chk_1" value="上臂"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="前臂" class="chk_1" value="前臂"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="背部" class="chk_1" value="背部"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="胸部" class="chk_1" value="胸部"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="腹部" class="chk_1" value="腹部"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="臀部" class="chk_1" value="臀部"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="大腿" class="chk_1" value="大腿"/>
                                        </div>
                                        <div class="fleft wp25 h50">
                                            <input type="checkbox" name="targetbodypart" data-labelauty="小腿" class="chk_1" value="小腿"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line-full t-line-36 ">
                                <div class="wp100wrap  ">
                                    <div class="t-20-r">目标肌肉：</div>
                                    <input type="text" name="targetmuscle" id="targetmuscle" value="<?php echo isset($trainingplanBaseList['targetmuscle'])?trim($trainingplanBaseList['targetmuscle']):null;?>" class="input-50-r">&nbsp;&nbsp;
                                    <a href="<?php echo U('MuscleReference/index');?>" class="instrument-name" target="_blank">肌肉名称参考</a><br>
                                    <span style="padding-left: 250px;font-size:12px; color:#aaa;">包含多个时，请用 / 隔开</span>
                                </div>
                            </div>
                            <!-- 行7-->
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-20-r">热量消耗：</div>
                                    <input type="text" name="kcal" id="kcal" value="<?php echo isset($trainingplanBaseList['kcal'])?trim($trainingplanBaseList['kcal']):null;?>" placeholder="" class="input-50-r"> &nbsp; &nbsp;
                                    Kcal
                                </div>
                            </div>
                            <!-- 行8-->
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40">
                                    <div class="t-20-r">课程参考链接：</div>
                                    <input type="text" name="referenceurl" id="referenceurl" value="<?php echo isset($trainingplanBaseList['referenceurl'])?trim($trainingplanBaseList['referenceurl']):null;?>" placeholder="" class="input-50-r">
                                </div>
                            </div>
                            <!-- 行9-->
                            <div class="line-full t-line-36 h40">
                                <div class="wp100wrap  h40 mb10 pd10" style="border-bottom:1px solid #ccc; ">
                                    <div class="t-20-r">课程结构：</div>
                                    <div class="input-50-r">
                                        <div class="fleft w90 h50">
                                            <input type="checkbox" name="warmupstatus" id="warmupstatus" data-labelauty="热身"
                                                   class="chk_2" 
                                              <?php
                                            $trainingplanConfigList['warmupstatus'] = isset($trainingplanConfigList['warmupstatus'])?trim($trainingplanConfigList['warmupstatus']):'';
	                   						if($trainingplanConfigList['warmupstatus'] == 1)
	                   						{
	                   							echo 'checked="checked"';
	                   						}
	                   						?>      
                                             />
                                        </div>
                                        <!--  
                                        <div class=" fleft w20 h50">
                                        </div>
                                        -->
                                        <div class="fleft w190 h50">+&nbsp;<input type="text" name="sportitemgroupcount" id="sportitemgroupcount" placeholder="" class="w166" value="<?php echo isset($trainingplanConfigList['sportitemgroupcount'])? trim($trainingplanConfigList['sportitemgroupcount']):NULL ;?>">
                                        </div>
                                        <div class="fleft w100 h50">小段课程&nbsp;+</div>
                                        <div class="fleft w30 h50">
                                            <input type="checkbox" name="stretchstatus" id="stretchstatus" data-labelauty="拉伸"
                                                   class="chk_2" 
                                               <?php 
                                              $trainingplanConfigList['stretchstatus'] = isset($trainingplanConfigList['stretchstatus'])?trim($trainingplanConfigList['stretchstatus']):'';
							                   if($trainingplanConfigList['stretchstatus'] == 1)
							                   {
							                   	echo 'checked="checked"';
							                   }
							                   ?>                                                  
                                             />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 行10-->
                            <div class="line-full t-line-36">
                                <div class="wp50wrap  h200 pdl120">
                                    <div class="t-20-r h20 pdt5">
                                        心肺耐力：
                                        <p class="h20"> 肌适能：</p>
                                        <p class="h20"> 柔韧性：</p>
                                        <p class="h20"> 灵敏性：</p>
                                        <p class="h20"> 平衡性：</p>
                                    </div>
                                    <div class="fleft w300">
                                        <div class="sel-01 w300 mb2">
                                            <select class="select2" name="ability1" id="ability1">
                                                <option value="">请选择</option>
                                                <option value="1" 
                                                <?php 
                                                if($trainingplanBaseList['ability1'] == 1)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >1星</option>
                                                <option value="2" 
                                                <?php 
                                                if($trainingplanBaseList['ability1'] == 2)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >2星</option>
                                                <option value="3" 
                                                <?php 
                                                if($trainingplanBaseList['ability1'] == 3)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >3星</option>
                                                <option value="4" 
                                                <?php 
                                                if($trainingplanBaseList['ability1'] == 4)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >4星</option>
                                                <option value="5" 
                                                <?php 
                                                if($trainingplanBaseList['ability1'] == 5)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >5星</option>
                                            </select>
                                        </div>
                                        <div class="sel-01 w300 mb2">
                                            <select class="select2" name="ability2" id="ability2">
                                                <option value="">请选择</option>
                                                <option value="1" 
                                                <?php 
                                                if($trainingplanBaseList['ability2'] == 1)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >1星</option>
                                                <option value="2" 
                                                <?php 
                                                if($trainingplanBaseList['ability2'] == 2)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >2星</option>
                                                <option value="3" 
                                                <?php 
                                                if($trainingplanBaseList['ability2'] == 3)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >3星</option>
                                                <option value="4" 
                                                <?php 
                                                if($trainingplanBaseList['ability2'] == 4)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >4星</option>
                                                <option value="5" 
                                                <?php 
                                                if($trainingplanBaseList['ability2'] == 5)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >5星</option>
                                            </select>
                                        </div>
                                        <div class="sel-01 w300 mb2">
                                            <select class="select2" name="ability3" id="ability3">
                                                <option value="">请选择</option>
                                                <option value="1" 
                                                <?php 
                                                if($trainingplanBaseList['ability3'] == 1)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >1星</option>
                                                <option value="2" 
                                                <?php 
                                                if($trainingplanBaseList['ability3'] == 2)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >2星</option>
                                                <option value="3" 
                                                <?php 
                                                if($trainingplanBaseList['ability3'] == 3)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >3星</option>
                                                <option value="4" 
                                                <?php 
                                                if($trainingplanBaseList['ability3'] == 4)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >4星</option>
                                                <option value="5" 
                                                <?php 
                                                if($trainingplanBaseList['ability3'] == 5)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >5星</option>
                                            </select>
                                        </div>
                                        <div class="sel-01 w300 mb2">
                                            <select class="select2" name="ability4" id="ability4">
                                                <option value="">请选择</option>
                                                <option value="1" 
                                                <?php 
                                                if($trainingplanBaseList['ability4'] == 1)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >1星</option>
                                                <option value="2" 
                                                <?php 
                                                if($trainingplanBaseList['ability4'] == 2)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >2星</option>
                                                <option value="3" 
                                                <?php 
                                                if($trainingplanBaseList['ability4'] == 3)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >3星</option>
                                                <option value="4" 
                                                <?php 
                                                if($trainingplanBaseList['ability4'] == 4)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >4星</option>
                                                <option value="5" 
                                                <?php 
                                                if($trainingplanBaseList['ability4'] == 5)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >5星</option>
                                            </select>
                                        </div>
                                        <div class="sel-01 w300 mb2">
                                            <select class="select2" name="ability5" id="ability5">
                                                <option value="">请选择</option>
                                                <option value="1" 
                                                <?php 
                                                if($trainingplanBaseList['ability5'] == 1)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >1星</option>
                                                <option value="2" 
                                                <?php 
                                                if($trainingplanBaseList['ability5'] == 2)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >2星</option>
                                                <option value="3" 
                                                <?php 
                                                if($trainingplanBaseList['ability5'] == 3)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >3星</option>
                                                <option value="4" 
                                                <?php 
                                                if($trainingplanBaseList['ability5'] == 4)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >4星</option>
                                                <option value="5" 
                                                <?php 
                                                if($trainingplanBaseList['ability5'] == 5)
                                                {
                                                	echo "selected='selected'";
                                                }
                                                ?>
                                                >5星</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="fright w300">
                                    <ul class="left ft12">
                                        <li class="fw">星级说明：
                                        </li>
                                        <li> 1星：普通人群日常的生理功能水平</li>
                                        <li>2星：普通人群低强度运动的生理功能水平</li>
                                        <li> 3星：普通人群中等强度运动的生理功能水平
                                        </li>
                                        <li> 4星：规律运动人群高强度运动的生理功能水平
                                        </li>
                                        <li> 5星：运动老手极限强度运动的生理功能水平</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="line-full save-line wp100wrap  h40">
                            <a href="javascript:void(0);" class="blue mr10" onclick="trainingplanBaseUpdate();">保&nbsp;&nbsp; &nbsp; &nbsp;存</a>
                            <a href="<?php echo U('TrainingplanBaseCheckDetail/index',array('id'=>$trainingplanBaseList['id']));?>" class="blue">取&nbsp;&nbsp; &nbsp; &nbsp;消</a>
                        	<input id="hiddentrainingplan_base_id"  name="trainingplan_base_id" type="hidden"  value="<?php echo isset($trainingplanBaseList['id'])?trim($trainingplanBaseList['id']):null;?>"/>                    
                        	<input id="hiddenoutline_id"  name="outline_id" type="hidden"  value="<?php echo isset($trainingplanBaseList['outline_id'])?trim($trainingplanBaseList['outline_id']):null;?>"/>                    
                        	<input id="hiddenoutline_detail_id"  name="outline_detail_id" type="hidden"  value="<?php echo isset($trainingplanBaseList['outline_detail_id'])?trim($trainingplanBaseList['outline_detail_id']):null;?>"/>
                        </div>
                    </div>
            </div>
            <!-- 蓝包结束1-->
        </div>
        <!-- 内容结束-->
        <!-- <div class="line-full copyright">
           公司版权所有<br>公司版权所有@公司版权所有@公司版权所有@公司版权所有@
         </div> -->
<!-- 右全部内容 结束-->
<script src="__PUBLICROOT__/TrainingManage/js/jquery-1.8.3.min.js"></script>
<script src="__PUBLICROOT__/TrainingManage/js/jquery-labelauty.js"></script>
<link href="__PUBLICROOT__/TrainingManage/css/form.css" rel="stylesheet" type="text/css">
<script>
    $(function () {
        $(':input').labelauty();
      //难易程度
        $("#level option").each(function(){
    		if($(this).val() == "<?php echo isset($trainingplanBaseList['level']) ? trim($trainingplanBaseList['level']) : '';?>")      		
    		{
    			$(this).attr('selected',true);
    		}
    	});
    	//单天重点
        $("#bodypart option").each(function(){
    		if($(this).val() == "<?php echo isset($trainingplanBaseList['bodypart']) ? trim($trainingplanBaseList['bodypart']) : '';?>")      		
    		{
    			$(this).attr('selected',true);
    		}
    	});
    	//课程目标coursestarget
    	$("#coursestarget option").each(function(){
    		if($(this).val() == "<?php echo isset($trainingplanBaseList['coursestarget']) ? trim($trainingplanBaseList['coursestarget']) : '';?>")      		
    		{
    			$(this).attr('selected',true);
    		}
    	});
    	//课程类型equipmenttype
      	$("#equipmenttype option").each(function(){
    	if($(this).val() == "<?php echo isset($trainingplanBaseList['equipmenttype']) ? trim($trainingplanBaseList['equipmenttype']) : '';?>")      		
    	{
    		$(this).attr('selected',true);
    	}
    	});
    	//目标部位targetbodypart
    	var targetbodypart = "<?php echo isset($trainingplanBaseList['targetbodypart'])?trim($trainingplanBaseList['targetbodypart']):'';?>";	
        $("input[name='targetbodypart']").each(function(){    	 
    		if(targetbodypart.indexOf($(this).val()) != -1)
    		{
    			$(this).attr('checked',true);
    		}
    	});  	
    });
    //动作设计链接
    function doTrainingplanBaseCheckDetailSportitemgroup(id)
    {
    	var url = "<?php echo U('TrainingplanBaseCheckDetailSportitemgroup/index',array('id'=>'idVal'));?>".replace('idVal',id);
    	window.location.href = url;
    }
	//保存
	function trainingplanBaseUpdate()
	{
	 	//outline_id
    	var outline_id = $("#hiddenoutline_id").val();
    	//outline_detail_id
    	var outline_detail_id = $("#hiddenoutline_detail_id").val();
		//trainingplan_base_id
		var trainingplan_base_id = $("#hiddentrainingplan_base_id").val();
		//课程名称
		var name = $("#name").val();     		
		//难易程度
		var level = $("#level option:selected").val();
		//课程目标
		var coursestarget = $("#coursestarget option:selected").val();
		//单天重点
		var bodypart = $("#bodypart").val();
		//课程类型
		var equipmenttype = $("#equipmenttype option:selected").val();
		//使用器械
		var equipment = $("#equipment").val();
		//目标部位targetbodypart
		var $chk_value =[];
		$('input[name="targetbodypart"]:checked').each(function(){ 
			$chk_value.push($(this).val());
		});
		var targetbodypart = $chk_value.join(',');
		//目标肌肉targetmuscle
		var targetmuscle = $("#targetmuscle").val();
		//热量消耗
		var kcal = $("#kcal").val();
		//课程参考链接
		var referenceurl = $("#referenceurl").val();
		//warmupstatus			
		if($("#warmupstatus").attr("checked") == 'checked')
		{
			var warmupstatus = 1;
    	}
		else
		{
			var warmupstatus = 0;
    	}
		//stretchstatus
		if($("#stretchstatus").attr("checked") == 'checked')
		{
			var stretchstatus = 1;
    	}
		else
		{
			var stretchstatus = 0;
    	}
		//sportitemgroupcount
    	var sportitemgroupcount = $("#sportitemgroupcount").val();
    	//ability1
    	var ability1 = $("#ability1 option:selected").val();
    	//ability2
    	var ability2 = $("#ability2 option:selected").val();
    	//ability3
    	var ability3 = $("#ability3 option:selected").val();
    	//ability4
    	var ability4 = $("#ability4 option:selected").val();
    	//ability1
    	var ability5 = $("#ability5 option:selected").val();
		//验证填写的信息
		
		if(name == '')
		{
			alert('请填写课程名称');
		}
		else if(name.toString().length >12)
		{
			alert('课程名称不超过12个字');
		}
		else if(level=='')
		{
			alert('请选择难易程度');
		}
		else if(coursestarget == '')
		{
			alert('请选择课程目标');
		}
		else if(bodypart == '')
		{
			alert('请选择单天重点');
		}
		else if(equipmenttype == '')
		{
			alert('请选择课程类型');
		}
		else if(equipment == '')
		{
			alert('请填写使用器械，包含多个时，请用 / 隔开');
		}
		else if(equipment.toString().length > 100)
		{
			alert('使用器械不超过100个字');
		}
		else if(targetbodypart == '')
		{
			alert('请选择目标部位');
		}		
		else if(targetmuscle == '')
		{
			alert('请填写目标肌肉，包含多个时，请用 / 隔开');
    	}
		else if(targetmuscle.toString().length > 100)
		{
			alert('目标肌肉不超过100个字');
		}
		else if(kcal == '')
		{
			alert('请填写热量消耗');
    	}
		else if(!isNumber(kcal))
		{
			alert('热量消耗必须为数字');
		}
		else if(parseInt(kcal)>2147483647)
		{
			alert('热量消耗不能超过2147483647');
		}
		else if(!isInteger(sportitemgroupcount) || sportitemgroupcount<0)
		{
			alert('小段课程必须为正整数');
		}
		else if(ability1 == '')
		{
			alert('请选择心肺耐力');
    	}
		else if(ability2 == '')
		{
			alert('请选择肌适能');
    	}
		else if(ability3 == '')
		{
			alert('请选择柔韧性');
    	}
		else if(ability4 == '')
		{
			alert('请选择灵敏性');
    	}
		else if(ability5 == '')
		{
			alert('请选择平衡性');
    	}
		else
		{
			$.ajax({
       		 	url:"__URL__/trainingplanBaseUpdate",
    			type:'post',
    			data: {
    				'trainingplan_base_id':trainingplan_base_id,'name':name,'level':level,'coursestarget':coursestarget,
    				'bodypart':bodypart,'equipmenttype':equipmenttype,'equipment':equipment,'targetbodypart':targetbodypart,
    				'targetmuscle':targetmuscle,'kcal':kcal,'referenceurl':referenceurl,'warmupstatus':warmupstatus,
    				'sportitemgroupcount':sportitemgroupcount,'stretchstatus':stretchstatus,       				
    				'ability1':ability1,'ability2':ability2,'ability3':ability3,'ability4':ability4,'ability5':ability5       				       				
    				},
    			'datatype':'json',
    			success:function(jsondata){
            			//console.log(jsondata);
    				if(jsondata.code == 1)
    				{
    					alert('保存成功');
    					var url = "<?php echo U('TrainingplanBaseCheckDetail/index',array('id'=>'idVal'));?>".replace('idVal',trainingplan_base_id);
						window.location.href = url;		
    				}
    				if(jsondata.code  == -1)
    				{
    					//alert('课程设计修改失败');
    					alert(jsondata.msg);
    				}
    				if(jsondata.code == -2)
    				{
    					//alert('课程结构修改失败');
    					alert(jsondata.msg);
    				}
    				if(jsondata.code == -3)
    				{
    					//alert('课程结构插入失败');
    					alert(jsondata.msg);
    				}
    				if(jsondata.code == -4)
    				{
    					//alert('热身插入失败');
    					alert(jsondata.msg);
    				}
    				if(jsondata.code == -5)
    				{
    					//alert('热身修改失败');
    					alert(jsondata.msg);
    				}
    				if(jsondata.code == -6)
    				{
    					//alert('拉伸插入失败');
    					alert(jsondata.msg);
    				}
    				if(jsondata.code == -7)
    				{
    					//alert('拉伸修改失败');
    					alert(jsondata.msg);
    				}
    				if(jsondata.code == -8)
    				{
    					//alert('普通动作组插入失败');
    					alert(jsondata.msg);
    				}
    				if(jsondata.code == -9)
    				{
    					//alert('普通动作组修改失败');
    					alert(jsondata.msg);
    				}	
    			},
			});
		}
	}  
</script>
<script src="__PUBLICROOT__/TrainingManage/js/gg_bd_ad_720x90.js" type="text/javascript"></script>
<script src="__PUBLICROOT__/TrainingManage/js/follow.js" type="text/javascript"></script>
	<style>
        .t-line-36 {
            width: 100%;
            height: auto;
        }

        .select2 {
            width: 100%;
            height: 26px;
            border: none;
        }
  	</style>