<?php subView("header")?>
<?php subView("user_menu")?>
<h3>个人形象</h3>
<img src="<?php echo baseUrl()?>static/upload/face/ws_<?php echo $userInfo['icon']?>" />
<form action="<?php echo siteUrl('user/cutimg')?>" method="post" enctype="multipart/form-data">
<ul>
	<li><span>选择文件：</span><input type="file" name="newico" id="newico"  ></li>
	<li><span> </span><input type="submit" name="submit" id="submit" value=" 好了，上传 "></li>
</ul>
</form>
</div>
<?php subView("footer")?>