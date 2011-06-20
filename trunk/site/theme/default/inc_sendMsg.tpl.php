<div id="sendUser">
<img src="<?php echo baseUrl() ?>/static/upload/face/ws_<?php echo $info['icon']?>" 
	alt="<?php echo $info['nickName']?>" width="60"/>
</div>
<div id="sendBox">
<ul>
	<li>文字</li><li>图片</li><li>链接</li><li>话题</li>
</ul>
<div class="boxMain">
	<br style="height:0px;line-height:0px;">
	<div class="content">
		<textarea rows="5" cols="30" id="wbContent" name="wbContent"></textarea>
		<span class="right_all_bg" id="showFace" onclick="return showIcon('<?php echo baseUrl()?>');">表情</span>
        <?php hook("sendBoxFooter")?>
		<div id="iconMyBox"></div>
	</div>
</div>
<div class="boxFooter"></div>
<div id="sendBtn"><input type="button" name="submit"  id="submit"/></div>
</div>
<script type="text/javascript">
$().ready(function(){
	$("#submit").click(function(){
		var content=$("#wbContent").val();
		$.post("<?php echo siteUrl('ajax/send')?>", {content: content, group: group,tag : tag },
				 function(data) {
				   alert(data);
				 });
	});
});
</script>