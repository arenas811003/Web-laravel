
@extends('main')
@section('content')

<html>
        <head>
                <script type="text/javascript"src="static\user.js"></script>
                <meta name="csrf-token" content="{{ csrf_token() }}" />
        </head>
            
            <h1>使用者管理
            <button class="btn btn-outline-dark" onclick="location.href='/newuser';">新增使用者</button>
            </h1>
            <table class="table table-hover">
                <tr>
                    <th>名稱</th>
                    <th>帳號</th>
                    <th>信箱</th>
                    <th>使用者權限</th> 
                    <th>修改名稱/密碼/權限</th> 
                    <th>刪除使用者</th> 
                </tr>
               
                @foreach($user as $colum)
                <tr>
                    <td>{{$colum['username']}}</td>
                    <td>{{$colum['account']}}</td>
                    <td>{{$colum['email']}}</td>
                    @if($colum['permission'] == 0)
                        <td>主控端</td>
                    @endif
                    @if($colum['permission'] == 1)
                        <td>主管端</td>
                    @endif
                    @if($colum['permission'] == 2)
                        <td>客戶端</td>
                    @endif
                    <td><button id="{{$colum['id']}}"class='btn btn-outline-dark' onclick="location.href='/userupdate?id={{$colum['id']}}&name={{$colum['username']}}&account={{$colum['account']}}&email={{$colum['email']}}&permission={{$colum['permission']}}'";>修改</button></td>
                    @if($colum['account'] != "Admin")
                    <td><button id="{{$colum['id']}}"class='btn btn-outline-dark' onclick="Delete(this.id,'user')">刪除</button></td>
                    @else
                    <td><button id="{{$colum['id']}}"class='btn btn-outline-dark' onclick="StopDel()">刪除</button></td>
                    @endif

                </tr>

                @endforeach
            </table>

</html>
@endsection				