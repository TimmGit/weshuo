<?php subView("cp/header")?>
<a href="<?php echo siteUrl('ext/index')?>">已经安装</a>
<a href="<?php echo siteUrl('ext/localPlug')?>">本地插件</a>
<div>
<?php foreach ($list as $plug)
{
?>
<div>
插件名称：<?php echo $plug['plugName'];?>
插件描述：<?php echo $plug['description'];?>
插件作者：<?php echo $plug['author'];?>
插件版本：<?php echo $plug['version'];?>
插件网址：<?php echo $plug['link'];?>
插件状态：<?php if($plug['status']==1) echo "启用";else echo "停用"?>
</div>
<?php
}?>
</div>
<div>
<?php foreach ($local as $plug)
{
?>
<div>
插件名称：<?php echo $plug['name'];?>
插件描述：<?php echo $plug['description'];?>
插件作者：<?php echo $plug['author'];?>
插件版本：<?php echo $plug['version'];?>
插件网址：<?php echo $plug['link'];?>
<a href="<?php echo siteUrl('ext/plugInstall/'.$plug['file'])?>">安装</a>
</div>
<?php
}?>
</div>
<?php subView("cp/footer")?>