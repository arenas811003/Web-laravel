function StopDel(){
	alert("最高權限無法操作");
}

function Delete(id,url){

	data="ID="+id;
	console.log(data);
	if(confirm("確實要刪除這筆資料？")){
		$.ajax({
		type:'delete',
		url:url+'/destroy',
		data : data,
		dataType:'text',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},

			success:function(data){
				//alert(data);
				if(data == "true"){
					alert("已刪除");
					location.href="/user";
				}
				
			}
		});	
	}else{
		alert("已取消動作");
	}
	
}

function newuser(url){
	var name=document.getElementById('name').value;
	var account=document.getElementById('account').value;
	var password=document.getElementById('password').value;
	var email=document.getElementById('email').value;
   	var select=document.getElementById('select').selectedIndex -1;
	//console.log(typeof(select));	
	var Regxp = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]){2,4}$/; 
	// console.log(name);
	// console.log(account);
	// console.log(password);
	// console.log(email);
    // console.log(select);
    console.log(typeof(select)); 
    select = select.toString();
    
	if(name != "" &&  account!= "" && password !="" && email !="" && select!= "-1"){	
		if(Regxp.test(email) == true){
			data="username="+name+"&account="+account+"&password="+password+"&email="+email+"&select="+select;
			//data=$('#form').serialize();
			//Bar(50);
            //console.log(data);
            // console.log(url);
            //data="name="+name;
			$.ajax({
                    type:'POST',
                    url:url,
                    data : data,
					dataType:'text',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
                        success:function(data){
							
                            data=JSON.parse(data);
                            if(data.success){
                                alert("新增成功");
                                    location.href="/user";
                            }else{
								//document.getElementById("demo").innerHTML = data.error;
								$( "p" ).find("span").empty();
								$.each(data.error,function(key,value){
									console.log(value);
									$( "p" ).find( "span" ).append("<li>"+value+"</li>").css( "color", "red" );
									// $('.print-error-msg').find('ul').
								});
								//$( "p" ).find( "span" ).css( "color", "red" );
                                // if(data=="false"){
                                //     alert("此帳號已存在");
                                    
                                // }
                            }
                        
                        }
            });	
            		
		}else{
			alert("電子信箱格式錯誤");
		}
		
	}else{
			alert("尚有空白未填取/選取");
	}
}
function userupdate(url){
	var name=document.getElementById('name').value;
	var account=document.getElementById('account').value;
	var password=document.getElementById('password').value;
	var email=document.getElementById('email').value;
    var select=document.getElementById('select').value;
	var Regxp = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]){2,4}$/; 

	if(select == "主控端"){
		select = "0";
	}
	if(select == "主管端"){
		select = "1";
	}
	if(select == "客戶端"){
		select = "2";
	}
	if(name != "" &&  account!= "" && password !="" && email !="" && select!=""){	

		if(Regxp.test(email) == true){
			//data="username="+name+"&account="+account+"&password="+password+"&email="+email+"&select="+select;
			data=$('#form').serialize();
			//Bar(50);
			console.log(data);
			$.ajax({
				type:'POST',
				url:url,
				data : data,
				dataType:'text',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success:function(data){
                    data=JSON.parse(data);
                    if(data.success){
						alert("修改成功");
							location.href="/user";
                    }else{
                        $( "p" ).find("span").empty();
								$.each(data.error,function(key,value){
									console.log(value);
									$( "p" ).find( "span" ).append("<li>"+value+"</li>").css( "color", "red" );
									// $('.print-error-msg').find('ul').
								});
								//$( "p" ).find( "span" ).css( "color", "red" );
                                // if(data=="false"){
                    }
				}
			});			
		}else{
			alert("電子信箱格式錯誤");
		}
		
	}else{
			alert("尚有空白未填取/選取");
	}
}
