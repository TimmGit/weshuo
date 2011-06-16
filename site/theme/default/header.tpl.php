<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET?>">
<title>Insert title here</title>
<?php load('js/jquery-1.4.2.min.js')?>
</head>
<body>
<div>
<a href="<?php echo siteUrl('pub')?>">广场</a>
<a href="<?php echo siteUrl('map')?>">地图</a>
<a href="<?php echo siteUrl('pic')?>">图片</a>
<a href="javascript:showMenu()">应用</a>
<a href="<?php echo siteUrl('admin')?>">我到主页</a>
<a href="<?php echo siteUrl('admin/private')?>">我的微博</a>
<a href="<?php echo siteUrl('tag')?>">话题</a>
<a href="<?php echo siteUrl('group')?>">群组</a>
<a href="<?php echo siteUrl('user')?>">设置</a>
<a href="<?php echo siteUrl('public/register')?>">注册</a>
<a href="<?php echo siteUrl('public/admLogin')?>">高级</a>
</div>
<script type="text/javascript">
var group=0;
var tag='';
</script>