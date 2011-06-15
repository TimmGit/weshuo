<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
      <td>评论ID</td>
      <td><?php echo $info['commentId']?><input type="hidden" name="commentId" id="commentId" value="<?php echo $info['commentId']?>"/></td>
    </tr>
    <tr>
      <td>评论内容</td>
      <td><textarea name="content" id="content"><?php echo $info["content"]?></textarea></td>
    </tr>
    <tr>
      <td>创建者</td>
      <td><input type="text" name="userId" id="userId" value="<?php echo $info['userId']?>"/></td>
    </tr>
    <tr>
      <td>评论时间</td>
      <td><?php echo date("Y-m-d H:i:s",$info['time'])?></td>
    </tr>
    <tr>
      <td>状态</td>
      <td><input type="text" name="status" id="status" value="<?php echo $info['status']?>"/></td>
    </tr>
    <tr>
      <td>主页地址</td>
      <td><input type="text" name="home" id="home" value="<?php echo $info['home']?>"/></td>
    </tr>
    <tr>
      <td>地理位置</td>
      <td><input type="text" name="address" id="address" value="<?php echo $info['address']?>"/></td>
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