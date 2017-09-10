<?php
	session_start();
	if(isset($_SESSION['username'])){
	ob_start();
	require_once("config.php");
	get_header();
	$select_last_row = 'SELECT lab_id FROM patient ORDER BY lab_id DESC LIMIT 0 ,1';
	$last_id = $db-> query($select_last_row);
	
	$row = $last_id-> fetchArray(SQLITE3_ASSOC);
	$last_entry = $row['lab_id'];
	$selss= "SELECT * FROM patient WHERE lab_id=$last_entry";
	$ressub= $db-> query($selss);
	$datasub=$ressub-> fetchArray(SQLITE3_ASSOC);
	$specimen1=$datasub['specimen1'];
	$specimen2=$datasub['specimen2'];
	$specimen3=$datasub['specimen3'];
	$lab_id=$datasub['lab_id'];
	$test_ref= "SELECT * FROM testref WHERE test_code='$specimen1' OR test_code='$specimen2' OR test_code='$specimen3'" ;
	$test_qry= $db-> query($test_ref);
		
?>
<section class="container-fluid text-left">
	<div class="row">
	<h2 class="title text-center">Test Details</h2>
	<hr>
		<div class="col-md-12">
			<div class="col-md-3">
			<label for="">Patient ID:</label>
			<label for=""><?php echo $datasub['p_id']; ?></label>
			</div>
			<div class="col-md-9 text-left">
			<label for="">Delivery Date & Time:</label>
			<label for=""><?php echo $datasub['p_datetime']; ?></label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-8">
			<label for="">Patient's Name:</label>
			<label for=""><?php echo $datasub['p_name']; ?></label>
			</div>
			<div class="col-md-2">
			<label for="">Age:</label>
			<label for=""><?php echo $datasub['p_age']; ?></label>
			</div>
			<div class="col-md-2">
			<label for="">Sex:</label>
			<label for=""><?php echo $datasub['sex']; ?></label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-12">
			<label for="">Referred by Dr. / Prof. :</label>
			<label for=""><?php 
				$doctorsub = $datasub['doctor_id'];
				$seldoc= "SELECT * FROM doctor WHERE doctor_id=$doctorsub";
				$resdoc= $db-> query($seldoc);
				$data= $resdoc-> fetchArray(SQLITE3_ASSOC);
				echo $data['d_name'].", ".$data['degree'];
				?></label>
			</div>
		</div>
	</div>
</section>
<hr>
	<section class="container-fluid text-center">
		<div class="row">
			<div class="col-md-12">
				<h3 style="color: red;">To <b>Bold</b> Any Result Add <span style="background-color: yellow;">&lt;b&gt;</span> Before The Result And Add <span style="background-color: yellow;">&lt;/b&gt;</span> After The Result!</h3>
				<h4>As like <span style="background-color: yellow;">&lt;b&gt;2.5mg/DL&lt;/b&gt;</span> will be <span style="background-color: yellow;"><b>2.5mg/DL</b></span> in Print!</h4>
			</div>
		</div>
	</section>
<hr>

<section class="container-fluid text-center" id="test_list" >
    	<div class="row">
    	<form action="" method="post">
    		<div class="col-md-12 mb_15">
    			<div class="col-md-3">
    				<label for="">Test ID:</label>
    			</div>
				<div class="col-md-3">
					<label for="">Name of Test</label>
				</div>
				<div class="col-md-3">
					<label for="">Result - Unit</label>
				</div>
				<div class="col-md-3">
					<label for="">Reference Range</label>
				</div>
    		</div>
    		<?php while($test_arry= $test_qry->fetchArray(SQLITE3_ASSOC)){  ?>
    		<div class="col-md-12 mb_15">
    			<div class="col-md-3 text-center form_row">
					<input class="text-center" name="test_id[]" type="text" value="<?php echo $test_arry['test_id']; ?>">
				</div>
				<div class="col-md-3 text-center form_row">
					<input class="text-center" type="text" value="<?php echo $test_arry['test_name']; ?>" disabled>
				</div>
				<div class="col-md-3 text-center form_row">
					<input class="text-center" type="text" name="report[]" value=" <?php echo $test_arry['test_unit']; ?>">
				</div>
				<div class="col-md-3 text-center form_row">
					<textarea name="" id="txtarea" cols="30" rows="1" disabled><?php echo $test_arry['test_ref']; ?></textarea>
				</div>
    		</div>
    		<?php } ?>
    		<div class="col-md-5 text-right">
				<input type="reset" name="" id="reset" value="RESET">
			</div>
			<div class="col-md-7 text-left">
				<input type="submit" name="go" id="go" value="ADD TO DATABASE">
			</div>
    	</div>
    	</form>
    	<div class="col-md-12"></div>
    	<div class="col-md-12">
    	
    	<?php
				if(!empty($_POST)){
				 $p_id= $datasub['lab_id'];
				 $test_id_ary= $_POST['test_id'];
				 $report_ary= $_POST['report'];
					foreach($test_id_ary as $indx => $test_id){
						$report = $report_ary[$indx];
						$insert="INSERT INTO report(p_id,test_id,report)VALUES('$p_id','$test_id','$report')";	
						if($db->exec($insert)){
							echo "New record created successfully!";
							
						}else{
							echo "New record creation failed!";
						}
						
					} header('location: last_patient.php');	
				}
				
				
							
			?>
    	
    	</div>
    </section>
   
		
	<?php get_footer(); }else{
		header('location: login.php');
	}  ?>