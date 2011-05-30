<?php subView("header")?>
<?php subView("user_menu")?>
<div>
<?php foreach ($list as $v)
{
	echo $v['name'].'-'.$v['status']."<br/>";	
}?>
</div>
<?php subView("footer")?>