<?php subView("header")?>
<?php load('js/city.js')?>
<SCRIPT LANGUAGE = JavaScript>
var s=["s1","s2"];
var opt0=["省份","<?php echo $userInfo['city']?$userInfo['city']:'市县'?>"];
function setup()
{
    for(i=0;i<s.length-1;i++)
	{
       document.getElementById(s[i]).onchange=new Function("change("+(i+1)+")");
    }
    change(0);
    $("#s1").val("<?php echo $userInfo['province']?>");
    $("#s2").val("<?php echo $userInfo['city']?>");
}
</SCRIPT>
<?php subView("user_menu")?>
<form action="<?php echo siteUrl('user/saveinfo')?>" method="POST" name="form" id="form">
<ul>
	<li><span>用户昵称：</span><input type="text" name="nickname" id="nickname" maxlength="20" value="<?php echo $userInfo['nickName']?>">
	<input type="button" id="btn_check" name="btn_check" value="检查昵称" /><em id="check_msg"></em></li>
	<li><span>我的积分：</span><?php echo $userInfo['score']?></li>
   	<li><span>我的邮箱：</span><?php echo $userInfo['mail']?></li>
    <li><span>地理信息：</span><select id="s1" name="province"><option value="0">省份</option></select>
                <select id="s2" name="capital"><option value="0">地级市</option>
                </select></li>
	<li><span>用户性别：</span><input type="radio" value="1" name="sex" id="sex" <?php if($userInfo['sex']==1) echo "checked"?> />女,
				<input type="radio" value="2" name="sex" id="sex" <?php if($userInfo['sex']==2) echo "checked"?> />男</li>
    <li><span>我的标签：</span><input name="tag" id="tag" value="<?php echo $userInfo['tags']?>" style="width:300px;" />[20字内，多个用英文逗号隔开]</li>
	<li><span>自我介绍：</span><textarea name="content" id="content" style="width:300px;height:80px;"><?php echo $userInfo['memo']?></textarea>[<140字]</li>
	<li><span>&nbsp;</span><input type="submit" name="submit" id="submit" value=" 保 存 "></li>
</ul>
</form>
<script type="text/javascript">
$(function(){
    setup();
	$("#submit").click(function(){
		var nkname=$("#nickname").val();
		var sex=$("[name='sex']:checked").val();
		var content=$("#content").val();
		var msn=$("#msn").val();
		var gmail=$("#gmail").val();
		if(sex=='0')
		{
			alert('请选择性别');
			return false;
		}
		if((nkname=="")||(content==""))
		{
			alert('请输入昵称和自我介绍');
			return false;	
		}
		$("#form").submit();
	});
	$("#btn_check").click(function(){
		$("#check_msg").val('正在检测...');
		var nickname=$("#nickname").val();
		if(nickname=="")
		{
			alert('请输入要检测的昵称');
			return false;
		}
		$("#btn_check").attr("disabled","disabled");
		$("#check_msg").load("<?php echo siteUrl('ajax/checkNick')?>",{'nickname':nickname});
		$("#btn_check").attr("disabled","");
	});
});
</script>
<?php subView("footer")?>