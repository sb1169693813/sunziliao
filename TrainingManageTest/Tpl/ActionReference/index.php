        <!-- 内容开始-->
        <div class="line-full content-wrap">


            <!-- 蓝包开始1 -->
            <div class="line-full content-blue1 ">


                <div class="line-full content">
                    <div class="wp96auto">


                        <!-- 行 1-->


                        <!-- 行2-->
                        <div class="line-full t-line-36 h40">
                            <div class="wp100wrap  h60">
                                <div class="searchbt">
                                    <li class="text">名称</li>
                                    <li class="list">
                                        <input type="text" name="name" id="name" class="sel-01 line-full" style="margin-top:5px" value="<?php echo $name;?>" />
                                        </input>
                                    </li>
                                    <li class="text">难易</li>
                                    <li class="list">
                                        <div class="sel-01 line-full">
                                            <select name="level" id="level">
                                            	<option value="">请选择</option>
                                                <option value="1" <?php if($level == 1){echo "selected='selected'";}?>>入门级</option>
                                                <option value="2" <?php if($level == 2){echo "selected='selected'";}?>>初级</option>
                                                <option value="3" <?php if($level == 3){echo "selected='selected'";}?>>中级</option>
                                                <option value="4" <?php if($level == 4){echo "selected='selected'";}?>>高级</option>
                                                <option value="5" <?php if($level == 5){echo "selected='selected'";}?>>挑战级</option>
                                            </select>
                                        </div>
                                    </li>

                                    <li class="text">类型</li>
                                    <li class="list">
                                        <div class="sel-01 line-full">
                                            <select name="type" id="type">
                                            	<option value="">请选择</option>
                                                <option value="1" <?php if($type == 1){echo "selected='selected'";}?>>热身</option>
                                                <option value="2" <?php if($type == 2){echo "selected='selected'";}?>>练习</option>
                                                <option value="3" <?php if($type == 3){echo "selected='selected'";}?>>拉伸</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="text">部位</li>
                                    <li class="list">
                                        <div class="sel-01 line-full">
                                            <select name="targetbodypart" id="targetbodypart">
                                                <option value="">请选择</option>
                                                <option value="肩部" <?php if($targetbodypart == '肩部'){echo "selected='selected'";}?>>肩部</option>
                                                <option value="上臂" <?php if($targetbodypart == '上臂'){echo "selected='selected'";}?>>上臂</option>
                                                <option value="前臂" <?php if($targetbodypart == '前臂'){echo "selected='selected'";}?>>前臂</option>
                                                <option value="背部" <?php if($targetbodypart == '背部'){echo "selected='selected'";}?>>背部</option>
                                                <option value="胸部" <?php if($targetbodypart == '胸部'){echo "selected='selected'";}?>>胸部</option>
                                                <option value="腹部" <?php if($targetbodypart == '腹部'){echo "selected='selected'";}?>>腹部</option>
                                                <option value="臀部" <?php if($targetbodypart == '臀部'){echo "selected='selected'";}?>>臀部</option>
                                                <option value="大腿" <?php if($targetbodypart == '大腿'){echo "selected='selected'";}?>>大腿</option>
                                                <option value="小腿" <?php if($targetbodypart == '小腿'){echo "selected='selected'";}?>>小腿</option>                                              
                                            </select>
                                        </div>
                                    </li>
                                    <li class="text">器械</li>
                                    <li class="list">
                                        <div class="sel-01 line-full">
                                            <select name="useequipment" id="useequipment">
                                                <option value="">请选择</option>
                                                <option value="无器械" <?php if($useequipment == '无器械'){echo "selected='selected'";}?>>无器械</option>
                                                <option value="家用小杠铃" <?php if($useequipment == '家用小杠铃'){echo "selected='selected'";}?>>家用小杠铃</option>
                                                <option value="家用哑铃" <?php if($useequipment == '家用哑铃'){echo "selected='selected'";}?>>家用哑铃</option>
                                                <option value="固定器械" <?php if($useequipment == '固定器械'){echo "selected='selected'";}?>>固定器械</option>
                                                <option value="自由力量" <?php if($useequipment == '自由力量'){echo "selected='selected'";}?>>自由力量</option>
                                                <option value="史密斯架" <?php if($useequipment == '史密斯架'){echo "selected='selected'";}?>>史密斯架</option>
                                                <option value="综合训练器" <?php if($useequipment == '综合训练器'){echo "selected='selected'";}?>>综合训练器</option>
                                                <option value="有氧器械" <?php if($useequipment == '有氧器械'){echo "selected='selected'";}?>>有氧器械</option>
                                                <option value="多器械组合" <?php if($useequipment == '多器械组合'){echo "selected='selected'";}?>>多器械组合</option>
                                                <option value="踏板" <?php if($useequipment == '踏板'){echo "selected='selected'";}?>>踏板</option>
                                                <option value="健身球" <?php if($useequipment == '健身球'){echo "selected='selected'";}?>>健身球</option>
                                                <option value="壶铃" <?php if($useequipment == '壶铃'){echo "selected='selected'";}?>>壶铃</option>
                                                <option value="泡沫轴" <?php if($useequipment == '泡沫轴'){echo "selected='selected'";}?>>泡沫轴</option>
                                                <option value="BOSU球" <?php if($useequipment == 'BOSU球'){echo "selected='selected'";}?>>BOSU球</option>
                                                <option value="弹力带" <?php if($useequipment == '弹力带'){echo "selected='selected'";}?>>弹力带</option>
                                                <option value="飞力仕" <?php if($useequipment == '飞力仕'){echo "selected='selected'";}?>>飞力仕</option>                                              
                                                <option value="能量管(VIPR)" <?php if($useequipment == '能量管(VIPR)'){echo "selected='selected'";}?>>能量管(VIPR)</option>                                              
                                                <option value="战术绳" <?php if($useequipment == '战术绳'){echo "selected='selected'";}?>>战术绳</option>                                              
                                                <option value="健腹轮" <?php if($useequipment == '健腹轮'){echo "selected='selected'";}?>>健腹轮</option>                                              
                                                <option value="瑜伽砖" <?php if($useequipment == '瑜伽砖'){echo "selected='selected'";}?>>瑜伽砖</option>                                              
                                                <option value="普拉提圈" <?php if($useequipment == '普拉提圈'){echo "selected='selected'";}?>>普拉提圈</option>                                              
                                                <option value="肚皮舞" <?php if($useequipment == '肚皮舞'){echo "selected='selected'";}?>>肚皮舞</option>                                              
                                                <option value="街舞" <?php if($useequipment == '街舞'){echo "selected='selected'";}?>>街舞</option>                                              
                                                <option value="太极" <?php if($useequipment == '太极'){echo "selected='selected'";}?>>太极</option>                                              
                                                <option value="养生功" <?php if($useequipment == '养生功'){echo "selected='selected'";}?>>养生功</option>                                              
                                                <option value="广场舞" <?php if($useequipment == '广场舞'){echo "selected='selected'";}?>>广场舞</option>                                              
                                                <option value="民族舞" <?php if($useequipment == '民族舞'){echo "selected='selected'";}?>>民族舞</option>                                              
                                                <option value="爵士舞" <?php if($useequipment == '爵士舞'){echo "selected='selected'";}?>>爵士舞</option>                                             
                                                <option value="芭蕾舞" <?php if($useequipment == '芭蕾舞'){echo "selected='selected'";}?>>芭蕾舞</option>                                                                                          
                                            </select>
                                        </div>
                                    </li>

                                    <button class=" blue" style="" onclick="shaixuan();">筛选</button>
                                </div>

                            </div>


                            <div class="whiteline border-b fleft mb20"></div>

                            <!-- 行2-->


                            <div class="line-full t-line-36">
                                <div class="wp100wrap ">
                                	<?php foreach ($sportitemBaseList as $sbList){?>                                 
                                    <div class="fleft wp20 h50 lihidden">
                                    	<span class="chk_3 lihidden"><?php echo $sbList['name'];?></span>
                                    </div>  
                                    <?php }?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                </div>
                            </div>

                            <!--<div class="line-full save-line wp100wrap  h40">-->
                                <!--<input type="button" value="&nbsp; &nbsp保 &nbsp; &nbsp;存&nbsp; &nbsp" class="blue">-->

                            <!--</div>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 蓝包结束1-->

  
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
    });
    function shaixuan()
    {
		var name = $('#name').val().replace(/(^\s*)|(\s*$)/g, "");
		var level = $('#level').val().replace(/(^\s*)|(\s*$)/g, "");
		//type
		var type = $('#type').val().replace(/(^\s*)|(\s*$)/g, "");
		//targetbodypart
		var targetbodypart = $('#targetbodypart').val().replace(/(^\s*)|(\s*$)/g, "");
		//useequipment
		var useequipment = $('#useequipment').val().replace(/(^\s*)|(\s*$)/g, "");
		if(name != "" || level != "" || type != "" || targetbodypart!='' || useequipment!='')
		{
			var url = "<?php echo U('ActionReference/index?name=nameVal&level=levelVal&type=typeVal&targetbodypart=targetbodypartVal&useequipment=useequipmentVal')?>".replace('nameVal',name).replace('levelVal',level).replace('typeVal',type).replace('targetbodypartVal',targetbodypart).replace('useequipmentVal',useequipment);
		}
		else
		{
			var url = "<?php echo U('ActionReference/index')?>";
		}
		window.location.href = url;	
	}
</script>
<script src="__PUBLICROOT__/TrainingManage/js/gg_bd_ad_720x90.js" type="text/javascript"></script>
<script src="__PUBLICROOT__/TrainingManage/js/follow.js" type="text/javascript"></script>
<style>
.lihidden{
overflow: hidden; white-space: nowrap; text-overflow: ellipsis
}
</style>