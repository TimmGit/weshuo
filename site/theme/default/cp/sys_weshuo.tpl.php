<?php subView('cp/header')?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="36%">微博名称</td>
      <td width="64%"><label for="title"></label>
      <input type="text" name="title" id="title" value="<?php echo $data['title']?>"/></td>
    </tr>
    <tr>
      <td>微博副标题</td>
      <td><input type="text" name="subTitle" id="subTitle" value="<?php echo $data['subTitle']?>"/></td>
    </tr>
    <tr>
      <td>微博关键字</td>
      <td><input type="text" name="keyword" id="keyword" value="<?php echo $data['keyword']?>"/></td>
    </tr>
    <tr>
      <td>微博描述</td>
      <td><input type="text" name="description" id="description" value="<?php echo $data['description']?>" /></td>
    </tr>
    <tr>
      <td>禁止注册用户名/主页名</td>
      <td><textarea name="noUser" id="noUser"><?php echo $data['noUser']?></textarea></td>
    </tr>
    <tr>
      <td>过滤关键词</td>
      <td><textarea name="replaceWord" id="replaceWord"><?php echo $data['replaceWord']?></textarea></td>
    </tr>
    <tr>
      <td>网站备案号</td>
      <td><input type="text" name="icp" id="icp" value="<?php echo $data['icp']?>"/></td>
    </tr>
    <tr>
      <td>微博主页</td>
      <td><input type="text" name="home" id="home" value="<?php echo $data['home']?>"/></td>
    </tr>
    <tr>
      <td>微博版权信息</td>
      <td><textarea name="copyright" id="copyright"><?php echo $data['copyright']?></textarea></td>
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