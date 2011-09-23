<div>
<textarea rows="5" cols="30" id="wbContent" name="wbContent"></textarea>
<br/>&nbsp;&nbsp;
<input type="checkbox" name="zhuan" id="zhuan" disabled value="1"/>转发&nbsp;&nbsp;
<input type="checkbox" name="ping" id="ping" disabled value="1"/>评论&nbsp;&nbsp;
<input type="checkbox" name="tome" id="tome" disabled value="1"/>转发到我的微博&nbsp;&nbsp;
<input type="button" name="submit"  id="submit" value="回复微博"/>
</div>
<script type="text/javascript">
$().ready(function(){
	$("#submit").click(function(){
		var content=$("#wbContent").val();
		var zhuan=$("#zhuan").attr('checked')==false?0:1;
		var ping=$("#ping").attr('checked')==false?0:1;
		var tome=$("#tome").attr('checked')==false?0:1;
		$.post("<?php echo siteUrl('ajax/replay')?>", {content: content,zhuan:zhuan,ping:ping,group: group,tag:tag,tome:tome,topicId:topicId},
				 function(data) {
				   alert(data);
				 });
	});
});
</script>