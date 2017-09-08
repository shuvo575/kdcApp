<?php
	session_start();
	if(isset($_SESSION['username'])){
	require_once("config.php");
	get_header();
	if($_SESSION['role']==='boss'){	

?>
    <section class="container-fluid" id="test_list" >
    	<div class="row">
    		<div class="col-md-12 text-center">
    			<h1 class="main_title">KATIADI DIAGNOSTIC CENTER</h1>
    			<hr>
    			<h2 class="title">--New Doctor--</h2>
    			<form method="post" id="p_form" class="text-left">
    				<div class="col-md-6 form_row">
    					<label for="p_name">Doctor's Name:</label>
    					<input type="text" name="name" id="p_name" placeholder="Type Doctor's Name Here" required>
    				</div>
   				  <div class="col-md-3 form_row">
    					<label for="p_age">Age:</label>
    					<input type="number" name="age" id="p_age" placeholder="Enter Doctor's Age!" required>
    				</div>
   				  <div class="col-md-3 form_row">
					 <select name="sex" id="" required>
						<option value="">Sex</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
						<option value="Other">Other</option>
					 </select>
   				  </div>
   				  <div class="col-md-12 form_row">
   				  	<label for="">Degree:</label>
   				  	<input type="text" name="degree" placeholder="Type Degree Here As like > MBBS, FCPS. Use Comma If Degree is more than One!" required>
   				  </div>
    				<div class="col-md-5 text-right">
    					<label class="check_box" for=cb title="Click Here ti view the RESET Button!">Reset</label>
						<input type='checkbox' style='display: none' id=cb>
						<div style="float: right; margin-right: 50px;">
							<input type="reset" name="" id="reset" value="RESET" title="Click Here If All The Entry is Wrong!">
						</div>
    				</div>
    				<div class="col-md-7 text-left">
    					<input type="submit" name="go" id="go" value="ADD TO DATABASE">
    				</div>
    			</form>
    			<div class="col-md-12" style="font-size: 20px; color: green; text-decoration: underline;">
    				<p>
    					<?php 
							if(!empty($_POST)){
							 $d_name=$_POST['name'];
							 $d_age=$_POST['age'];
							 $d_sex=$_POST['sex'];
							 $degree=$_POST['degree'];

							$insert="INSERT INTO doctor(doctor_id,d_name,age,sex,degree,status)VALUES('','$d_name','$d_age','$d_sex','$degree','1')";

							if(mysqli_query($CON,$insert)){
								echo "New Doctor Added to Database Successfully!";
								header('location: view_doctor.php');
							}else{
								  echo "Ops! Something Goes Wrong!!";
							}
						}
						?>
    				</p>
    			</div>
    		</div>
    	</div>
    </section>

		
		
	<?php }else{
		echo('<div class="col-md-12 text-center" style="color:red;"><h3>Access Denined!</h3></div><div class="col-md-12 text-center" style="color:red;"><h3>Contact Boss to add new doctor!</h3></div>');
	}
	get_footer(); 
	}else{
		header('location: login.php');
	} ?>