$().ready(function(){
	$("#loginMail").val("Email/帐号");
	$("#loginMail").focus(function(){
		$("#loginMail").val("");
	})
	$("#loginMail").blur(function(){
		if($("#loginMail").val()=="")
		{
			$("#loginMail").val("Email/帐号");
		}
	})
});

function showIcon(path)
{
	var html="";
	for(var i=0;i<50;i++)
	{
		html+="<img src='"+path+"static/upload/icon/"+i+".gif' class='box_icon' onclick=\"return addIcon('"+i+"')\"/>";
	}
	$("#iconBox").html(html);
}

function addIcon(num)
{
	alert(num);
}
