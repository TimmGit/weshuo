<?php subView("header")?>
<div>
<?php echo $info['title']?>
</div>
<?php 
foreach ($list as $k=>$comment)
{
	echo $comment['content']."<br/>";
}
?>
<script type="text/javascript">
<!--
	var topicId=<?php echo $info['topicId']?>	
//-->
</script>
<?php subView("inc_replayMsg")?>
<?php subView("footer")?>