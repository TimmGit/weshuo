<?php subView("header");?>
<script type="text/javascript">
<!--
$().ready(function(){
	$("#mail").focus(function(){
		if($(this).val()=="常用email")
		{
			$(this).val('');
		}
	});
	$("#mail").blur(function(){
		if($(this).val()=="")
		{
			$(this).val('常用email');
		}
	});
	$("#homepage").focus(function(){
		if($(this).val()=="个性地址")
		{
			$(this).val('');
		}	
	})
	$("#reg_submit").click(function(){
		var mail=$("#mail").val();
		var home=$("#homepage").val();
		var pwd=$("#passwd").val();
		var repwd=$("#repasswd").val();
		if(mail=="" || home=='' || pwd=='' || mail=='常用email' || home=='个性地址')
		{
			alert('请输入所有注册信息!');
			return false;
		}
		if(pwd!=repwd)
		{
			alert('两次的密码不一致!');
			return false;
		}
		return true;
	});
});
//-->
</script>
<div id="login_map">
<div id="main">
<form action="<?php echo siteUrl('public/save')?>" method="post">
<ul class='userRegForm'>
<li><span>E-mail</span><input type="text" value="常用email" name="mail" id="mail" class='regInput' /></li>
<li><span><?php echo lang('register_homePage')?>:</span><?php echo baseUrl()?><input type="text" value="个性地址" name="homepage" id="homepage" class='regInputHome'/></li>
<li><span><?php echo lang('register_password')?></span><input type="password" name="passwd" id="passwd" class='regInput' /></li>
<li><span><?php echo lang('register_rePassword')?></span>
<input type="password" name="repasswd" id="repasswd" class='regInput'/></li>
<li><input type="submit" name="submit" id="reg_submit" value=" "/></li>
</ul>
</form>
</div>
</div>
<?php subView("footer");?>