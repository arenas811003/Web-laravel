function update_check(url){
    // var select=document.getElementById('select').value;
	// var add2=document.getElementById('add2').value;
	var form = document.getElementById('form');
	var data = new FormData(form);
	
	if(select != "" && add2 != ""){	
		//data=$('#form').serialize();
		//data="select="+select+"&add2="+add2;
		//Bar(50);
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
				
				//	console.log(data);
				if(data=="true"){
					alert("已修改");
					location.href="search";
				}
				if(data == "false"){

					alert('資料名稱已存在');

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