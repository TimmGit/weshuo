<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
      <td>微博ID</td>
      <td><?php echo $info['topicId']?><input type="hidden" name="topicId" id="topicId" value="<?php echo $info['topicId']?>"/></td>
    </tr>
    <tr>
      <td>微博内容</td>
      <td><textarea name="title" id="title"><?php echo $info["title"]?></textarea></td>
    </tr>
    <tr>
      <td>创建者</td>
      <td><input type="text" name="userId" id="userId" value="<?php echo $info['userId']?>"/></td>
    </tr>
    <tr>
      <td>创建时间</td>
      <td><?php echo date("Y-m-d H:i:s",$info['time'])?></td>
    </tr>
    <tr>
      <td>话题</td>
      <td><input type="text" name="tagName" id="tagName" value="<?php echo $info['tagName']?>"/></td>
    </tr>
    <tr>
      <td>群组ID</td>
      <td><input type="text" name="groupId" id="groupId" value="<?php echo $info['groupId']?>"/></td>
    </tr>
    <tr>
      <td>状态</td>
      <td><input type="text" name="status" id="status" value="<?php echo $info['status']?>"/></td>
    </tr>
    <tr>
      <td>上级ID[转播的ID]</td>
      <td><input type="text" name="parentId" id="parentId" value="<?php echo $info['parentId']?>"/></td>
    </tr>
    <tr>
      <td>转播次数</td>
      <td><input type="text" name="zhuan" id="zhuan" value="<?php echo $info['zhuan']?>"/></td>
    </tr>
    <tr>
      <td>评论次数</td>
      <td><input type="text" name="ping" id="ping" value="<?php echo $info['ping']?>"/></td>
    </tr>
    <tr>
      <td>分享类型</td>
      <td><input type="text" name="share" id="share" value="<?php echo $info['share']?>"/></td>
    </tr>
    <tr>
      <td>客户端</td>
      <td><input type="text" name="client" id="client" value="<?php echo $info['client']?>"/></td>
    </tr>
    <tr>
      <td>主页地址</td>
      <td><input type="text" name="home" id="home" value="<?php echo $info['home']?>"/></td>
    </tr>
    <tr>
      <td>最后回复时间</td>
      <td><?php echo $info['lastTime']?></td>
    </tr>
    <tr>
      <td>是否显示</td>
      <td><input type="text" name="isShow" id="isShow" value="<?php echo $info['isShow']?>"/></td>
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