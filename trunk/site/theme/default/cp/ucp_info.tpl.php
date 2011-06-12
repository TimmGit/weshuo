<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
      <td>userId</td>
      <td><?php echo $info['userId']?><input type="hidden" name="userId" id="userId" value="<?php echo $info['userId']?>"/></td>
    </tr>
    <tr>
      <td>用户名</td>
      <td><input type="text" name="userName" id="userName" value="<?php echo $info['userName']?>"/></td>
    </tr>
    <tr>
      <td>mail</td>
      <td><input type="text" name="mail" id="mail" value="<?php echo $info['mail']?>"/></td>
    </tr>
    <tr>
      <td>昵称</td>
      <td><input type="text" name="nickName" id="nickName" value="<?php echo $info['nickName']?>"/></td>
    </tr>
    <tr>
      <td>主页</td>
      <td><input type="text" name="homePage" id="homePage" value="<?php echo $info['homePage']?>"/></td>
    </tr>
    <tr>
      <td>图像</td>
      <td><a href='<?php echo siteUrl('static/upload/face/ws_').$info['icon']?>' target="_blank">点击查看</a></td>
    </tr>
    <tr>
      <td>注册时间</td>
      <td><?php echo date("Y-m-d H:i:s",$info['createTime'])?></td>
    </tr>
    <tr>
      <td>注册IP</td>
      <td><?php echo $info['createIp']?></td>
    </tr>
    <tr>
      <td>组ID--角色ID</td>
      <td><input type="text" name="groupId" id="groupId" value="<?php echo $info['groupId']?>"/>-
      <input type="text" name="roleId" id="roleId" value="<?php echo $info['roleId']?>"/></td>
    </tr>
    <tr>
      <td>积分</td>
      <td><?php echo $info['score']?></td>
    </tr>
    <tr>
      <td width="36%">状态</td>
      <td width="64%">
      <input type="radio" name="status" id="status" value="1" <?php if($info['status']==1) echo "checked"?>/>正常,
      <input type="radio" name="status" id="status" value="2" <?php if($info['status']==2) echo "checked"?>/>停用</td>
    </tr>
    <tr>
      <td>标签</td>
      <td><input type="text" name="tags" id="tags" value="<?php echo $info['tags']?>"/></td>
    </tr>
    <tr>
      <td>省-市</td>
      <td><input type="text" name="province" id="province" value="<?php echo $info['province']?>"/>-
      <input type="text" name="city" id="city" value="<?php echo $info['city']?>"/>
      </td>
    </tr>
    <tr>
      <td>性别</td>
      <td><input type="radio" name="sex" id="sex" value="1" <?php if($info['sex']==1) echo "checked"?>/>男,
      <input type="radio" name="sex" id="sex" value="2" <?php if($info['sex']==2) echo "checked"?>/>女</td>
    </tr>
    <tr>
      <td>介绍</td>
      <td><textarea name="memo" id="memo"><?php echo $info['memo']?></textarea></td>
    </tr>
    <tr>
      <td>微薄-关注-粉丝</td>
      <td><?php echo $ext['wbCount']?>-<?php echo $ext['gzCount']?>-<?php echo $ext['fsCount']?></td>
    </tr>
    <tr>
      <td>登录时间-IP</td>
      <td><?php echo $ext['loginTime']?>-<?php echo $ext['loginIp']?></td>
    </tr>
    <tr>
      <td>新浪微博帐号</td>
      <td><input type="text" name="sinaId" id="sinaId" value="<?php echo $ext['sinaId']?>"/></td>
    </tr>
    <tr>
      <td>Gmail帐号</td>
      <td><input type="text" name="gmailId" id="gmailId" value="<?php echo $ext['gmailId']?>"/></td>
    </tr>
    <tr>
      <td>QQ帐号</td>
      <td><input type="text" name="oicqId" id="oicqId" value="<?php echo $ext['oicqId']?>"/></td>
    </tr>
    <tr>
      <td>主题</td>
      <td><input type="text" name="theme" id="theme" value="<?php echo $ext['theme']?>"/></td>
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