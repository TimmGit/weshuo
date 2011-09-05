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

(function($){
    $.fn.extend({
        insertAtCaret: function(myValue){
            var $t = $(this)[0];
            if (document.selection) {
                this.focus();
                sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
            }
            else 
                if ($t.selectionStart || $t.selectionStart == '0') {
                    var startPos = $t.selectionStart;
                    var endPos = $t.selectionEnd;
                    var scrollTop = $t.scrollTop;
                    $t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
                    this.focus();
                    $t.selectionStart = startPos + myValue.length;
                    $t.selectionEnd = startPos + myValue.length;
                    $t.scrollTop = scrollTop;
                }
                else {
                    this.value += myValue;
                    this.focus();
                }
        }
    })
})(jQuery);

function showIcon(path)
{
	var div="wbContent";
	var htmlContent="<div class='close' onclick=\"closediv('iconMyBox');\">表情图片<em>x</em></div>";
	var i=0;
	for(i=0;i<31;i++)
	{
		htmlContent+="<img src='"+path+"static/icon/"+i+".gif' class='box_icon' onclick=\"return addIcon('"+div+"','"+i+"')\"/>";
	}
	$("#iconMyBox").show(300).html(htmlContent);
}

function closediv(divName)
{
	$("#"+divName).hide(300);
}

function addIcon(div,k)
{
	$("#"+div).insertAtCaret("("+k+".gif)");
}
