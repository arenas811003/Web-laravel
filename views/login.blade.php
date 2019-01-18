<html>
    
	
	<head>
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="bootstrap-4.1.3/dist/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="bootstrap-4.1.3/site/docs/4.1/examples/sign-in/signin.css">
			<script type="text/javascript"src="static\login.js"></script>
			<script type="text/javascript"src="dist\js\jquery.min.js"></script>
            <!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->
	</head>	
	<body class = "text-center">
	
			<form class = "form-signin" method="POST" id="form" name="form">
			<p><span></span><p>
               	@csrf
				<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
				<input type="text" class="form-control" name="account" placeholder="帳號" required autofocus>
				<input type="password" class="form-control" name="password" placeholder="密碼" required>
				<input type="button" class="btn btn-lg btn-primary btn-block" value="登入" onclick="check('/login');">
				<!-- <input type="button"  class="btn btn-lg btn-secondary btn-block" value="忘記密碼" onclick="location.href='/email';" > -->
				
            </form>
			

	</body>	
</html>	