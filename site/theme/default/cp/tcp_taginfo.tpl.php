<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
      <td>话题ID</td>
      <td><?php echo $info['tagId']?><input type="hidden" name="tagId" id="tagId" value="<?php echo $info['tagId']?>"/></td>
    </tr>
    <tr>
      <td>话题名</td>
      <td><input type="text" name="tagName" id="tagName" value="<?php echo $info['tagName']?>"/></td>
    </tr>
    <tr>
      <td>创建者</td>
      <td><input type="text" name="userId" id="userId" value="<?php echo $info['userId']?>"/></td>
    </tr>
    <tr>
      <td>创建者主页</td>
      <td><input type="text" name="home" id="home" value="<?php echo $info['home']?>"/></td>
    </tr>
    <tr>
      <td>微博统计</td>
      <td><input type="text" name="count" id="count" value="<?php echo $info['count']?>"/></td>
    </tr>
    <tr>
      <td>微博ID</td>
      <td><textarea name="topicId" id="topicId"><?php echo $info['topicId']?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="提交" /></td>
    </tr>
  </table>
</form>
<?php subView('cp/footer')?>