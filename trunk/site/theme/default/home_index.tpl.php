<?php subView("header")?>
<div id="main">
<div id="pub_header"></div>
<div id="pub_main">
<div id="main_left">
<?php subView("inc_sendMsg")?>
<div>
<?php 
foreach ($wblist as $topic)
{
	?>
	<div class="topic">
	<div class="userIcon">
	<a href="<?php echo siteUrl($topic['home'])?>"><img src="<?php echo baseUrl() ?>/static/upload/face/ws_<?php echo $topic['icon']?>" 
	alt="<?php echo $topic['home']?>" width="60"/></a></div>
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
?>
</div>
<?php echo $page?>
</div>
<div id="main_right">
	<div class="right_top"></div>
	<div class="top_guanzhu">我的关注(<?php echo $extInfo['gzCount']?>)</div>
	<div class="top_shoucang">我的收藏</div>
	<div class="line"></div>
	<ul class="config">
		<li><span class="myhome"></span><a href="<?php echo siteUrl($info['homePage'])?>"><?php echo str_replace("http://", '', siteUrl($info['homePage']))?></a></li>
		<li><span class="mywb"></span><?php echo $extInfo['wbCount']?>条微博</li>
		<li><span class="myfs"></span><?php echo $extInfo['fsCount']?>位听众</li>
		<li><span class="mymsg"></span><a href="<?php echo siteUrl('user/message')?>">10条未读私信</a></li>
		<li><span class="myconfig"></span><a href="<?php echo siteUrl('user')?>">账户设置</a></li>
	</ul>
	<div class="line"></div>
	<ul class="config">
	<?php 
	foreach ($tag as $v)
	{
		echo "<li>#<a href='".siteUrl('tag/'.$v['tagName'])."'>".$v['tagName']."(".$v['count'].")</a></li>";
	}
	?>
	</ul>
</div>
</div>
<div class="clear"></div>
</div>
<?php subView("footer")?>