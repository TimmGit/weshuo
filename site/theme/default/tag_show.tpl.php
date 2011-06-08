<?php subView("header")?>
<div>
<?php 
foreach ($list as $v)
{
	echo "<a href='".siteUrl('tag/'.$v['title'])."'>".$v['title']."</a>"."<br/>";
}
?>
</div>
<?php echo $page?>
<?php subView("footer")?>
