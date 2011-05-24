<?php subView("header");?>
<form action="<?php echo siteUrl('public/saveFind')?>" method="post">
<?php 
foreach ($hotUser as $v)
{
	echo $v['loginTime']."<input type='checkbox' name='userid[]' value='".$v['userId']."' checked/>";
}
echo "<hr>";
foreach ($randUser as $v)
{
	echo $v['nickName'].'-'.$v['userName']."<input type='checkbox' name='userid[]' value='".$v['userId']."' checked/><br/>";
}
?>
<input type="submit" name="submit" id="submit" value="关注TA们"/>
</form>
<?php subView("footer");?>