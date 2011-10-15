<div id="sendUser">
<img src="<?php echo baseUrl() ?>/static/upload/face/ws_<?php echo $info['icon']?>" 
	alt="<?php echo $info['nickName']?>" width="60"/>
</div>
<div id="sendBox">
<ul>
	<li>文字</li><li onclick="return showtopic();">话题</li>
</ul>
<div class="boxMain">
	<br style="height:0px;line-height:0px;">
	<div class="content">
		<textarea rows="5" cols="30" id="wbContent" name="wbContent"></textarea>
		<span class="right_all_bg" id="showFace" onclick="return showIcon('<?php echo baseUrl()?>');">表情</span>
		<span id="sending">loading...</span>
        <?php hook("sendBoxFooter")?>
		<div id="iconMyBox"></div>
	</div>
</div>
<div class="boxFooter"></div>
<div id="sendBtn"><input type="button" name="submit"  id="submit"/></div>
</div>
<script type="text/javascript">
var userName='<?php echo $info['nickName']?>';
var path='<?php echo baseUrl() ?>';
var userImg=path+'/static/upload/face/ws_<?php echo $info['icon']?>';
$().ready(function(){
	$("#submit").click(function(){
		var content=$("#wbContent").val();
		if(content=='' || content.length<3)
		{
			alert('请输入要内容');
			return false;
		}
		else if(content.indexOf("#请在这里输入自定义话题#")!=-1)
		{
			alert('请修改话题的内容');
			return false;
		}
		$("#sending").show();
		$("#sending").html("<img src='"+path+"/static/images/loading.gif'>");
		$.post("<?php echo siteUrl('ajax/send')?>", {content: content, group: group,tag : tag },
				 function(data) {
				   var html="<div class=\"topic\"><div class=\"userIcon\"><img src=\""+userImg+"\" width='60'/></div>"+
						"<div class='topicMain'><div class='topic_header'><span>"+userName+"</span><div class='topic_content'>"+content+"</div>"+
						"</div><div class='topic_menu'><span class='topic_show'>刚刚</span><span>评论(0)</span><span>转发(0)</span><span>收藏</span></div>"+
						"<div class='topic_footer'></div></div></div><div class='clear'></div>";
					$("#newWeibo").after(html);
					$("#wbContent").val('');
					$("#sending").hide();
				 });
	});
});
</script>
<div id="newWeibo"></div>