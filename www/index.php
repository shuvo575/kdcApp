<?php
	session_start();
	if(isset($_SESSION['username'])){
	ob_start();
	require_once("config.php");
	get_header();
	$sel= "SELECT * FROM doctor WHERE doctor_id AND status='1'";
	$res_qry = $db-> query($sel);
	
?>
    <section class="container-fluid" id="test_list" >
    	<div class="row">
    		<div class="col-md-12 text-center">
    			<h1 class="main_title">KATIADI &middot; DIAGNOSTIC &middot; CENTER</h1>
    			<hr>
    			<h2 class="title">--Patient Details--</h2>
    			<form action="" method="post" id="p_form" class="text-left">
    			<div class="col-md-6 form_row">
   				  <label for="p_id">Patient ID:</label>
   				  <input id="p_id" type="number" name="p_id" placeholder="Enter The Slip Number Here" title="Enter The Patient ID Here!" required>
    			</div>
   				  	<div class="col-md-6 form_row" >
   				  		<label for="">Delivery Date & Time:</label>
						<input type="text" id="form-control" data-date-format="DD, dd MM yyyy, HH:ii P" name="datetime" placeholder="Click to set Date & Time" required>
					</div>
   				  
					<div class="col-md-6 form_row">
    					<label for="p_name">Patient's Name:</label>
    					<input type="text" name="p_name" id="p_name" placeholder="Type Patient's Name Here" required>
    				</div>
   				  <div class="col-md-3 form_row">
    					<label for="p_age">Age:</label>
    					<input type="number" name="p_age" id="p_age" placeholder="Patient's Age" required>
    				</div>
   				  <div class="col-md-3 form_row">
					 	<select name="sex" id="" required>
					 		<option value="">Sex</option>
					 		<option value="Male">Male</option>
					 		<option value="Female">Female</option>
					 		<option value="Other">Other</option>
					 	</select>
   				  </div>
   				  <div class="col-md-8 form_row">
   				  	<label for="doctor_name">Referred by Dr. / Prof.:</label>
					<select name="doctor" required>
					  <option value="">Please! Choose A Doctor!</option>
		  <?php while($data = $res_qry-> fetchArray(SQLITE3_ASSOC)){ ?>
			<option value="<?php echo $data['doctor_id']; ?>"><?php echo $data['d_name'].", ".$data['degree']; ?></option>
	   	<?php } ?>
					</select>
   				  </div>
   				  <div class="col-md-4 form_row">
   				  	<label for="p_age">BDT:</label>
   				  	<input type="number" name="pat_amount" id="p_age" placeholder="Amount Taken" required>
   				  </div>
   				  <div class="col-md-4 form_row">
						<label>Test: </label>
							<select name="specimen1" id="specimen1" required>
								<option value="">Please! Choose A Exam!</option>
									<optgroup label="BLOOD">
										<option value="crp">CRP</option>
										<option value="rarest">RA Rest</option>
										<option value="sbili">S. BILIRUBIN</option>
										<option value="bt">BT</option>
										<option value="ct">CT</option>
										<option value="cbc">CBC</option>
										<option value="scre">S. CREATININE</option>
										<option value="esr">ESR</option>
										<option value="falipi">FASTING LIPID PROFILE</option>
										<option value="fbs">FBS</option>
										<option value="abf2">2hrs. ABF</option>
										<option value="group">BLOOD FOR GROUP</option>
										<option value="hbper">HB%</option>
										<option value="hbsag">HBsAG (CONFIRMATORY)</option>
										<option value="vdrl">VDRL</option>
										<option value="tpha">TPHA</option>
										<option value="ogtt1">OGTT, 1 Sample</option>
										<option value="ogtt2">OGTT, 2 Sample</option>
										<option value="ogtt3">OGTT, 3 Sample</option>
										<option value="rbs">RBS</option>
										<option value="cus">CUS</option>
										<option value="mp">MP</option>
										<option value="widal">WIDAL TEST</option>
									</optgroup>
									<optgroup label="URINE">
										<option value="urire">URINE For R/E</option>
										<option value="preg">Pregnancy Test</option>
									</optgroup>
								<option value="xray">X-Ray</option>
								<option value="semen">SEMEN</option>
								<option value="mt">MT. (Tuberculin Test)</option>
							</select>
					
   				  </div>
   				  <div class="col-md-4 text-center form_row">
						<label>Test: </label>
						  <select name="specimen2" id="specimen2">
								<option value="">&bull;&bull;&bull;&bull;</option>
									<optgroup label="BLOOD">
										<option value="rarest">RA Rest</option>
										<option value="bt">BT</option>
										<option value="ct">CT</option>
										<option value="abf2">2hrs. ABF</option>
										<option value="hbper">HB%</option>
										<option value="vdrl">VDRL</option>
										<option value="tpha">TPHA</option>
										<option value="ogtt1">OGTT, 1 Sample</option>
										<option value="ogtt2">OGTT, 2 Sample</option>
										<option value="ogtt3">OGTT, 3 Sample</option>
										<option value="cus">CUS</option>
									</optgroup>
						  </select>
   				  </div>
   				  <div class="col-md-4 text-right form_row">
						<label>Test: </label>
							<select name="specimen3" id="specimen3">
								<option value="">&bull;&bull;&bull;&bull;</option>
									<optgroup label="BLOOD">
										<option value="esr">ESR</option>
										<option value="tpha">TPHA</option>
										<option value="ogtt1">OGTT, 1 Sample</option>
										<option value="ogtt2">OGTT, 2 Sample</option>
										<option value="ogtt3">OGTT, 3 Sample</option>
									</optgroup>
						  </select>
					
   				  </div>
    				<div class="col-md-7 text-right">
    					<label title="View Reset Button" class="check_box" for=cb>Reset</label>
						<input type='checkbox' style='display: none' id=cb>
						<div style="float: right; margin-right: 50px;">
							<input type="reset" name="" id="reset" value="RESET" title="Click Here If All The Entry is Wrong!">
						</div>
    				</div>
    				<div class="col-md-5 text-left">
    					<input type="submit" name="go" id="go" value="ADD LAB REPORT" title="Click Here To Add Lab Report.">
    				</div>
    			</form>
    		</div>
    	</div>
    </section>

		
	<?php 
	if(!empty($_POST)){
     $p_id=$_POST['p_id'];
     $datetime=$_POST['datetime'];
     $p_name=$_POST['p_name'];
     $p_age=$_POST['p_age'];
     $p_sex=$_POST['sex'];
     $doctor=$_POST['doctor'];
     $pat_amount=$_POST['pat_amount'];
     $specimen1=$_POST['specimen1'];
     $specimen2=$_POST['specimen2'];
     $specimen3=$_POST['specimen3'];
	if($specimen1==='xray'){ $doc_amount=100; }else{ $doc_amount=$pat_amount/2; }
		$insert="INSERT INTO patient (p_id,p_datetime,p_name,p_age,sex,doctor_id,specimen1,specimen2,specimen3,status,pat_amount,doc_amount) VALUES ('$p_id','$datetime','$p_name','$p_age','$p_sex','$doctor','$specimen1','$specimen2','$specimen3','1','$pat_amount','$doc_amount')";
    
    			if($db->exec($insert)){
					echo "New record created successfully!";
					header('location: submit.php');
				}else{
         			echo "New record creation failed!";
				} 
	}
	get_footer(); 
		}else{
				header('location: login.php');
			}
		?>