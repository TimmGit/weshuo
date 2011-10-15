<?php subView("header")?>
<div id="main">
<div id="pub_header"></div>
<div id="pub_main">
<div id="main_left">
<?php 
if($free)
{
subView("inc_sendMsg");
}
?>
<div>
<?php 
if($list)
{
	foreach ($list as $topic)
	{
	?>
	<div class="topic">
	<div class="userIcon"><img src="<?php echo baseUrl() ?>/static/upload/face/ws_<?php echo $topic['icon']?>" 
	alt="<?php echo $topic['home']?>" width="60"/></div>
	<div class="topicMain">
	<div class="topic_header">
	<span><?php echo $topic['nickName']?></span>
	<div class="topic_content">
	<?php echo $topic['title']?>
	</div>
	</div>
	<div class="topic_menu">
	<span class="topic_show"><a href="<?php echo siteUrl($topic['home'].'/'.$topic['topicId'])?>" target='_blank'>
	<?php echo topicExtra::getTime($topic['time'])?></a></span>
	<span>评论(<?php echo $topic['ping']?>)</span><span>转发(<?php echo $topic['zhuan']?>)</span><span>收藏</span></div>
	<div class="topic_footer"></div>
	</div>
	</div>
	<div class="clear"></div>
	<?php
	}
}
echo "<div class='page'>$page</div>";
?>
</div>
</div>
<div id="main_right">
	<div class="line"></div>
	<div class="right_topic">
		<h2>最新回复微博</h2>
		<ul class="right_topic_ul">
			<?php 
			foreach ($newTopic as $topic)
			{
			?>
			<li><a href="<?php echo siteUrl($topic['home'].'/'.$topic['topicId'])?>">
			<?php echo string::u8_title_substr(replaceHtml($topic['title']),30)?></a>&nbsp;&nbsp;(<?php echo $topic['ping']?>)</li>	
			<?php }?>
		</ul>
	</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php subView("footer")?>