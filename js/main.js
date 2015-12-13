$(function(){
	$("#btn-login").on("click",function(){
		var $login = $("#form-login").serialize();
		$.post("server/login.php",$login,function(data,success){
			if(data=="success"){
				window.location="dashboard";
			}else{
				alert(data);
			}
		});
	});
	$.get("server/get-post.php",function(data){
		// alert(data);
		var obj = JSON.parse('{"data" :'+data+'}');
		for(var i=0;i<obj.data.length;i++){
			$("#content-articles").append("<div class='list-articles'>"+obj.data[i].title+"<br>"+obj.data[i].value+"<br>"+obj.data[i].date+"<br>"+obj.data[i].username+"</div>");
		}
	});
});