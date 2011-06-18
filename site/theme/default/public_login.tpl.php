<?php subView("headerCommon");?>
<div id="login_map">
<div id="main">
<div id="map_logo"><a href="<?php echo siteUrl()?>"></a></div>
<div class="clear"></div>
<div class="login_form">
<form action="<?php echo siteUrl('public/onlogin')?>" method="post">
<input type="text" name="loginMail" id="loginMail" />
<input type="password" name="loginPassword" id="loginPassword" />
<input type="submit" name="submit" id="submit" value="" class="loginBtn"/>
</form>
</div>
</div>
</div>
<?php subView("footer");?>
