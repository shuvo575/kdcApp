<?php	
	session_start();
	ob_start();
	if($_SESSION['role']==='boss'){
	require('config.php');
	get_header();
		
?>
<section class="container-fluid" id="test_list" >
	<div class="row">
		<div class="col-md-12 text-center" style="position: relative;">
			<h1 class="main_title text-capitalize">Add New User</h1>
			<hr><div class="col-md-12">
			<a class="back_button" href="user.php?u=<?php echo $_SESSION['username']; ?>&s=n"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
		</div>
		</div>
		
		<form method="post">
			<div class="col-md-12 text-center">
				<h2 class="title"><b style="color: red;">Warning:</b> Boss Can Do Everything!</h2>
				<p><b style="color: red;">Only Password</b> can be changed after adding a user. And username must be <b style="color: red;">unique.</b></p>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="text" name="name" placeholder="Enter Full Name (It Will be Printed)!" required></div>
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="text" name="degree" placeholder="Enter Degree (It Will be Printed)!" required></div>
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="text" name="desig" placeholder="Enter Designation (It Will be Printed)!" required></div>
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="text" name="username" placeholder="Enter username For Login!" required></div>
				<div class="col-md-12" style="margin-bottom: 15px;">
				<div class="row">
					<div class="col-md-6 form_row">
						<input  class="text-center" type="text" value="Choose Role:" readonly>
					</div>
					<div class="col-md-6 form_row">
						<select name="role" required>
							<option value="boss">Boss</option>
							<option value="admin" selected>Admin</option>
						</select>
					</div>
				</div>
				</div>
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="password" name="pass" placeholder="Enter New Password!" required></div>
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="password" name="pass2" placeholder="Re-Enter New Password!!" required></div>
				<div class="col-md-12 text-center"><input type="submit" value="Add User" id="go"></div>
			</div>
			<div class="col-md-3"></div>
		</form>
	</div>
</section>
<section class="text-center" style="color: red; font-size: 18px;"><b>
<?php

if(!empty($_POST)){
     $name=$_POST['name'];
     $username=$_POST['username'];
     $degree=$_POST['degree'];
     $desig=$_POST['desig'];
     $role=$_POST['role'];
     $pass=md5($_POST['pass']);
     $repass=md5($_POST['pass2']);
		$sel= "SELECT * FROM users WHERE username='$username'";
		$res= $db-> query($sel);
		$data=$res-> fetchArray(SQLITE3_ASSOC);
	if(!$data){
     if($pass===$repass && $pass!==''){
		 $insert="INSERT INTO users (username,pass,role,status,name,degree,desig) VALUES ('$username','$pass','$role','1','$name','$degree','$desig')";
    
    			if($db->exec($insert)){
					echo "<b style='color:green;'>New record created successfully!</b>";
					header('location: view_user.php');
				}else{
         			echo "New record creation failed!";
				} 
	 }else{
		 echo('Password Not Matched!');
	 }
		}else{
		echo('Username Not Available!');
	}
		
	}
?>
	</b></section> 
	 <?php
		 
	get_footer(); 
	}else{
	header('location: index.php');
	} 
?>