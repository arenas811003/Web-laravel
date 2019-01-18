@extends('main')
@section('content')
<html>
    <head>
        <script type="text/javascript"src="static\search.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <h1>搜尋/修改工作</h1>
                        
                        <!-- {{$table}} -->
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="input-group">
                                <form id="form" class="form-inline" >
                                    <span>類別: </span>
                                    <span> &nbsp;</span>
                                    <select id="select" class="custom-select" onclick="getType('/search')">
                                    <option> </option>
                                    @foreach($F_TYPE as $colum)
                                        <option>{{$colum['F_TYPE']}}</option>
                                    @endforeach
                                    </select>
                                    <span> &nbsp;</span>
                                    
                                    <span>工作項目: </span>
                                    <span> &nbsp;</span>
                                    <select id="select_type" class="custom-select">


                                        <option></option>
                                        
     
                                     
                                    </select>
                                    <span> &nbsp;</span>
                                    <span> 關鍵字搜尋: </span>
                                    <span> &nbsp;</span>   
                                    <input type="text" id="keyword" onclick="keywords()"onkeypress="if (event.keyCode == 13){search('/search?'); return false;}">
                                    <span> &nbsp;</span>
                                    <span> &nbsp;</span>
                                    <input class="btn btn-outline-dark my-0 my-sm-10" type="button" value="搜尋" onclick="search('/search?')">
                                </form>
                        

                            </div>
                        </nav>

        <table id ="datatable"class="table table-hover">
        <thead>
            <tr>
                <th>類別</th>
                <th>工程</th> 
                @if($permission['permission'] != 2) 
                <th>名稱/圖片</th> 
                <th>刪除資料</th> 
                @endif
            </tr>
        </thead>
        <!-- {% if message != "" %}
        <tr>
            <td>搜尋 "{}" 無此筆資料</td>
        </td> -->
        <!-- {% endif%} -->
        @if(isset($message))
        
            <td>搜尋"{{$message}}"無此筆資料</td>
        
        @endif

        @foreach($table as $colum)
        <tr>
            <td>{{$colum['F_TYPE']}}</td>
            <td>{{$colum['F_NAME']}}</td>
            @if($permission['permission'] != 2) 
            <td><button class="btn btn-outline-dark"id="{{$colum['FID']}}" onclick="location.href='/update?FID={{$colum['FID']}}&F_TYPE={{$colum['F_TYPE']}}&F_NAME={{$colum['F_NAME']}}'">修改</button></td>
            <td><button class="btn btn-outline-dark" id="{{$colum['FID']}}" onclick="Delete(this.id,'search')">刪除</button></td>
            
            @endif
        </tr>
        @endforeach
        </table>
       
<html>
            
<div class="row">
	<div class="col-sm"></div>			
		<div class="col-sm">			
			<div id="pagination" name="pagination">
				<nav aria-label="...">
					
					{{$table->appends($parameter)->links()}}
					
				</nav>
			</div>
		</div>
	<div class="col-sm"></div>			
</div>


@endsection