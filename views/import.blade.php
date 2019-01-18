@extends('main')
@section('content')
<html>
            <head>
                    <script type="text/javascript"src="static\excel_import.js"></script>
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
            </head>
            <h1>Excel匯入</h1>
                <form method="POST" id="form" name="form" action='import'enctype="muktipart/form-data" >
                    @csrf
                    <th>Excel檔案:<th><input id="excel"name = "file" type = "file" accept = "application/vnd.ms-excel">	
                    <input type = "button" onclick="Excel_ajax('import')" value="新增" ><br><br>
                </form>

                <form method="POST" id="pdf" name="pdf" action="pdf_import.php" enctype="multipart/form-data">
                    <th>PDF檔:<th><input id="file"name = "file[]" type = "file"multiple='multiple' accept = "application/pdf">	
                    <input type = "button" onclick="PDF_ajax('import')" value="新增" ><br><br>
                  
                </form>
                <tr>
                <span id="ajax"></span><br>
                
                <div class="progress">
                    <div id="bar"class="progress-bar progress-bar-striped"role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"><span id="percent"></span></div>
                </div>
               

                <span id="message"></span><br>
                
                <span id="htmltext"></span><br>
                </tr>
                
</html>


@endsection