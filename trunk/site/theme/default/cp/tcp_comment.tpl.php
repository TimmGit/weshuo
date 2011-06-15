<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="20"><input type="checkbox" name="checkall" id="checkall" /></td>
      <td width="500">内容</td>
      <td width="220">用户</td>
      <td>创建时间</td>
      <td>查看</td>
      <td>详细</td>
    </tr>
    <?php 
    foreach ($list as $comment)
    {
    	?>
    <tr>
      <td><input type="checkbox" name="checkId[]" id="checkId" value="<?php echo $comment['commentId']?>"/></td>
      <td><?php echo mb_substr($comment['content'], 0,50,"UTF-8")?></td>
      <td><a href="<?php echo siteUrl('ucp/info/'.$comment['userId'])?>"><?php echo $comment['userId']?></a></td>
      <td><?php echo date("Y-m-d",$comment['time'])?></td>
      <td><a href='<?php echo siteUrl('show/'.$comment['topicId'])?>' target="_blank">查看</a></td>
      <td><a href='<?php echo siteUrl('tcp/commentInfo/'.$comment['commentId'])?>'>详细</a></td>
    </tr>
    	<?php
    }
    ?>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="提交" onclick="return confirm('确认删除?');"/></td>
      <td colspan="4"><?php echo $page?></td>
    </tr>
  </table>
</form>
<?php subView('cp/footer')?>