<?php subView("header")?>
<div id="main">
<div id="pub_header"></div>
<div id="pub_main">
<div id="main_left">
<div class="login_user_img">
<img src="<?php echo baseUrl()?>/static/upload/face/ws_<?php echo $userInfo['icon']?>"  width="120" height="120" alt="<?php echo $userInfo['nickName']?>" />
</div>
<div class="login_user_info">
<h3><?php echo $userInfo['nickName']?></h3>
<ul>
	<li><a href="<?php echo siteUrl($userInfo['homePage'])?>"><?php echo siteUrl($userInfo['homePage'])?></a></li>
    <li><?php echo $userInfo['province']?>&nbsp;<?php echo $userInfo['city']?></li>
    <li>介绍：&nbsp;<?php echo $userInfo['memo']?></li>
</ul>
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
<div class="user_count">
<ul>
<li>微博：<?php echo $userExt['wbCount']?></li>
<li>关注：<?php echo $userExt['gzCount']?></li>
<li>听众：<?php echo $userExt['fsCount']?></li>
</ul>
</div>
<div class="line"></div>
<div class="login_usre_tag"><?php echo $userInfo['tags']?></div>
<div class="line"></div>
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