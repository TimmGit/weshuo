<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
      <td>群组ID</td>
      <td><?php echo $info['groupId']?><input type="hidden" name="groupId" id="groupId" value="<?php echo $info['groupId']?>"/></td>
    </tr>
    <tr>
      <td>群组名</td>
      <td><input type="text" name="groupName" id="groupName" value="<?php echo $info['groupName']?>"/></td>
    </tr>
    <tr>
      <td>创建者</td>
      <td><input type="text" name="userId" id="userId" value="<?php echo $info['userId']?>"/></td>
    </tr>
    <tr>
      <td>排序</td>
      <td><input type="text" name="sort" id="sort" value="<?php echo $info['sort']?>"/></td>
    </tr>
    <tr>
      <td>群分类</td>
      <td><input type="text" name="groupType" id="groupType" value="<?php echo $info['groupType']?>"/></td>
    </tr>
    <tr>
      <td>图标</td>
      <td><a href="<?php echo baseUrl('static/upload/group/'.$info['icon'])?>" target="_blank">
      <img src="<?php echo baseUrl('static/upload/group/'.$info['icon'])?>" width="40"></a>
      <input type="file" name="icon" id="icon"/>
      </td>
    </tr>
     <tr>
      <td>权限</td>
      <td><input type="checkbox" name="isShow" id="isShow" value="1" <?php if($info['isShow']==1) echo "checked"?>/>显示,
      <input type="checkbox" name="isSend" id="isSend" value="1" <?php if($info['isSend']==1) echo "checked"?>/>发送,
      <input type="checkbox" name="isReplay" id="isReplay" value="1" <?php if($info['isReplay']==1) echo "checked"?>/>回复,
      <input type="checkbox" name="isJoin" id="isJoin" value="1" <?php if($info['isJoin']==1) echo "checked"?>/>加入</td>
    </tr>
    <tr>
      <td>统计</td>
      <td><?php echo $info['count']?></td>
    </tr>
    <tr>
      <td>介绍</td>
      <td><textarea name="memo" id="memo"><?php echo $info['memo']?></textarea></td>
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