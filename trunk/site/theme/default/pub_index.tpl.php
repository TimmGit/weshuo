<?php subView("header")?>
<?php 
if($list)
{
	foreach ($list as $topic)
	{
	?>
	<div>
	<?php echo $topic['title']?><br/>
	</div>
	<?php
	}
}
?>
<?php subView("footer")?>