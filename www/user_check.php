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

<div class="col-md-12 text-center"><hr><h2 class="title">Enter New password Twice!</h2></div>
		<form method="post">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="password" name="pass" placeholder="Enter New Password" required></div>
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="password" name="pass2" placeholder="Re-Enter New Password" required></div>
				<div class="col-md-12 text-center">
					<div class="row">
						<div class="col-md-5">
							<a class="cancel_button" style="top: 0px; right: 30px;" href="user.php?u=<?php echo $_SESSION['username']; ?>&s=n">Cancel</a>
						</div>
						<div class="col-md-7">
							<input type="submit" value="Change Password" id="go">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</form>
		<div class="col-md-12"><hr></div>
</section>

<section class="text-center col-md-12" style="color: red; font-size: 18px;"><b>
<?php 
	if(!empty($_POST)){
		$username= $data['username'];
	 	$pass=md5($_POST['pass']);
     	$repass=md5($_POST['pass2']);
		if($pass===$repass && $pass!==''){
			$update= "UPDATE users SET pass='$pass' WHERE username='$username'"; 
			if($db-> query($update)){
				echo "<b style='color:green;'>Password Updated!</b>";
				header('location: user.php?u='.$_SESSION['username'].'&s=s');
			}else{
				echo "Something Goes Wrong!";
			}
		}else{
			echo('Please Enter Same Password Twice!');
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