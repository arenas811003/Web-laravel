function Excel_ajax(url){
	var form = document.getElementById('form');
	var data = new FormData(form);
	// console.log(form);
	// console.log(data);
	
	$.ajax({
			type:'POST',
			url:url,
			data : data,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
	
			cache:false,
			contentType:false,
			processData:false,
			xhr:function(){
			var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress",function(evt){
				var file = document.getElementById("excel").files.length;
						console.log(file);
				
					if(evt.lengthComputable && file != 0){
						var percent = evt.loaded / evt.total * 100;
						Math.round(percent);
						console.log(percent);
						Bar(percent)
					}
				},false);
				return xhr;
			},
	
			success:function(data){
				 
				console.log(data);
				if(data!= false){
					Bar(100);
					var message=data;
					
					var i = 1;
					message = message.split("-");
					var htmltext='';
					while( message[i]!= "end" && message[i]!=null){
						htmltext+='<td>'+message[i]+'</td><br>';
						//document.getElementById("message").innerHTML= text;
						i++;	
						console.log(htmltext);
					}
					if(htmltext != '' && htmltext!=null){
						document.getElementById("message").innerHTML="以下資料欄位新增失敗，請檢查Excel資料名稱格式是否包含 \',\",\- 特殊符號。"
						document.getElementById("htmltext").innerHTML= htmltext;
						
						alert("新增完畢");
						

							
					}else{
						//document.getElementById("message").innerHTML="";
						//document.getElementById("htmltext").innerHTML= "";
						
						alert("新增完畢");
						
					}

				}
				// if(data == "true"){
				// 	var bar = document.getElementById("bar");
				// 	document.getElementById("percent").innerHTML = "100%";
				// 	bar.style.width = '100%';
				// 	setTimeout("alert('Excel新增完畢');",2);
				// }else{
				// 	alert("未選取檔案/檔案格式為.xls");
				// }
			},
			// error:function(data){
				
			// 		alert(data);
	 		// //document.getElementById("ajax").innerHTML = data;
			// }
	
	
	});

}
function PDF_ajax(url){
	var form = document.getElementById('pdf');
	var data = new FormData(form);
	document.getElementById("percent").innerHTML = "0%";
	bar.style.width = '0%';
	$.ajax({
			type:'POST',
			url:url,
			data : data,
			cache:false,
			contentType:false,
			processData:false,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
	
			xhr:function(){
			var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress",function(evt){
				var file = document.getElementById("file").files.length;
						// console.log(file);
				
					if(evt.lengthComputable && file != 0){
						var percent = Math.round(evt.loaded / evt.total*100);
						// console.log(percent);
						Bar(50);
					}
				},false);
				return xhr;
			},
	
			success:function(data){
				console.log(data);
					//alert(data);
				if(data == "false"){

					alert('選取檔案');
				}
				if(data == "false1"){
					alert('檔案格式不正確');
				}
				if(data == "false2"){
					alert('檔案名稱格式不符合');
				}

				if(data != "false" && data != "false1" && data != "false2" ){
					Bar(100);
					var message=data;
					
					var i = 1;
					message = message.split("+");

					var htmltext='';
					// console.log(message);
					while( message[i] != "end" && message[i]!=null){
						htmltext+='<td>'+message[i]+'</td><br>';		
						i++;	

					}

					// console.log(htmltext);
					if(htmltext != '' && htmltext!=null){
						document.getElementById("message").innerHTML="下列圖檔新增失敗，請檢查檔案名稱是否已經匯入。";
						document.getElementById("htmltext").innerHTML= htmltext;
						
						
								
					}else{

						//document.getElementById("message").innerHTML="";
						document.getElementById("htmltext").innerHTML= "新增完畢";
						
						
						
					}	
				
			}
		},	
	});
}


function Bar(percent){
	var bar = document.getElementById("bar");
	var width = percent;
	// console.log(width);
	document.getElementById("percent").innerHTML = width + "%";
	bar.style.width = width + '%';
	
}
