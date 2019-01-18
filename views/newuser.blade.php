@extends('main')
@section('content')

<html>
        <head>
                <script type="text/javascript"src="static\user.js"></script>
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                
        </head>

                
        <h1>新增使用者</h1>
        
            <form method="POST" id="form" name="form" action="test.php" class="form-inline">

                <th>名稱:</th><input type = "text" id="name" name ="name">
                <th>帳號:</th><input type = "text" id="account" name = "account" placeholder="3~16英文數字">
                <th>密碼:</th><input type = "password" id="password" name = "password" placeholder="3~16英文數字">
                <th>Email:<th><input type = "text" id="email" name= "email"value="">
                <span>使用權限:</span>
                <select id ="select"class="custom-select mr-sm-3">
                        <option></option>
                        <option>主控端</option>
                        <option>主管端</option>
                        <option>客戶端</option>
                </select>
                <input class="btn btn-outline-dark my-0 my-sm-10" type="button" value="新增" onclick="newuser('newuser')">
                                                                                                                                    
            </form>

            <p id="demo"><span></span></p>
</html>
@endsection	
				