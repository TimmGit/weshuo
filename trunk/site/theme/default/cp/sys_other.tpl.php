<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="36%">关闭用户注册</td>
      <td width="64%">
      <input type="radio" name="openReg" id="openReg" value="1" <?php if($data['openReg']==1) echo "checked"?>/>是,
      <input type="radio" name="openReg" id="openReg" value="2" <?php if($data['openReg']==2) echo "checked"?>/>否</td>
    </tr>
    <tr>
      <td>启用邀请注册</td>
      <td>
      <input type="radio" name="inviteReg" id="inviteReg" value="1" <?php if($data['openReg']==1) echo "checked"?>/>是,
      <input type="radio" name="inviteReg" id="inviteReg" value="2" <?php if($data['openReg']==2) echo "checked"?>/>否
      </td>
    </tr>
    <tr>
      <td>是否开放评论</td>
      <td>
      <input type="radio" name="commentOpen" id="commentOpen" value="1" <?php if($data['commentOpen']==1) echo "checked"?>/>是,
      <input type="radio" name="commentOpen" id="commentOpen" value="2" <?php if($data['commentOpen']==2) echo "checked"?>/>否
      </td>
    </tr>
    <tr>
      <td>微博长度限制</td>
      <td><input type="text" name="textLen" id="textLen" value="<?php echo $data['textLen']?>" /></td>
    </tr>
     <tr>
      <td>附件大小限制</td>
      <td><input type="text" name="fileSize" id="fileSize" value="<?php echo $data['fileSize']?>" /></td>
    </tr>
    <tr>
      <td>是否关闭网站</td>
      <td><input type="radio" name="isClose" id="isClose" value="1" <?php if($data['isClose']==1) echo "checked"?>/>是,
      <input type="radio" name="isClose" id="isClose" value="2" <?php if($data['isClose']==2) echo "checked"?>/>否
      </td>
    </tr>
     <tr>
      <td>网站关闭原因</td>
      <td><textarea name="closeInfo" id="closeInfo" " /><?php echo $data['closeInfo']?></textarea></td>
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