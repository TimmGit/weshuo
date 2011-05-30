<?php subView("header")?>
<?php subView("user_menu")?>
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
<?php subView("footer")?>