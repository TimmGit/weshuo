<?php subView("header")?>
<div>
<?php 
if($list)
{
	foreach ($list as $topic)
	{
	?>
	<div>
	<?php echo $topic['title']?><a href="<?php echo siteUrl($topic['home'].'/'.$topic['topicId'])?>"><?php echo $topic['time']?></a><br/>
	</div>
	<?php
	}
}
echo $page;
?>
</div>
<?php subView("footer")?>