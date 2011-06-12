<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="20"><input type="checkbox" name="checkall" id="checkall" /></td>
      <td width="200">话题名称</td>
      <td width="220">创建用户</td>
      <td>主页地址</td>
      <td>创建时间</td>
      <td>详细</td>
    </tr>
    <?php 
    foreach ($list as $tag)
    {
    	?>
    <tr>
      <td><input type="checkbox" name="checkId[]" id="checkId" value="<?php echo $tag['tagId']?>"/></td>
      <td><?php echo $tag['tagName']?></td>
      <td><?php echo $tag['userId'].'/'.$tag['userName']?></td>
      <td><?php echo $tag['home']?></td>
      <td><?php echo $tag['time']?></td>
      <td><a href='<?php echo siteUrl('tcp/tagInfo/'.$tag['tagId'])?>'>详细</a></td>
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