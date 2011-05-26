<?php subView("header")?>
<img src="<?php echo baseUrl()?>/static/upload/face/ws_<?php echo $userInfo['icon']?>"  width="120" height="120" alt="<?php echo $userInfo['nickName']?>" />
昵称:<?php echo $userInfo['nickName']?>
微博：<?php echo $userExt['wbCount']?>
关注：<?php echo $userExt['gzCount']?>
粉丝：<?php echo $userExt['fsCount']?>
<div>
<?php 
foreach ($wblist as $v)
{
	echo $v['title']."<br/>";
}
?>
</div>
<?php 

foreach ($attlist as $v)
{
	echo "<a href='".$v['homePage']."'>".$v['nickName']."</a>";
}
?>
<?php subView("footer")?>