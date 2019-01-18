function text(){
	
	if(document.getElementById("radio1").checked){

	 	document.getElementById("1").style.display= "none";
	 	document.getElementById("2").style.display = "inline-block";

	}else if(document.getElementById("radio2").checked){
	 	document.getElementById("2").style.display= "none";
	 	document.getElementById("1").style.display = "inline-block";
	}

}

function FtypeCheck(url){
    var add=document.getElementById('add').value;   
	if(add != ""){
        data="type="+add;
		$.ajax({
				type:'GET',
				url:url+'/create',
				data : data,
				dataType:'text',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},  
				success:function(data){ 
					console.log(data);
					data=JSON.parse(data);
                    if(data.success){
                        alert("新增成功");
                        location.href="additem";
                    }else{

                        $( "p" ).find("span").empty();
						$.each(data.error,function(key,value){
							console.log(value);
							$( "p" ).find( "span" ).append("<li>"+value+"</li>").css( "color", "red" );
							// $('.print-error-msg').find('ul').
						});
                    }
				    
				}
		});			
	}else{
	
		if(add == ""){
			
			alert("請輸入類別");
		}
    }
}

function Del_Type(url){
    var select=document.getElementById('select2').value;
	data="type="+select;
	if(select != ""){
		if(confirm("確實要刪除這筆資料？")){

			$.ajax({
			type:'delete',
			url:url+"/delete",
			data : data,
			dataType:'text',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}, 
				success:function(data){
					if(data == "true"){
                        alert("已刪除");
                        location.href="additem";
                    }else{
						alert("此類別項目尚有資料儲存")
					}
				}
            });	
            
		}else{
			alert("已取消動作");
		}
	}else{
			alert("請選擇類別名稱");
	
	}
}

function check(url){
    var select=document.getElementById('select').value;
	var add2=document.getElementById('add2').value;
	var form = document.getElementById('form');
	var data = new FormData(form);
	//console.log(select);
	//console.log(add2);
	if(select != "" && add2 != ""){	
		//data=$('#form').serialize();
		//data="select="+select+"&add2="+add2;
		
		console.log(data);
		$.ajax({
			type:'POST',
			url:url,
			data : data,
			dataType:'text',
			cache:false,
			contentType:false,
			processData:false,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}, 
			success:function(data){
				console.log(data);
				
				if(data == "true"){
					alert("新增成功");
					location.href="additem";
				}
				if(data == "false"){

					alert("資料已存在");

				}else{
					data=JSON.parse(data);
					$( "p" ).find("span").empty();
					$.each(data.error,function(key,value){
						console.log(value);
						$( "p" ).find( "span" ).append("<li>"+value+"</li>").css( "color", "red" );
						// $('.print-error-msg').find('ul').
					});
				}
			}
		});			

		
	}else{
	
		if(select=="" || add2 == ""){
			
			alert("請輸入類別與工程");
		}
	}
}
function readURL(input){
	
	if (input.files && input.files.length >= 0) {
	  for(var i = 0; i < input.files.length; i ++){
		var reader = new FileReader();
		reader.onload = function (e) {
		  var img = $("<img width='300' height='200'>").attr('src', e.target.result);
		  $("#preview_progressbarTW_imgs").append(img);
		}
		reader.readAsDataURL(input.files[i]);
	  }
	}else{
	   var noPictures = $("<p>目前沒有圖片</p>");
	   $("#preview_progressbarTW_imgs").append(noPictures);
	}
}
$(function() {
	$("#progressbarTWInput").change(function(){
		$("#preview_progressbarTW_imgs").html(""); // 清除預覽
		readURL(this);
		
	});
});