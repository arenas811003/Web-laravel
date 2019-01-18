@extends('main')
@section('content')
<html>
    <head>
            <meta charset="utf-8">
            <script type="text/javascript"src="static\excel_export.js"></script> 
            <script type="text/javascript"src="static\search.js"></script>
        
    </head>
        <body>
            <h1>Excel匯出</h1>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="input-group">
                    <form id="form" class="form-inline" >
                        <span>類別: </span>
                        <span> &nbsp;</span>
                        <select id="select" class="custom-select" onclick="getType(this)">
                        <option> </option>
                        @foreach($F_TYPE as $colum)
                                <option>{{$colum['F_TYPE']}}</option>
                        @endforeach
                    
                        </select>
                        <span> &nbsp;</span>
                        
                        <span>工作項目: </span>
                        <span> &nbsp;</span>
                        <select id="select_type" class="custom-select">

                            
                            <option> </option>


                        </select>
                        <span> &nbsp;</span>
                        <span> 關鍵字搜尋: </span>
                        <span> &nbsp;</span>   
                        <input type="text" id="keyword" onclick="keywords()"onkeypress="if (event.keyCode == 13){search('/export?'); return false;}">
                        <span> &nbsp;</span>
                        <span> &nbsp;</span>
                        <input class="btn btn-outline-dark my-0 my-sm-10" type="button" value="搜尋" onclick="search('/export?')">
                    </form>
                    
                    <form class="form-inline" >
                        <span> &nbsp;</span>
                        <span> Excel: </span>
                        <span> &nbsp;</span>
                        <input class="btn btn-outline-dark my-0 my-sm-10" type="button"  value="匯出搜尋頁面" onclick='Excel_path()'>
                    </form>

                </div>
            </nav>
            <table id="datatable" class="table table-hover">
                <thead>
                    <tr>
                        <th>類別</th>
                        <th>工程</th> 
                    </tr>
                </thead>
            

                <tbody>
                @if(isset($message))
        
                 <td>查無"{{$message}}"無此筆資料</td>
    
                @endif
                        
                @foreach($table as $colum)
                <tr>
                    <td>{{$colum['F_TYPE']}}</td>
                    <td>{{$colum['F_NAME']}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </html>
        </div>
				 
	</body>	
</html>	


@endsection