@extends('main')
@section('content')

<html>
					<head>
                            <script type="text/javascript"src="static\piwork.js"></script>
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
							
                    </head>
                <body>
                <h1>指派工作項目</h1>
                    <form method="POST" id="form" name="form" action="">
                        <th>名稱:</th><input type = "text" name="add" value="{{$bladevalue['describe']}}" onkeypress="if(event.keyCode == 13){ return false;}">
                        <input type = "button"class="btn btn-outline-dark"  value="修改" onclick="modify('/setwork')"  >
                        <p><span></span><p>
                    </form>

                    <span>當前工作項目</span>

                    <form>            
                            <span>類別:{{$bladevalue['type']}}</span>
                            <span>工程:{{$bladevalue['name']}} </span>
                        
                        <input type="hidden" id="pid" name="pid" value="{{$bladevalue['pid']}}">
                    </form>

                    <div class="input-group">
                    <form id="form" class="form-inline" >

                    <span>類別: </span>
                    <select id = "select"class="custom-select mr-sm-3" onclick="F_NAME('/setwork')">

                            <option></option>
                            @foreach($F_TYPE as $colum)
                                <option>{{$colum['F_TYPE']}}</option>
                            @endforeach
                    </select>
                        
                    <span>工程: </span>

                    <select id = "select_"class="custom-select mr-sm-3">
                    </select>

                        <input class="btn btn-outline-dark my-0 my-sm-10" type="button" value="指派" onclick="piwork_page('/setwork?')">
                  
                    </form>
                
                    
                </div>
                @if(isset($files))
                        @foreach($files as $file)
                            <img src='{{$file}}' width=500  height=333>
                        @endforeach
                @endif
            </body>
</html>

@endsection