<?php subView("header")?>
<div>
<?php 
foreach ($list as $v)
{
	echo "<a href='".siteUrl('group/'.$v['groupName'])."'>".$v['groupName']."</a>"."<br/>";
}
?>
</div>
<?php echo $page?>
<?php subView("footer")?>
