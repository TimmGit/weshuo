<?php subView("header")?>
<div id="main">
<div id="pub_header"></div>
<div id="pub_main">
	<div class="user_left">
		<div class='user_header'></div>
		<div class='user_main'>
		<h3>我的群组</h3>
<?php foreach ($list as $group){?>
<?php echo $group['groupName']?>--
<a href="<?php echo siteUrl('user/groupEdit/'.$group['groupId'])?>">设置</a>
<a href="<?php echo siteUrl('user/groupAdm/'.$group['groupId'])?>">管理</a><br/>
<?php }?>

</div>
		<div class='user_footer'></div>
	</div>
	<div class="user_right">
		<ul>
			<li><a href="<?php echo siteUrl('user')?>">基本资料</a></li>
			<li><a href="<?php echo siteUrl('user/icon')?>">形象设置</a></li>
			<li style='background-color: #ffffff' class='user_now'><a href="<?php echo siteUrl('user/group')?>">我的群组</a></li>
			<li><a href="<?php echo siteUrl('user/safeinfo')?>">安全设置</a></li>
			<li><a href="<?php echo siteUrl('user/message')?>">短消息</a></li>
			<li><a href="<?php echo siteUrl('public/loginOut')?>">退出</a></li>
		</ul>
	</div>
</div>
<div id="pub_footer"></div>
</div>
<?php subView("footer")?>