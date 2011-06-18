<?php subView("header")?>
<div id="main">
<div id="pub_header"></div>
<div id="pub_main">
<div id="main_left">
<img src="<?php echo baseUrl()?>/static/upload/face/ws_<?php echo $userInfo['icon']?>"  width="120" height="120" alt="<?php echo $userInfo['nickName']?>" />
昵称:<?php echo $userInfo['nickName']?>
微博：<?php echo $userExt['wbCount']?>
关注：<?php echo $userExt['gzCount']?>
粉丝：<?php echo $userExt['fsCount']?>
<div>
<?php 
foreach ($wblist as $topic)
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
?>
</div>
<?php echo $page?>
</div>
<div id="main_right">
<?php 

foreach ($attlist as $v)
{
	echo "<a href='".$v['homePage']."'>".$v['nickName']."</a>";
}
?>
</div>
</div>
<div class="clear"></div>
</div>
<?php subView("footer")?>