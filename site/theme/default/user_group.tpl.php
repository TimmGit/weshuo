<?php subView("header")?>
<?php subView("user_menu")?>
<div>
<?php foreach ($list as $group){?>
<?php echo $group['groupName']?>--
<a href="<?php echo siteUrl('user/groupEdit/'.$group['groupId'])?>">设置</a>
<a href="<?php echo siteUrl('user/groupAdm/'.$group['groupId'])?>">管理</a>
<?php }?>
</div>
<?php subView("footer")?>