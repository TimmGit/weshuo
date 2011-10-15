<?php subView("header")?>
<div id="main">
<div id="pub_header"></div>
<div id="pub_main">
	<div class="user_left">
		<div class='user_header'></div>
		<div class='user_main'>
<h3>个人形象</h3>
<img src="<?php echo baseUrl()?>static/upload/face/ws_<?php echo $userInfo['icon']?>" />
<form action="<?php echo siteUrl('user/cutimg')?>" method="post" enctype="multipart/form-data">
<ul>
	<li><span>选择文件：</span><input type="file" name="newico" id="newico"  ></li>
	<li><span> </span><input type="submit" name="submit" id="submit" value=" 好了，上传 "></li>
</ul>
<br/>
<br/>
<br/>
</form>
</div>
		<div class='user_footer'></div>
	</div>
	<div class="user_right">
		<ul>
			<li><a href="<?php echo siteUrl('user')?>">基本资料</a></li>
			<li style='background-color: #ffffff' class='user_now'><a href="<?php echo siteUrl('user/icon')?>">形象设置</a></li>
			<!--<li><a href="<?php echo siteUrl('user/group')?>">我的群组</a></li> -->
			<li><a href="<?php echo siteUrl('user/safeinfo')?>">安全设置</a></li>
			<li><a href="<?php echo siteUrl('user/message')?>">短消息</a></li>
			<li><a href="<?php echo siteUrl('public/loginOut')?>">退出</a></li>
		</ul>
	</div>
</div>
<div id="pub_footer"></div>
</div>
<?php subView("footer")?>