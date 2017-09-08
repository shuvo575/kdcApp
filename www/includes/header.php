<?php
    $linkss=explode('/',$_SERVER['PHP_SELF']);
	//echo $linkss[1];
   	$page=$linkss[1];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>KATIADI DIAGNOSTIC CENTER</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="css/dataTable.css" rel="stylesheet" type="text/css">
		<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
		#alert{
			position: fixed;
			text-align: center;
			left: 50%;
			margin-left: -260px;
			top: 250px;
			padding: 5px;
			border: 5px solid #FFED00;
			width: 510px;
			font-size: 28px;
			background-color: red;
			color: yellow;
			font-weight: bolder;
			border-radius: 20px;
			box-shadow: 0px 0px 5px 5px black;
			z-index: 999;
			text-transform: capitalize;
			display: none;
		}
		.stimer{
			background-color: yellow;
			color: red;
			font-size: 32px;
			padding: 2px 12px;
			border-radius: 15px;
		}
		
		#alert > sub{
			color: antiquewhite;
			font-style: italic;
			
		}
	</style>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/moment.js"></script>
	<script src="js/DataTables.V1.10.15.js"></script>
	<script>
		var timer = 0;
		var atimer = 0;
		var stimer = 300;
		function set_interval() {
		  // the interval 'timer' is set as soon as the page loads
		  timer = setInterval("auto_logout()", 300000);
		  atimer = setInterval("auto()", 270000);
		  // the figure '10000' above indicates how many milliseconds the timer be set to.
		  // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300,000 millisec.
		  // So set it to 300000
			
			var interval = setInterval(function() {
			stimer--;
			$('.stimer').text(stimer);
			if (stimer === 0) clearInterval(interval);
			}, 1000);
		}

		function reset_interval() {
		  //resets the timer. The timer is reset on each of the below events:
		  // 1. mousemove   2. mouseclick   3. key press 4. scroliing
		  //first step: clear the existing timer

		  if (timer != 0) {
			clearInterval(timer);
			timer = 0;
			// second step: implement the timer again
			timer = setInterval("auto_logout()", 300000);
			// completed the reset of the timer
		  }
			if (atimer != 0) {
			clearInterval(atimer);
			atimer = 0;
			// second step: implement the timer again
			atimer = setInterval("auto()", 270000);
			// completed the reset of the timer
			document.getElementById('alert').style.display='none';
		  }
			if(stimer != 300){
			stimer = 300;
			}
		}

		function auto_logout() {
		  // this function will redirect the user to the logout script
		  window.location = "logout.php";
		}
		function auto() {
		  // this function will redirect the user to the logout script
		  //alert('You are going to be logged out due to inactivity!');
			document.getElementById('alert').style.display='block';
		}
		
		//contexmenu 
		/* $(document).on("contextmenu",function(e){

			 if( e.button == 2 ) {
				 e.preventDefault();
				  document.getElementById('alert').style.display='block';
			 }
		return true;
		}); */
		
		//clock script
		
		
		function clock(){

		//Save the times in variables

		var today = new Date();

		var hours = today.getHours();
		var minutes = today.getMinutes();
		var seconds = today.getSeconds();


		//Set the AM or PM time

		if (hours >= 12){
		  meridiem = " PM";
		}
		else {
		  meridiem = " AM";
		}


		//convert hours to 12 hour format and put 0 in front
		if (hours>12){
			hours = hours - 12;
		}
		else if (hours===0){
			hours = 12;	
		}

		//Put 0 in front of single digit minutes and seconds

		if (minutes<10){
			minutes = "0" + minutes;
		}
		else {
			minutes = minutes;
		}

		if (seconds<10){
			seconds = "0" + seconds;
		}
		else {
			seconds = seconds;
		}


		document.getElementById("clock").innerHTML = (hours + ":" + minutes + ":" + seconds + meridiem);

		}


		setInterval('clock()', 1000);

	</script>
	
</head>
	<body style="padding-top: 70px" onload="set_interval()" onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				  <a class="navbar-brand" href="index.php"><img src="pics/logo.png" height="50" alt="logo"></a></div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="topFixedNavbar1">
				  <ul class="nav navbar-nav">
					<li<?php if($page==='index.php'){ echo ' class="active"'; } ?>><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
					<li<?php if($page==='view_doctor.php'){ echo ' class="active"'; } ?>><a href="view_doctor.php">Doctors</a></li>
					<li<?php if($page==='view_patient.php'){ echo ' class="active"'; } ?>><a href="view_patient.php">Patients</a></li>
					<li<?php if($page==='last_patient.php'){ echo ' class="active"'; } ?>><a href="last_patient.php">Last Entry</a></li>
					<li id="clock"></li>
				  </ul>
				  <ul class="nav navbar-nav navbar-right">
       				
        			<li<?php if($page==='user.php'){ echo ' class="active"'; } ?>><a class="text-capitalize" href="user.php?u=<?php echo $_SESSION['username']; ?>&s=n">Welcome Back, <?php echo($_SESSION['username']); ?></a></li>
        			<li><a href="logout.php">Logout</a></li>
				</ul>
				</div>
				
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
		<div id="alert">You are going to be logged out due to inactivity! In <b class="stimer">180</b> Seconds!! <sub>Move mouse or press any key to stay logged in.</sub></div>