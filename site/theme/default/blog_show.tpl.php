<?php subView("header")?>
<div id="main">
<div id="pub_header"></div>
<div id="pub_main">
<div id="main_left">
<div class="show_main">
<div class="show_header">
<script type="text/javascript">
<!--
	var topicId=<?php echo $tInfo['topicId']?>	
//-->
</script>
<table border="0" align="left" cellpadding="0" cellspacing="0"><tr><td>
<img src="<?php echo baseUrl() ?>/static/upload/face/ws_60_<?php echo $userInfo['icon']?>" /></td>
<td>&nbsp;&nbsp;<?php echo $tInfo['title']?><br/>&nbsp;&nbsp;<?php echo topicExtra::getTime($tInfo['time'])?></td></tr></table>
</div>
<table border="0" align="left" cellpadding="0" cellspacing="0"><tr><td>
<?php subView("inc_replayMsg")?>
</td></tr></table>
<table border="0" align="left" cellpadding="0" cellspacing="0">
<?php 
foreach ($list as $k=>$comment)
{
	echo "<tr><td>".$comment['content']."</td></tr>";
}
?>
</table>
</div>
</div>
<div id="main_right">
	<div class="right_user">
		<h2>活跃用户</h2>
		<div class="right_box_bg">
		<ul class="hot_user">
			<?php 
			foreach ($hotUser as $user)
			{
			?>
			<li><a href="<?php echo siteUrl($user['home'])?>"><img src="<?php echo baseUrl() ?>/static/upload/face/ws_60_<?php echo $user['icon']?>" 
			alt="<?php echo $user['nickName']?>" width="60" /></a></li>	
			<?php }?>
		</ul>
		</div>
	</div>
	<div class="right_tag">
		<h2>热门话题</h2>
		<ul class="right_tag_ul">
			<?php 
			foreach ($hotTag as $tag)
			{
			?>
			<li><a href="<?php echo siteUrl('show/'.$tag['tagName'])?>">#<?php echo $tag['tagName']?></a>&nbsp;&nbsp;(<?php echo $tag['count']?>)</li>	
			<?php }?>
		</ul>
	</div>
	<div class="line"></div>
	<div class="right_topic">
		<h2>最新回复微博</h2>
		<ul class="right_topic_ul">
			<?php 
			foreach ($newTopic as $topic)
			{
			?>
			<li><a href="<?php echo siteUrl($topic['home'].'/'.$topic['topicId'])?>">
			<?php echo string::u8_title_substr($topic['title'],30)?></a>&nbsp;&nbsp;(<?php echo $topic['ping']?>)</li>	
			<?php }?>
		</ul>
	</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php subView("footer")?>