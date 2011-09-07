<?php subView("headerCommon");?>
<div id="header">
<h1 class="logo"><a href="<?php if($login) echo siteUrl($info['homePage']); else echo baseUrl()?>"></a></h1>
<div class="header_menu">
<ul>
<li><a href="<?php echo siteUrl('pub')?>">广场</a></li>
<li><a href="<?php echo siteUrl('map')?>">地图</a></li>
<li><a href="<?php echo siteUrl('pic')?>">图片</a></li>
<li><a href="javascript:showMenu()">应用</a></li>
<li><a href="<?php echo siteUrl('admin')?>">我到主页</a></li>
<li><a href="<?php echo siteUrl('admin/private')?>">我的微博</a></li>
<li><a href="<?php echo siteUrl('tag')?>">热门话题</a></li>
<li><a href="<?php echo siteUrl('group')?>">群组</a></li>
<li><a href="<?php echo siteUrl('user')?>">账户</a></li>
<?php 
if(userSessionLib::getLogin())
{
?>
	<li><a href="<?php echo siteUrl('public/loginOut')?>">退出</a></li>
	<?php
	if($info['roleId']==9)
	{
		echo "<li><a href=\"".siteUrl('public/admLogin')."\">高级</a></li>";
	}
}else{?>
<li><a href="<?php echo siteUrl('public/register')?>">注册</a></li>
<li><a href="<?php echo siteUrl('public/login')?>">登录</a></li>
<?php
}
?>
</ul>
</div>
</div>
<div class="clear"></div>
<script type="text/javascript">
var group=0;
var tag='';
</script>