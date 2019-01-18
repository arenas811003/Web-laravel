@extends('main')
@section('content')

<html>
    <head>
        <script type="text/javascript"src="static\additem.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
    <h1>新增工作項目</h1>
        <!-- <form method="GET" id="form" name="form" action="additem.php" enctype="multipart/form-data"> -->
        <input type="radio" name="radio"id="radio1" onclick="text()">
        <span>新增類別 </span>
        <input type="radio" name="radio"id="radio2" onclick="text()" checked>
        <span>新增工程 </span><br>
        
        <div id="1" style="display:inline-block">

        <form method="POST" id="form" name="form" enctype="multipart/form-data">
        <span>類別: </span>
            @csrf
            <select id="select" name="select">
            <option></option>
                @foreach($Type as $colum)
                        <option>{{$colum['type']}}</option>
                @endforeach

            </select>
            <th>工程:<th><input type = "text" name="project" id="add2">
            <th>圖片:<th><input id="progressbarTWInput" name="file[]" type="file" multiple="multiple" enctype="multiple/form-data" accept="image/jpeg">
            
            <input type = "button"class="btn btn-outline-dark" value="新增"  onclick="check('additem')" >
            <p><span> </span></p>

            <div id="preview_progressbarTW_imgs"  >


                <p></p>


            </div>
        </form>
        
        
        
        </div>	
        <div id="2" style="display:none">
            <form method="GET" id="form2" name="form2" action="additem.php">
            @csrf
                <th>新增類別:<th><input type = "text" name="select" id="add">
                <input type = "button"class="btn btn-outline-dark" value="新增" onclick="FtypeCheck('additem')">
            </form>
            <p><span> </span></p>
            
            <span>所有類別: </span>
            <select id="select2" name="select2">
                    <option></option>
                    @foreach($Type as $colum)
                        <option>{{$colum['type']}}</option>
                    @endforeach

                    <input type = "button"class="btn btn-outline-dark" value="刪除" onclick="Del_Type('additem');">
            </select>

        </div>
            
    </body>

<html>







@endsection