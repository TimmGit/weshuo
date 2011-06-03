<div>
<textarea rows="5" cols="30" id="wbContent" name="wbContent"></textarea>
<input type="button" name="submit"  id="submit" value="回复微博"/>
<input type="checkbox" name="zhuan" id="zhuan" value="1"/>转发
<input type="checkbox" name="ping" id="ping" id="1"/>评论
</div>
<script type="text/javascript">
$().ready(function(){
	$("#submit").click(function(){
		var content=$("#wbContent").val();
		var zhuan=$("#zhuan").val();
		var pingl=$("#ping").val();
		$.post("<?php echo siteUrl('ajax/replay')?>", {content: content, group: group,tag : tag },
				 function(data) {
				   alert(data);
				 });
	});
});
</script>