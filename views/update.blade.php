@extends('main')
@section('content')
<html>
    <head>
        <script type="text/javascript"src="static\update.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
        <body>

        <h1>修改工作項目</h1>
                <form method="POST" id="form" name="form" action="update" enctype="multipart/form-data">
                @csrf
                    <th>類別:<th>
                    
                    
                    <select id="select" name="select" >
                    
                
                            @foreach($F_TYPE as $colum)
                                
                                <option>{{$colum->F_TYPE}}</option>

                            @endforeach
                    </select>
                    
                    <th>工程:<th>
                    
                        
                    
                        <input type = 'text' id='add2' name='project' value='{{$url->F_NAME}}'>
                        <input type = 'hidden' name='exfid' value='{{$url->FID}}'>
                        <input type = 'hidden' name='extype' value='{{$url->F_TYPE}}'>
                        <input type = 'hidden' name='exname' value='{{$url->F_NAME}}'>
                    
                    
                    <th>圖片:<th><input name = "file[]" type = "file" multiple='multiple'accept = "image/jpeg">	
                        
                    <input type = "button"class="btn btn-outline-dark"  value="修改" onclick="update_check('update')"><br><br>
                    <p><span></span></p>
                  
                    <!-- <img src="{{asset('storage/upload/TK-無捆包/123456.jpg')}}" width=500  height=333> -->
                    </form> 
                    @if(isset($files))
                        @foreach($files as $file)
                        <img src='{{$file}}' width=500  height=333>
                        @endforeach
                    @endif 
                     
        </body>
</html>


@endsection