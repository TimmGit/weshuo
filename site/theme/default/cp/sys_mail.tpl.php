<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="36%">邮局类别</td>
      <td width="64%">
      <input type="radio" name="mailType" id="mailType" value="1" <?php if($data['mailType']==1) echo "checked"?>/>Mail函数,
      <input type="radio" name="mailType" id="mailType" value="2" <?php if($data['mailType']==2) echo "checked"?>/>SMTP</td>
    </tr>
    <tr>
      <td>smtp服务器</td>
      <td><input type="text" name="smtp" id="smtp" value="<?php echo $data['smtp']?>"/></td>
    </tr>
    <tr>
      <td>smtp用户名</td>
      <td><input type="text" name="smtpUser" id="smtpUser" value="<?php echo $data['smtpUser']?>"/></td>
    </tr>
    <tr>
      <td>smtp密码</td>
      <td><input type="text" name="smtpPwd" id="smtpPwd" value="<?php echo $data['smtpPwd']?>" /></td>
    </tr>
    <tr>
      <td>发件人</td>
      <td><input type="text" name="receive" id="receive" value="<?php echo $data['receive']?>" /></td>
    </tr>
    <tr>
      <td>激活邮件</td>
      <td><textarea name="mailText" id="mailText"><?php echo $data['mailText']?></textarea></td>
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