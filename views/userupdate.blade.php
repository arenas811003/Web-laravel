@extends('main')
@section('content')
<html>
    <head>
        <script type="text/javascript"src="static\user.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    

    <h1>修改名稱/密碼/權限</h1>
    <form method="POST" id="form" name="form" action="/userupdate" class="form-inline">
        @csrf
        <th>名稱:<th><input type = "text" id="name"name="username" value="{{$url->name}}">
        <th>密碼:<th><input type = "password" id="password"name="password" value="">
        <th>Email:<th><input type = "text" id="email"name="email" value="{{$url->email}}">
        <th>權限:<th>
      
        <select class="custom-select mr-sm-3"id="select" name="select" >
            @if(isset($option))

                @if($option->account == 'Admin')
                    <option>主控端</option>

                @elseif($option->permission == 0) 
                        <option>主控端</option>
                        <option>主管端</option>
                        <option>客戶端</option>
                @endif

                @if($option->permission == 1) 
                        <option>主管端</option>
                        <option>主控端</option>
                        <option>客戶端</option>
                @endif
                
                @if($option->permission == 2) 
                        <option>客戶端</option>
                        <option>主控端</option>
                        <option>主管端</option>
                @endif

            @endif
       
        </select>
        <input type = "hidden" name = 'account'id="account"value="{{$url->account}}">
        <input type = "hidden" name = 'exemail' id="exemail"value="{{$url->email}}">
        <input type = "button"class="btn btn-outline-dark"  value="修改" onclick="userupdate('/userupdate');"><br><br>
    </form>
    <p id="demo"><span></span></p>
</html>


@endsection