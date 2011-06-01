<div>
<textarea rows="5" cols="30" id="wbContent" name="wbContent"></textarea>
<input type="button" name="submit"  id="submit" value="发布微博"/>
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