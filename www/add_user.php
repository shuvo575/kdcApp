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
			<h1 class="main_title text-capitalize">New User</h1>
			<hr><div class="col-md-12">
			<a class="back_button" href="user.php?u=<?php echo $_SESSION['username']; ?>&s=n"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
		</div>
		</div>
		
		<form method="post">
			<div class="col-md-12 text-center">
				<h2 class="title">Boss Can Do Everything!</h2>
				<p>Only Password can be changed after adding a user. And username must be <b>unique.</b></p>
			</div>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="text" name="name" placeholder="Enter Full Name" required></div>
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="text" name="username" placeholder="Enter username" required></div>
				<div class="col-md-12 form_row" style="margin-bottom: 15px;">
				<select name="role" required>
					<option value="">Choose Role</option>
					<option value="boss">Boss</option>
					<option value="admin">admin</option>
				</select>
				</div>
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="password" name="pass" placeholder="Enter New Password" required></div>
				<div class="col-md-12 form_row" style="margin-bottom: 15px;"><input class="text-center" type="password" name="pass2" placeholder="Re-Enter New Password" required></div>
				<div class="col-md-12 text-center"><input type="submit" value="Add User" id="go"></div>
			</div>
			<div class="col-md-4"></div>
		</form>
	</div>
</section>
<section class="text-center" style="color: red; font-size: 18px;"><b>
<?php

if(!empty($_POST)){
     $name=$_POST['name'];
     $username=$_POST['username'];
     $role=$_POST['role'];
     $pass=$_POST['pass'];
     $repass=$_POST['pass2'];
		$sel= "SELECT * FROM users WHERE username='$username'";
		$res= $db-> query($sel);
		$data=$res-> fetchArray(SQLITE3_ASSOC);
	if(!$data){
     if($pass===$repass && $pass!==''){
		 $insert="INSERT INTO users (username,pass,role,status,name) VALUES ('$username','$pass','$role','1','$name')";
    
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