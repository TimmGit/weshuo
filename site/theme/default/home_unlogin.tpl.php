<?php subView("header")?>
<div id="main">
<div id="pub_header"></div>
<div id="pub_main">
<div id="main_left">
<div class="un_user_img">
<img src="<?php echo baseUrl()?>/static/upload/face/ws_<?php echo $userInfo['icon']?>"  width="120" height="120" alt="<?php echo $userInfo['nickName']?>" />
</div>
<div class="un_usre_info">
<h2><?php echo $userInfo['nickName']?></h2>
<h3><?php echo $userInfo['memo']?></h3>
微博：<?php echo $userExt['wbCount']?>&nbsp;&nbsp;&nbsp;
关注：<?php echo $userExt['gzCount']?>&nbsp;&nbsp;&nbsp;
听众：<?php echo $userExt['fsCount']?>&nbsp;&nbsp;&nbsp;
<br/>
<a href="<?php echo siteUrl($userInfo['homePage'])?>"><?php echo siteUrl($userInfo['homePage'])?></a>
</div>
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
</div>
<div id="main_right">
<ul class="hot_user">
<?php 
foreach ($attlist as $user)
{
?>
	<li><a href="<?php echo siteUrl($user['homePage'])?>"><img src="<?php echo baseUrl() ?>/static/upload/face/ws_60_<?php echo $user['icon']?>" 
		alt="<?php echo $user['nickName']?>" width="60" /></a></li>	
<?php }?>
</ul>
</div>
</div>
<div class="clear"></div>
</div>
<?php subView("footer")?>