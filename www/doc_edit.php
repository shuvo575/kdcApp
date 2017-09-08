<?php
	session_start();
	if(isset($_SESSION['username'])){
	ob_start();
	require_once("config.php");
	get_header();
	$doctor_id=$_GET['d']; 
	$sel= "SELECT * FROM doctor WHERE doctor_id='$doctor_id'";
	$res= $db->query($sel);
	$data=$res-> fetchArray(SQLITE3_ASSOC);

?>
    <section class="container-fluid" id="test_list" >
    	<div class="row">
    		<div class="col-md-12 text-center">
    			<h1 class="main_title">KATIADI DIAGNOSTIC CENTER</h1>
    			<hr>
    			<h2 class="title">Update Doctor's Data</h2>
    			<form method="post" id="p_form" class="text-left">
    				<div class="col-md-6 form_row">
    					<label for="p_name">Doctor's Name:</label>
    					<input type="text" name="name" id="p_name" value="<?php echo $data['d_name']; ?>">
    				</div>
   				  <div class="col-md-3 form_row">
    					<label for="p_age">Age:</label>
    					<input type="number" name="age" id="p_age" value="<?php echo $data['age']; ?>">
    				</div>
   				  <div class="col-md-3 form_row">
						<label for="">Sex: </label>
						<select name="sex" id="">
							<option value="Male" <?php if($data['sex']==='Male'){echo('selected'); } ?>>Male</option>
							<option value="Female" <?php if($data['sex']==='Female'){echo('selected'); } ?>>Female</option>
							<option value="Other" <?php if($data['sex']==='Other'){echo('selected'); } ?>>Other</option>
						</select>
   				  </div>
   				  <div class="col-md-12 form_row">
   				  	<label for="">Degree:</label>
   				  	<input type="text" name="degree" value="<?php echo $data['degree']; ?>">
   				  </div>
    				<div class="col-md-6 text-right" style="position: relative;">
    				<a class="cancel_button" style="top: 0px;" href="doc_details.php?d=<?php echo $doctor_id; ?>">Cancel</a>
    				</div>
    				<div class="col-md-6 text-left">
    					<input type="submit" name="go" id="go" value="UPDATE">
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

							$update= "UPDATE doctor SET d_name='$d_name', age='$d_age', sex='$d_sex', degree='$degree' WHERE doctor_id='$doctor_id'"; 
                        if($db-> query($update)){
                                echo "Update Your Information, Thanks!";
								header('location: doc_details.php?d='.$doctor_id);
                             }else{
                                 echo "Update not be Saved!";
                                }
                            }
						?>
    				</p>
    			</div>
    		</div>
    	</div>
    </section>

		
		
	<?php get_footer(); }else{
		header('location: login.php');
	} ?>