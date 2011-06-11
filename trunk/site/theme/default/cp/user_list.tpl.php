<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="20"><input type="checkbox" name="checkall" id="checkall" /></td>
      <td width="200">帐号</td>
      <td width="220">主页</td>
      <td>昵称</td>
      <td>Mail</td>
      <td>状态</td>
      <td>详细</td>
    </tr>
    <?php 
    foreach ($list as $user)
    {
    	?>
    <tr>
      <td><input type="checkbox" name="checkId" id="checkId" value="<?php echo $user['userId']?>"/></td>
      <td><?php echo $user['userName']?></td>
      <td><?php echo $user['homePage']?></td>
      <td><?php echo $user['nickName']?></td>
      <td><?php echo $user['mail']?></td>
      <td><?php if($user['status']==1) echo "√";else echo "X"?></td>
      <td><a href='<?php echo siteUrl('ucp/info/'.$user['userId'])?>'>详细</a></td>
    </tr>
    	<?php
    }
    ?>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="提交" /></td>
      <td colspan="4"><?php echo $page?></td>
    </tr>
  </table>
</form>
<?php subView('cp/footer')?>