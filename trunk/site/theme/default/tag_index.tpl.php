<?php subView("header")?>
<div>
<?php 
foreach ($list as $v)
{
	echo "<a href='".siteUrl('tag/'.$v['tagName'])."'>".$v['tagName']."</a>"."<br/>";
}
?>
</div>
<?php echo $page?>
<?php subView("footer")?>