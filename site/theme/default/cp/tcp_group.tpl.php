<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="20"><input type="checkbox" name="checkall" id="checkall" /></td>
      <td width="500">群组名</td>
      <td width="220">用户</td>
      <td>创建时间</td>
      <td>详细</td>
    </tr>
    <?php 
    foreach ($list as $group)
    {
    	?>
    <tr>
      <td><input type="checkbox" name="checkId[]" id="checkId" value="<?php echo $group['groupId']?>"/></td>
      <td><?php echo $group['groupName']?></td>
      <td><a href="<?php echo siteUrl('ucp/info/'.$group['userId'])?>"><?php echo $group['userId']?></a></td>
      <td><?php echo date("Y-m-d",$group['time'])?></td>
      <td><a href='<?php echo siteUrl('tcp/groupInfo/'.$group['groupId'])?>'>详细</a></td>
    </tr>
    	<?php
    }
    ?>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="提交" onclick="return confirm('确认删除?');"/></td>
      <td colspan="3"><?php echo $page?></td>
    </tr>
  </table>
</form>
<?php subView('cp/footer')?>