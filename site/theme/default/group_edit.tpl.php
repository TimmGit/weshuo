<?php subView("header")?>
<?php subView("user_menu")?>
<?php if(!$info)
{
	echo "error";
}
else 
{
?>
<form action="" method="post">
<div>
<input type="text" name="groupName" value="<?php echo $info['groupName']?>" />
<input type="file" name="icon" value="<?php echo $info['icon']?>" />
<textarea rows="5" cols="20"><?php echo $info['memo']?></textarea>
显示：<input type="checkbox" name="isShow" value="1" <?php if($info['isShow']==1) echo "checked"?>/>
回复：<input type="checkbox" name="isReplay" value="1" <?php if($info['isReplay']==1) echo "checked"?>/>
加入：<input type="checkbox" name="isJoin" value="1" <?php if($info['isJoin']==1) echo "checked"?>/>
发布：<input type="checkbox" name="isSend" value="1" <?php if($info['isSend']==1) echo "checked"?>/>
<input type="hidden" name="id" value="<?php echo $info['groupId']?>" id="id"/>
<input type="submit" name="submit" value=" 提交 "/>
</div>
</form>
<?php }?>
<?php subView("footer")?>
