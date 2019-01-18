@extends('main')
@section('content')
<html>
    <head>
            <script type="text/javascript"src="static\piwork.js"></script>
            <meta name="csrf-token" content="{{ csrf_token() }}" />     
    </head>
    <body>
    <h1>工作清單</h1>
            <table class="table table-hover">

            <tr>
                <th>名稱</th>
                <th>類別</th>
                <th>工程</th>
                <th>網卡名稱</th> 
                @if($permission['permission'] != 2)
                <th>修改/指派</th> 
                <th>刪除</th> 
                @endif
            </tr>



        @if(isset($worklist))
            @foreach($worklist as $colum)
                <tr>
                    <td>{{$colum['P_DESCRIBE']}}</td>
                    <td>{{$colum['F_TYPE']}}</td>
                    <td>{{$colum['F_NAME']}}</td>
                    <td>{{$colum['P_NAME']}}</td>
                    @if($permission['permission'] != 2)
                    <td><button id="{{$colum['P_FID']}}"class="btn btn-outline-dark" onclick="location.href='/setwork?PID={{$colum['id']}}&P_DESCRIBE={{$colum['P_DESCRIBE']}}&F_TYPE={{$colum['F_TYPE']}}&F_NAME={{$colum['F_NAME']}}'">指派工作</button></td>
                    <td><button id="{{$colum['P_FID']}}"class="btn btn-outline-dark" onclick="Delete(this.id,'/piwork')">刪除資料</button></td>
                    @endif
                </tr>
                
                @endforeach
        @endif
            </table>
    </body>
</html>

@endsection