
$('#test').submit(function(e){
	e.preventDefault();
    var $form = $(this),
        data = $form.serialize();
    
    $.ajax({
        data: data,
        type: $form.attr("method"),
        url: $form.attr("action"),
        success: function(data){
        	$("#main-wrap").html("<p>"+data+"</p>");
        }
    });
});

function submitTryit()
{
var t=document.getElementById("textareaCode").value;
t=t.replace(/=/gi,"w3equalsign");
var pos=t.search(/script/i)
while (pos>0)
	{
	t=t.substring(0,pos) + "w3" + t.substr(pos,3) + "w3" + t.substr(pos+3,3) + "tag" + t.substr(pos+6);
	pos=t.search(/script/i);
	}

t=escape(t);document.getElementById("bt").value="1";
	
document.getElementById("code").value=t;
document.getElementById("tryitform").action="tryit_view.asp?x=" + Math.random();
validateForm();
document.getElementById("tryitform").submit();
}
function validateForm()
{
var code=document.getElementById("code").value;
if (code.length>5000)
	{
	document.getElementById("code").value="<h1>Error</h1>";
	}
}