<script type="text/javascript">
<!--
function showComment(typeId,topicId)
{
	if($("#commentDiv"+topicId).length)
	{
		$("#commentDiv"+topicId).remove();
	}
	else
	{
		var html="<div id=\"commentDiv"+topicId+"\" class='commentDiv'><img src=\"<?php echo baseUrl('static/images/loading.gif')?>\" /></div>";
		$("#topicBody"+topicId).append(html);
		if(typeId==1)
		{
			html="<div class='replayComemnt' id='replayComemnt"+topicId+"'><input type='text' name='replayText' class='inputBox'/>";
			html+="<input type='button' name='button' value='评论' onclick=\"return replayWeibo("+topicId+",0);\"/>";
			html+="<div><input type='checkbox' name='tome' id='tome"+topicId+"' />转播到我的微博</div></div>";
			$.post("<?php echo siteUrl('ajax/getComment')?>", { site: "weshuo", topicId:topicId },function(data) {
				html+=data;
				$("#commentDiv"+topicId).html(html);
			});
		}
		else
		{
			var zhuanContent=$("#topic"+topicId+" div.topic_content").html();
			html="<div class='replayComemnt' id='replayComemnt"+topicId+"'>转发微博<br/>"+zhuanContent;
			html+="<br/>您还可以输入140字<br/><input type='text' name='replayText' class='inputBox'/>";
			html+="<input type='button' name='button' value='转发' onclick=\"return replayWeibo("+topicId+",1);\"/></div>";
			$("#commentDiv"+topicId).html(html);
		}
	}
}

function replayWeibo(topicId,typeId)
{
	var ping=typeId ?0 :1;
	var zhuan=typeId ?1 :0;
	var content=$("#replayComemnt"+topicId+" .inputBox").val();
	var tome=$("#tome"+topicId).attr("checked");
	tome=tome ?1:0;
	if(content=="" || (content.indexOf("@")>-1 && content.substr(content.length-1)==":"))
	{
		alert('请输入的内容');
		return false;
	}
	else
	{
		$.post("<?php echo siteUrl('ajax/replay')?>", { content:content, topicId:topicId,group:group,tag:tag,ping:ping,zhuan:zhuan,tome:tome},function(data) {
			if($("#commentDiv"+topicId+' ul').length)
			{
				$("#commentDiv"+topicId+' ul').prepend("<li><img src='"+userImg+"' width='30'/><span><a href='"+path+userName+"'>"+userName+"</a>&nbsp;&nbsp;"+content+"<em>刚刚</em></span></li>");
			}
			else
			{
				$("#commentDiv"+topicId).append("<ul><li><img src='"+userImg+"' width='30'/><span><a href='"+path+userName+"'>"+userName+"</a>&nbsp;&nbsp;"+content+"<em>刚刚</em></span></li></ul>");
			}
			$("#replayComemnt"+topicId+" .inputBox").val('');
		});
	}
}
//-->
</script>
