<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="36%">启用积分系统</td>
      <td width="64%">
      <input type="radio" name="score_start" id="score_start" value="1" <?php if($data['scoreStart']==1) echo "checked"?>/>是,
      <input type="radio" name="score_start" id="score_start" value="2" <?php if($data['scoreStart']==2) echo "checked"?>/>否</td>
    </tr>
    <tr>
      <td>登陆系统积分</td>
      <td><input type="text" name="loginScore" id="loginScore" value="<?php echo $data['loginScore']?>"/></td>
    </tr>
    <tr>
      <td>发微博获取积分</td>
      <td><input type="text" name="createGet" id="createGet" value="<?php echo $data['createGet']?>"/></td>
    </tr>
    <tr>
      <td>发回复获取积分</td>
      <td><input type="text" name="replayGet" id="replayGet" value="<?php echo $data['replayGet']?>" /></td>
    </tr>
     <tr>
      <td>删除微博扣除</td>
      <td><input type="text" name="createDel" id="createDel" value="<?php echo $data['createDel']?>" /></td>
    </tr>
    <tr>
      <td>删除回复扣除</td>
      <td><input type="text" name="replayDel" id="replayDel" value="<?php echo $data['replayDel']?>" /></td>
    </tr>
     <tr>
      <td>申请群组积分</td>
      <td><input type="text" name="createGroup" id="createGroup" value="<?php echo $data['createGroup']?>" /></td>
    </tr>
     <tr>
      <td>图片微博积分</td>
      <td><input type="text" name="sendImg" id="sendImg" value="<?php echo $data['sendImg']?>" /></td>
    </tr>
     <tr>
      <td>下载附件积分</td>
      <td><input type="text" name="downloadScore" id="downloadScore" value="<?php echo $data['downloadScore']?>" /></td>
    </tr>
     <tr>
      <td>上传奖励积分</td>
      <td><input type="text" name="uploadScore" id="uploadScore" value="<?php echo $data['uploadScore']?>" /></td>
    </tr>
     <tr>
      <td>推荐用户积分</td>
      <td><input type="text" name="hotScore" id="hotScore" value="<?php echo $data['hotScore']?>" /></td>
    </tr>
     <tr>
      <td>邀请注册积分</td>
      <td><input type="text" name="inviteScore" id="inviteScore" value="<?php echo $data['inviteScore']?>" /></td>
    </tr>
     <tr>
      <td>用户默认积分</td>
      <td><input type="text" name="userScore" id="userScore" value="<?php echo $data['userScore']?>" /></td>
    </tr>
     <tr>
      <td>启用积分日志</td>
      <td>
      <input type="radio" name="scoreLog" id="scoreLog" value="1" <?php if($data['scoreLog']==1) echo "checked"?>/>是,
      <input type="radio" name="scoreLog" id="scoreLog" value="2" <?php if($data['scoreLog']==2) echo "checked"?>/>否</td>
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