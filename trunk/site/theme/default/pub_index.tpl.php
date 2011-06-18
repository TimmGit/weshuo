<?php subView("header")?>
<div id="main">
<div id="pub_header"></div>
<div id="pub_main">
<div id="main_left">
<?php subView("inc_sendMsg")?>
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
echo "<div>$pageInfo</div>";
?>
</div>
<div id="main_right">
<div class="right_top"></div>
<div class="top_guanzhu">我的关注(<?php echo $extInfo['gzCount']?>)</div>
<div class="top_shoucang">我的收藏</div>
<div class="line"></div>
<ul>
	<li><span></span><?php echo str_replace("http://", '', siteUrl($info['homePage']))?></li>
	<li><span></span><?php echo $extInfo['wbCount']?>条微博</li>
	<li><span></span><?php echo $extInfo['fsCount']?>位听众</li>
	<li><span></span>10条未读私信</li>
	<li><span></span>账户设置</li>
</ul>
<div class="line"></div>
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