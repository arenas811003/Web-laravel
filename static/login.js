function check(url){
	var account=document.getElementById('form')[0].value;
	var password=document.getElementById('form')[1].value;
	
	if(account !="" && password !="" ){	
		data=$('#form').serialize();
		$.ajax({
			type:'POST',
			url:url,
			data : data,
			dataType:'text',
			success:function(data){
				console.log(data);
				if(data=="true"){
					
					location.href="/search";
				}
				if(data=="false"){
					
					alert("帳號密碼錯誤");
					
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

		if(account == "" || password == ""){
			alert("請輸入帳號與密碼");
		
		}
	}
	
}



