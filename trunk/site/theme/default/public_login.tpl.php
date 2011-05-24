<?php subView("header");?>
<form action="<?php echo siteUrl('public/onlogin')?>" method="post">
E-mail/帐号:<input type="text" name="mail" id="mail" /><br/>
<?php echo lang('register_password')?><input type="password" name="passwd" id="passwd" /><br/>
<input type="submit" name="submit" id="submit" value="登陆"/>
</form>
<?php subView("footer");?>
