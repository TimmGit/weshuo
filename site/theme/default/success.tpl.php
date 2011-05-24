<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET?>">
<meta http-equiv="refresh" content="5; url=<?php echo siteUrl($url)?>" />
<title>success</title>
</head>
<body>
<div style='width:600px;height:150px;margin:0 auto;bordre:#ccc 1px solid;'><?php echo $message?>,
<a href="<?php echo siteUrl($url)?>"><?php if(isset($urlName)) echo $urlName;else echo 'click here'?></a></div>
</body>
</html>