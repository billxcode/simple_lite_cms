$(function(){
	$("#btn-post").on("click",function(){
		var $post = $("#form-posting").serialize();
		$.post("../server/post.php",$post,function(data,success){
			$("#result").html(data);
		});
	});
	$("#btn-view-post").on("click",function(){
		$.get("../server/get-post.php",function(data){
		 // alert(data);
		var obj = JSON.parse('{"data" :'+data+'}');
		for(var i=0;i<obj.data.length;i++){
			$("#table-post").append("<tr><td>"+obj.data[i].title+"</td><td>"+obj.data[i].value+"</td><td>"+obj.data[i].date+"</td><td>"+obj.data[i].username+"</td><tr>");
		}
	});
	});
});