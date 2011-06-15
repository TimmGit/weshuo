<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET?>">
<title>Insert title here</title>
<?php load('js/jquery-1.4.2.min.js')?>
<?php load('default.css')?>
</head>
<body>
<div id="login_map">
<div id="main">
<div id="map_logo"><a href="<?php echo siteUrl()?>"></a></div>
<div class="clear"></div>
<div class="login_form">
<form action="<?php echo siteUrl('public/onlogin')?>" method="post">
E-mail/帐号:<input type="text" name="mail" id="mail" />
<?php echo lang('register_password')?><input type="password" name="passwd" id="passwd" />
<input type="submit" name="submit" id="submit" value="登陆"/>
</form>
</div>
</div>
</div>
<?php subView("footer");?>
