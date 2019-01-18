function Delete(id,url){

	data="ID="+id;
	//console.log(data);
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
				console.log(data);
				if(data == "true"){
					alert("已刪除");
					location.href="/piwork";				
				}
			}
		});	
	}else{
		alert("已取消動作");
	}
	
}

function modify(url){
	var PID = document.getElementById("pid").value;
	var name = document.getElementById("form")[0].value;
	console.log(name);
	data="name="+name+"&PID="+PID;
	$.ajax({
			type:'GET',
			url:url+"/name/edit",
			data : data,
			dataType:'text',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}, 
			success:function(data){
				console.log(data);
				if(data == "true"){
				  alert("修改成功");	

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
}


function F_NAME(url){
	var F_TYPE = document.getElementById("select").value;
	//console.log(F_TYPE);

	data = "F_TYPE="+F_TYPE;
	$.ajax({
		type:'GET',
		url:url+'/show',
		data : data,
		dataType:'text',
		success:function(data){
			console.log(data);
			str=data;
			var i =1;
            var text="<option></option>";
            var FNAME = str.split("-");
            
			while(FNAME[i] != "end" && FNAME[i] != undefined ){ 
				text+= "<option>"+FNAME[i]+"</option>";   
                i++;               
            }	
            
			document.getElementById("select_").innerHTML= text;
		}
		
	});

}



function piwork_page(url){
	var F_TYPE = document.getElementById("select").value;
	var F_NAME = document.getElementById("select_").value;
	var PID = document.getElementById("pid").value;
	console.log(F_TYPE)
	console.log(F_NAME)
	console.log(PID)
	data="Type="+F_TYPE+"&Project="+F_NAME+"&id="+PID;
	if(F_TYPE != "" && F_NAME != ""){
		
		$.ajax({
			type:'POST',
			url:url,
			data : data,  
			dataType:'text',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}, 
            success:function(data){
				console.log(data);
                if(data == "true"){
                    location.href="/piwork";
                }
            }
		});
        
		
	}else{

		alert("請選擇類別與工程項目");
	}
}