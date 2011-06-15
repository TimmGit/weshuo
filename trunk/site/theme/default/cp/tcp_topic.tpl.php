<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="20"><input type="checkbox" name="checkall" id="checkall" /></td>
      <td width="500">微博</td>
      <td width="220">用户</td>
      <td>创建时间</td>
      <td>详细</td>
    </tr>
    <?php 
    foreach ($list as $topic)
    {
    	?>
    <tr>
      <td><input type="checkbox" name="checkId[]" id="checkId" value="<?php echo $topic['topicId']?>"/></td>
      <td><?php echo substr(strip_tags($topic['title']),0,100)?></td>
      <td><a href="<?php echo siteUrl('ucp/info/'.$topic['userId'])?>"><?php echo $topic['userId']?></a></td>
      <td><?php echo date("Y-m-d",$topic['time'])?></td>
      <td><a href='<?php echo siteUrl('tcp/topicInfo/'.$topic['topicId'])?>'>详细</a></td>
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