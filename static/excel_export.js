

// function test(){
// 	location.href=url+"F_TYPE=&F_NAME=";
// 	//console.log("data");
// }


function Excel_path(){
	var htmltable=document.getElementById("datatable");
	var html ="<html><head><meta http-equiv='Content-Type content='text/html;charset='utf-8'></head><body>"+htmltable.outerHTML+"</body></html>"

	//var html =htmltable.outerHTML
	
	//console.log(html);
	//window.open('data:application/vnd.ms-excel,'+ encodeURIComponent(html));
	window.open('data:application/vnd.ms-excel,'+ encodeURIComponent(html));

}