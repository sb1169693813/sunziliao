		<div class="mainlist">
			<div class="line-full wp100">
                <div class="wp100wrap tcenter">
                    <textarea placeholder="请在此输入批注……" class="comment-input" id="auditreply"><?php echo isset($trainingplanOutlineList['auditreply'])?trim($trainingplanOutlineList['auditreply']):null;?></textarea>
                </div>
            </div>
            <div class=" fleft wp100 h50 line-full save-line">
                <a href="javascript:void(0);" class="md-trigger md-close blue mr10" id="save" onclick="comment(<?php echo $trainingplanOutlineList['id'];?>);">保&nbsp;&nbsp; &nbsp; &nbsp;存</a>
                <a href="javascript:void(0);" class="md-trigger md-close blue" id="close">取&nbsp;&nbsp; &nbsp; &nbsp;消
                </a>
            </div>
          </div>
             <script type="text/javascript">
				function comment(outline_id)
				{
					$('#pop1').css('display', 'none');
					if(confirm('确认保存批注?'))
                    {
	                    var auditreply = $('#auditreply').val();
	                    if(auditreply.toString().length > 200)
	                    {
							alert('批注不超过200字');
		                }
	                    else
	                    {
	                    	//console.log(auditreply);
							$.ajax({
		               		 url:"__URL__/comment",
		            			type:'post',
		            			data: {
		            				'outline_id':outline_id,
		            				'auditreply':auditreply
		            				},
		            			'datatype':'json',
		            			success:function(jsondata){
		                    			//alert(jsondata);
		            				if(jsondata.code == 1)
		            				{
		            					//alert('保存批注成功');
		            					//window.location.reload();
		            					alert(jsondata.msg);
		            				}
		            				if(jsondata.code == -1)
		            				{
		            					//alert('保存批注失败');
		            					alert(jsondata.msg);         					
		            				}
		            			},
							});
		                }                    
                    }					
				}				
             </script>