<?php subView("header")?>
<?php 
if($list)
{
	foreach ($list as $topic)
	{
	?>
	<div>
	<?php echo $topic['title']?><a href="<?php echo siteUrl($topic['home'].'/'.$topic['topicId'])?>" target='_blank'><?php echo $topic['time']?></a><br/>
	</div>
	<?php
	}
}
echo "<div>$pageInfo</div>";
?>
<?php subView("footer")?>