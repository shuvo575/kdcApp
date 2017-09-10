<?php	
	session_start();
	ob_start();
	if(isset($_SESSION['username'])){
	require('config.php');
	get_header();
	$username=$_GET['u'];
	$sel= "SELECT * FROM users WHERE username='$username'";
	$res= $db-> query($sel);
	$data=$res-> fetchArray(SQLITE3_ASSOC);
?>

<section class="container-fluid" id="test_list" >
	<div class="row">
		<div class="col-md-12 text-center" style="position: relative;">
			<h1 class="main_title text-capitalize"><?php echo $data['role']; ?>, Welcome Back</h1>
			<hr>
			<a title="All Users" class="edit_button" style="left: 50px; right:auto; top: 0px;" href="view_user.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
			<?php if($_SESSION['role']==='boss'){ ?>  <a title="New User" class="edit_button" style="right: 50px; top: 0px;" href="add_user.php"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a><?php } ?>
		</div>
		<div class="col-md-12 text-center">
			<div class="col-md-4 title"><label style="font-size: 22px!important;" for="">Name: <?php echo $data['name']; ?></label></div>
			<div class="col-md-4 title"><label style="font-size: 22px!important;" for="">Username: <?php echo $data['username']; ?></label></div>
			<div class="col-md-4 title"><label style="font-size: 22px!important;" for="">User ID: <?php echo $data['id']; ?></label></div>
		</div>
		<div class="col-md-12 text-center">
			<div class="col-md-4 title"><label style="font-size: 22px!important;" for="">Degree: <?php echo $data['degree']; ?></label></div>
			<div class="col-md-4 title"><label style="font-size: 22px!important;" for="">Designation: <?php echo $data['desig']; ?></label></div>
			<div class="col-md-4 title"><label style="font-size: 22px!important;" for=""></label></div>
		</div>
		<div class="col-md-12 text-center"><hr>
		<?php 
		
		if($success=$_GET['s']==='s'){
			echo "<h2 class='title'><b style='color:green;'>Password Updated!</b></h2><p><b>Now You Should Use Your New Password to Login!</b></p>";
		}else{ ?> <h2 class="title">To Change Your Password</h2><h3>Re-Enter Your Password</h3></div>
		<form method="post">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="password" name="pass" placeholder="Enter Current Password" required></div>
				<div class="col-md-12 text-center"><input type="submit" value="Update Password" id="go"></div>
			</div>
			<div class="col-md-4"></div>
		</form>
		<?php } ?>
	</div>
</section>
<section class="text-center col-md-12" style="color: red; font-size: 18px;"><b>
<?php 
	if(!empty($_POST)){
		$pre_pass= $data['pass'];
	 	$pass=md5($_POST['pass']);
		if($pre_pass===$pass && $pass!==''){
			header('location: user_check.php?u='.$_SESSION['username']);
		}else{
			echo('Please! Enter Your Password Correctly!');
		}
	
	}
?>


</b>

</section>








<?php 
	get_footer(); 
	}else{
	header('location: login.php');
	} ?>