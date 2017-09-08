<?php
	session_start();
	ob_start();
	require_once("config.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="css/main.css" rel="stylesheet" type="text/css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="js/vendor/modernizr-2.6.2.min.js"></script>
		
	</head>
	<body>
		<div id="loader-wrapper">
			<div id="loader"></div>
			<div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
		</div>
		<div class="container-fluid text-center">
			<div class="row" style="margin-top: 35px;">
			<img src="pics/logo.png" width="400" alt="KDC">
				<div class="col-md-12" style="margin-bottom: 30px;">
					<h2 class="title">Please Login!</h2>
					<b><?php
				if(!empty($_POST)){
					$username=$_POST['username'];
					$password=md5($_POST['password']);
					$sel= "SELECT * FROM users WHERE username='$username' AND pass='$password'";
					$res_qry = $db-> query($sel);
					$check = $res_qry-> fetchArray(SQLITE3_ASSOC);
					if($check){
						if($check['status']==1){
							$_SESSION['username']= $check['username'];
							$_SESSION['role']= $check['role'];
							$_SESSION['id']= $check['id'];
							header('location: index.php');
						}else{
							echo('<h4 style="color:red;">You are blocked! Contact Boss Immediately!!</h4>');
						}
						
					}else{
						echo('<h4 style="color:red;">Password or Username is wrong!</h4>');
					}
				}
				?></b>
				</div>
				<form method="post">
					<div class="col-md-4"></div>
			  	  <div class="col-md-4">
						<input type="text" class="text-center" name="username" placeholder="username" autocomplete="off" required><br><br>
						<input type="password" class="text-center" name="password" placeholder="password" required><br><br>
					  <input type="submit" value="Login" id="go">
					</div>
					<div class="col-md-4"></div>
				</form>
			</div>
		</div>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
		<script src="js/main.js"></script>
		<script src="js/jquery-1.11.3.min.js"></script>
		<script>
		$(document).ready(function() {
    	setTimeout(function(){
        $('body').addClass('loaded');
    }, 1800);
 
});</script>
	</body>
</html>
