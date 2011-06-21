<?php subView("header")?>
<div id="main">
<div id="tag_header"></div>
<div id="tag_main">
<?php 
foreach ($list as $v)
{
	echo "<span>#<a href='".siteUrl('tag/'.$v['tagName'])."'>".$v['tagName']."</a>(".$v['count'].")"."</span>";
}
?>
<?php echo $page?>
</div>
<div class="clear"></div>
<div id="tag_footer"></div>
</div>
<?php subView("footer")?>