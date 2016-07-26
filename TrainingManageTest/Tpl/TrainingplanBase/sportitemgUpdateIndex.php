    <div class="mainlist">
        <!-- 行3-->
        <div class="line-full t-line-36">
            <div class="wp100wrap  ">
                <div class="t-15-r  fleft">动作选择：</div>
                <div class="wp80 lh30 fright"  id="usportitem_base_id">
                    <div class="fleft wp25 h50 mr20">
                    </div>                                                                             
                </div>
            </div>
            <!-- 行2-->
            <div class="line-full t-line-36 h30">
                <div class="wp100wrap  h30">
                    <div class="t-15-r ">方式：</div>
                    <!--<input type="text" placeholder="" class="input-70-r">-->
                    <select name="ugrouptype" id="ugrouptype">
                    	<option value="">请选择</option>
                        <option value="1">按数量</option>
                        <option value="2">按时间</option>
                    </select>
                </div>
            </div>
            <div class="line-full t-line-36 h30">
                <div class="wp100wrap  h30">
                    <div class="t-15-r">运动量：</div>
                    <input type="text" name="ucount" id="ucount" />个/秒 <input type="text" name="ugroupcount" id="ugroupcount" /> 组
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
             	<!--
                <button id="tj" class="blue">保&nbsp;&nbsp; &nbsp; &nbsp;存</button>
                <button id="qx" class="blue">取&nbsp;&nbsp; &nbsp; &nbsp;消</button>
           		 -->
                <input id="tjiao" name="提交" type="button" class="blue hand" value="保&nbsp;&nbsp;&nbsp; &nbsp;存"/>
            	<input  id="qxiao" type="button" value="取&nbsp;&nbsp; &nbsp; &nbsp;消" class="blue hand"/>
            	 
            	<input id="sptype" type="hidden" name="sptype"/>
            	<!--  
            	<input id="ouid" type="hidden" name="ouid"/>
            	<input id="oudid" type="hidden" name="oudid"/>
            	-->
            	<input id="btsdid" type="hidden" name="btsdid"/>
            	<input id="btbid" type="hidden" name="btbid"/>
            	<input id="usort" type="hidden" name="usort"/>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).ready(function(){
	//$(':input').labelauty();
	//查看页面
    if(<?php echo $actiontype;?> == 1)
	{
    	//禁用一些选项
		$('input[name="usportitem_base_id"]').attr('disabled',true);
		//ugrouptype
		$('#ugrouptype').attr('disabled',true);
		//ucount
		$('#ucount').attr('disabled',true);
		//ugroupcount
		$('#ugroupcount').attr('disabled',true);
		//tjiao
		$("#tjiao").addClass('none');
	}
	//取消按钮
	$("#qxiao").click(function(){
		$('#modal-5').removeClass('md-show');
	});
	//保存按钮
	$("#tjiao").click(function(){
		//alert(22222);
		//动作id
//		var sportitem_base_value =[];
//		$('input[name="addsportitem_base_id"]:checked').each(function(){ 
//			sportitem_base_value.push($(this).val());
//		});
		var btb_trainingplan_sportitemgroup_detail_id = $("#btsdid").val();
		//sportitem_base_id
		var sportitem_base_id = $('input[name="usportitem_base_id"]:checked').val();
		//alert(sportitem_base_id);
		//trainingplan_base_id
		//var trainingplan_base_id = $("#btsdid").val();
		var trainingplan_base_id = $("#btbid").val();
		//个数
		var ucount = $("input[name='ucount']").val();
		//组数
		var ugroupcount = $("input[name='ugroupcount']").val();
		var ugrouptype = $("#ugrouptype option:selected").val();
		//usort
		var usort = $("#usort").val();
		if(sportitem_base_id == '')
		{
			alert('请选择动作');
		}
		else if($("#ugrouptype option:selected").val() == '')
		{
			alert('请选择方式');
		}
		else if(ucount == '')
		{
			alert("请填写个数");
		}
		else if(isNumber(ucount) == false)
		{
			alert('请以数字形式填写个数');
		}
		else if(parseInt(ucount)>2147483647)
		{
			alert('个数的数字不能超过2147483647');
		}
		else if(ugroupcount == '')
		{
			alert("请填写组数");
		}
		else if(isNumber(ugroupcount) == false)
		{
			alert('请以数字形式填写组数');
		}
		else if(parseInt(ugroupcount)>2147483647)
		{
			alert('组数的数字不能超过2147483647');
		}
		else
		{
			//alert('add');			
			$('#modal-5').removeClass('md-show');
			if(confirm('确认保存?'))
			{
				$.ajax({
					url:"__URL__/sportitemgUpdate",
					type:'post',
					data: {
						'btb_trainingplan_sportitemgroup_detail_id':btb_trainingplan_sportitemgroup_detail_id,
						'trainingplan_base_id':trainingplan_base_id,
						'sportitem_base_id':sportitem_base_id,
						'ugrouptype':ugrouptype,
						'ucount':ucount,
						'ugroupcount':ugroupcount,
						'usort':usort
						},
					'datatype':'json',
					success:function(jsondata){
						if(jsondata.code == 1)
						{
							//alert("动作修改成功");
							alert(jsondata.msg);
							window.location.reload();
						}
						if(jsondata.code == -1)
						{
							//alert("动作修改失败");
							//window.location.reload();
							alert(jsondata.msg);
						}
//						if(jsondata == -1)
//						{
//							alert('动作已经选择过了');
//						}
					},
				});
			}
			else
			{
				$('#modal-5').addClass('md-show');
			}	
		}
	});	
})
</script>