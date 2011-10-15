<?php subView("header")?>
<div id="main">
<div id="pub_header"></div>
<div id="pub_main">
	<div class="user_left">
		<div class='user_header'></div>
		<div class='user_main'>
		<div id="userinfo">
			<div class="blog_title"><h3>密码设置</h3></div>
			<form action="" method="post" name="saveform">
			<ul>
				<li><span>旧密码：</span><input type="password" name="oldpwd" id="oldpwd" maxlength="20" /></li>
				<li><span>新密码：</span><input type="password" name="passwd" id="passwd" maxlength="20" /></li>
				<li><span>重复密码：</span><input type="password" name="repasswd" id="repasswd" maxlength="20" /></li>
				<li><span>&nbsp;</span><input type="submit" name="submit" id="submit" value=" 保 存 " /><em id="infomsg"></em></li>
			</ul>
			</form>
			</div>
					</div>
		<div class='user_footer'></div>
	</div>
	<div class="user_right">
		<ul>
			<li><a href="<?php echo siteUrl('user')?>">基本资料</a></li>
			<li><a href="<?php echo siteUrl('user/icon')?>">形象设置</a></li>
			<!--<li><a href="<?php echo siteUrl('user/group')?>">我的群组</a></li> -->
			<li style='background-color: #ffffff' class='user_now'><a href="<?php echo siteUrl('user/safeinfo')?>">安全设置</a></li>
			<li><a href="<?php echo siteUrl('user/message')?>">短消息</a></li>
			<li><a href="<?php echo siteUrl('public/loginOut')?>">退出</a></li>
		</ul>
	</div>
</div>
<div id="pub_footer"></div>
</div>
<?php subView("footer")?>