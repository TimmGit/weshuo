<div>
<textarea rows="5" cols="30" id="wbContent" name="wbContent" class='wbContentshow'></textarea>
<br/>&nbsp;&nbsp;
<input type="checkbox" name="zhuan" id="zhuan" value="1"/>转发&nbsp;&nbsp;
<input type="checkbox" name="ping" id="ping" value="1"/>评论&nbsp;&nbsp;
<input type="button" name="submit"  id="submit" value="回复微博"/>
</div>
<script type="text/javascript">
$().ready(function(){
	$("#submit").click(function(){
		var content=$("#wbContent").val();
		var zhuan=$("#zhuan").attr('checked')==false?0:1;
		var ping=$("#ping").attr('checked')==false?0:1;
		if(ping==0 && zhuan==0)
		{
			ping=1;
		}
		$.post("<?php echo siteUrl('ajax/replay')?>", {content: content,zhuan:zhuan,ping:ping,group: group,tag:tag,tome:0,topicId:topicId},
				 function(data) {
				 	$("#cmList").prepend("<tr><td><img class='iconImgNoSpace' src='"+userImg+"' width='30'/>&nbsp;&nbsp;<span>"+userName+"</span>:&nbsp;"+content+"&nbsp;&nbsp;刚刚&nbsp;回复</td></tr>");
		});
	});
});
</script>