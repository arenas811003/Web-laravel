function getType(url){
	var F_TYPE = document.getElementById("select").value;
	
	if(F_TYPE != ""){
		document.getElementById('keyword').value = "";
		
	}
    data = "F_TYPE="+F_TYPE;
	$.ajax({
		type:'GET',
		url:url+'/show',
		data : data,
		dataType:'text',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success:function(data){
			//data=JSON.parse(data);
			console.log(data);
			var str=data;
			var i = 1;
			var text="<option></option>";
            var FNAME = str.split("-");
            
            while(FNAME[i] != "end" && FNAME[i] != undefined ){ 
				text+= "<option>"+FNAME[i]+"</option>";   
                i++;               
            }	
            // for(k=1;k<i-1;k++){
            //     text+= "<option>"+FNAME[k]+"</option>";
            // }
			document.getElementById("select_type").innerHTML= text;
		}	
	});
}

function keywords(){
	document.getElementById("select").value = "";
	document.getElementById("select_type").value = "";

}
// ----------------------------------------------------------------------------------//
function Delete(id,url){
	console.log(id);
	data="FID="+id;
	
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
				if(data == "true"){
					alert("已刪除");
				}
				
				location.href="search?";
				
			}
		});	
	}else{
		alert("已取消動作");
	}
	
}

function search(url){
	
	var F_Type = document.getElementById("select").value;
	var F_Name = document.getElementById("select_type").value;
	var keywords = document.getElementById("keyword").value;
	
	if(F_Type != ""){
		location.href=url+"F_TYPE="+F_Type+"&F_NAME="+F_Name;
	}else{
		location.href=url+"F_TYPE="+F_Type+"&F_NAME="+F_Name;
	}
	
	if (keywords != ""){
		location.href=url+"F_TYPE=&F_NAME="+keywords;
	}
	
}
