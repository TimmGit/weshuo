<?php subView("header");?>
<form action="<?php echo siteUrl('public/save')?>" method="post">
E-mail:<input type="text" name="mail" id="mail" /><br/>
登陆帐号:<input type="text" name="username" id="username" /><br/>
<?php echo lang('register_homePage')?>:<input type="text" name="homepage" id="homepage" /><br/>
<?php echo lang('register_password')?><input type="password" name="passwd" id="passwd" /><br/>
<?php echo lang('register_rePassword')?><input type="password" name="repasswd" id="repasswd" /><br/>
<input type="submit" name="submit" id="submit" value="<?php echo lang('register_weshuo_account')?>"/>
</form>
<?php subView("footer");?>