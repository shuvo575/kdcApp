<?php 
	session_start();
	if(isset($_SESSION['username'])){
	ob_start();
	require('config.php');
	get_header();
	$lab_id=$_GET['p']; 
	$sel= "SELECT * FROM patient WHERE lab_id='$lab_id'";
	$res= $db-> query($sel);
	$data= $res-> fetchArray(SQLITE3_ASSOC);
	$specimen1= $data['specimen1'];
	$specimen2= $data['specimen2'];
	$specimen3= $data['specimen3'];
	$test_ref= "SELECT * FROM testref WHERE test_code='$specimen1' OR test_code='$specimen2' OR test_code='$specimen3'" ;
	$test_qry= $db -> query($test_ref);
	$sel_doc= "SELECT * FROM doctor WHERE doctor_id AND status='1'";
	$res_qry_doc = $db-> query($sel_doc);
		
	if($specimen1==="xray"){
		$xray=$test_qry-> fetchArray(SQLITE3_ASSOC);
		$xray_id=$xray['test_id'];
		$xray_test_res_fetch = "SELECT * FROM report WHERE p_id='$lab_id' AND test_id='$xray_id' ";
		$xray_test_rse_qry = $db-> query($xray_test_res_fetch);
		$xray_test_res_arry = $xray_test_rse_qry -> fetchArray(SQLITE3_ASSOC); }
?>
<section class="container-fluid">
	<div class="row">
	<h2 class="title text-center">Update Patient's Details</h2>
	<hr>
	<form action="" method="post">
		<div class="col-md-6 b_1 form_row">
			<label for="">Patient ID:</label> <input type="number" name="edit_p_id" value="<?php echo $data['p_id']; ?>">
		</div>
		<div class="col-md-6 b_1 form_row">
			<label for="">LAB ID:</label> <input type="number" value="<?php echo $data['lab_id']; ?>" readonly>
		</div>
		<div class="col-md-7 b_1 form_row">
			<label for=""> Patient's Name:</label> <input type="text" name="edit_p_name" value="<?php echo $data['p_name']; ?>">
		</div>
		<div class="col-md-5 b_1 text-capitalize form_row">
			<label for="">Sex: </label>
			<select name="edit_sex" id="">
				<option value="Male" <?php if($data['sex']==='Male'){echo('selected'); } ?>>Male</option>
				<option value="Female" <?php if($data['sex']==='Female'){echo('selected'); } ?>>Female</option>
				<option value="Other" <?php if($data['sex']==='Other'){echo('selected'); } ?>>Other</option>
			</select>
		</div>
		<div class="col-md-8 b_1 form_row" >
			<label for="">Delivery Date & Time:</label>
			<input type="text" id="form-control" data-date-format="DD, dd MM yyyy, HH:ii P" name="edit_datetime" placeholder="Click to set Date & Time" value="<?php echo $data['p_datetime']; ?>" required>
		</div>
		<div class="col-md-4 b_1 form_row">
			<label for=""> Age: </label><input type="number" name="edit_p_age" value="<?php echo $data['p_age']; ?>"><label for=""> Years. </label>
		</div>
			<div class="col-md-12 b_1 bb_1">
				<div class="row">
				<div class="col-md-8">
				<label for="">Referred by Dr./ Prof.:</label>
				<select name="doctor" required>
		  				<?php
							$doctorsub = $data['doctor_id'];
							while($data_doc = $res_qry_doc-> fetchArray(SQLITE3_ASSOC)){ ?>
						<option value="<?php echo $data_doc['doctor_id']; ?>" <?php if($doctorsub===$data_doc['doctor_id']){ echo('selected'); } ?> ><?php echo $data_doc['d_name'].", ".$data_doc['degree']; ?></option>
	   					<?php } ?>
				</select>
				</div>
				<div class="col-md-4 form_row">
				<label for="p_age">BDT:</label>
				<input type="number" name="pat_amount" id="p_age" value="<?php echo $data['pat_amount']; ?>" required>
			  </div>
			  </div>
			</div>
			  
			<?php if($specimen1==="xray"){ ?>
			<div class="col-md-12 form_row b_1">
			<label for=""><?php echo $xray['test_name']; ?>:</label>
			<input type="hidden" name="test_id_editx" value="<?php echo $xray['test_id']; ?>">
			<input type="text" name="edit_reportx" value="<?php echo $xray_test_res_arry['report']; ?>">
			</div>
		<?php } ?> </div>
		<div class="col-md-12">
			<h3 class="text-center">
			<?php 
				if($specimen1==="crp" || $specimen1==="rarest" || $specimen1==="esr" || $specimen1==="group" || $specimen1==="mt" || $specimen1==="hbsag" || $specimen1==="vdrl" || $specimen1==="tpha"){
					echo('LABORATORY REPORT');
				}elseif($specimen1==="sbili" || $specimen1==="scre" || $specimen1==="rbs" || $specimen1==="cus" || $specimen1==="falipi" || $specimen1==="fbs" || $specimen1==="abf2" || $specimen1==="ogtt1" || $specimen1==="ogtt2" || $specimen1==="ogtt3"){
					echo('REPORT ON BIOCHEMICAL INVESTIGATION');
				}elseif($specimen1==="xray"){
					echo('<u><b>X-Ray Report</b></u>');
				}elseif($specimen1==="widal" || $specimen1==="mp" || $specimen1==="hbper"){
					echo('BLOOD EXAMINATION REPORT');
				}elseif($specimen1==="bt" || $specimen1==="ct" || $specimen1==="cbc"){
					echo('HEMATOLOGY REPORT');
				}elseif($specimen1==="urire" || $specimen1==="preg"){
					echo('URINE EXAMINATION REPORT');
				}else{
					echo('SEMEN ANALYSIS REPORT');
				}
			?>
			</h3>
			<hr>
		</div>
		<?php if($specimen1!=="mt"){ if($specimen1!=="xray"){ ?>
		<div class="col-md-12 text-center mb_15 b_1 bb_1">
			<div class="col-md-4">
				<label for="">Investigation</label>
			</div>
			<div class="col-md-5">
				<label for="">Result- Unit</label>
			</div>
			<div class="col-md-3">
				<label for="">Reference</label>
			</div>
		</div>
		<?php }} while($test_arry= $test_qry->fetchArray(SQLITE3_ASSOC)){  ?>
		<div class="col-md-12 b_1 text-center">
			<div class="col-md-4">
				<label class="report_print<?php if($specimen1=="mt"){ echo ' text-right';} ?>"><?php echo $test_arry['test_name']; ?></label>
			</div>
			<div class="col-md-5 form_row">
				<?php  if($specimen1!=="xray"){
						$test_id=$test_arry['test_id'];
						$test_res_fetch = "SELECT * FROM report WHERE p_id='$lab_id' AND test_id='$test_id' ";
						$test_rse_qry = $db -> query($test_res_fetch);
						$test_res_arry = $test_rse_qry-> fetchArray(SQLITE3_ASSOC);
						
				?>
				<input type="hidden" name="test_id_edit[]" value="<?php echo $test_arry['test_id']; ?>">
				
				<input class="text-center<?php if($specimen1=="mt"){ echo ' text-left';} ?>" type="text" name="edit_report[]" value="<?php echo $test_res_arry['report']; ?>">
			</div>
			<div class="col-md-3">
				<label class="report_print ref_test"><?php echo $test_arry['test_ref']; ?></label>
			</div>
		</div>
		<?php } } ?>
			<div class="col-md-6 text-right bt_1" style="position: relative; padding-top: 50px;">
				<a class="cancel_button" href="pat_details.php?p=<?php echo $lab_id; ?>">Cancel</a>
			</div>
			<div class="col-md-6 text-left bt_1" style="padding-top: 50px;">
				<input type="submit" name="go" id="go" value="-- Save --">
			</div>
		</form>
</section>
<?php if($specimen1==='ogtt1' || $specimen1==='ogtt2' || $specimen1 ==='ogtt3'){ ?>
<section style="margin-top: 250px;" class="container text-center">
	<h3>Oral glucose tolerance test level (OGTT)</h3>
	<div class="col-md-12">
		<div class="col-md-5 b_1"><label style="line-height: 60px;" for="">Inference</label></div>
		<div class="col-md-3 b_1"><label for="">0 min glucose level (venous plasma)</label></div>
		<div class="col-md-4 b_1"><label for="">Random Glucose Level (venous plasma)</label></div>
	</div>
	<div class="col-md-12">
		<div class="col-md-5 b_1"><p>Diabetes mellitus (DM)</p></div>
		<div class="col-md-3 b_1"><p><u>></u> 7.0 mmol/L</p></div>
		<div class="col-md-4 b_1"><p><u>></u> 11.1 mmol/L</p></div>
	</div>
	<div class="col-md-12">
		<div class="col-md-5 b_1"><p>Impaired glucose tolerance</p></div>
		<div class="col-md-3 b_1"><p> < 6.1 mmol/L</p></div>
		<div class="col-md-4 b_1"><p> <u>></u> 7.8 < 11.1 mmol/L</p></div>
	</div>
	<div class="col-md-12">
		<div class="col-md-5 b_1"><p>Normal</p></div>
		<div class="col-md-3 b_1"><p>< 6.1 mmol/L</p></div>
		<div class="col-md-4 b_1"><p>< 7.8 11.1 mmol/L</p></div>
	</div>
	<div class="col-md-12 text-right"><label for="">(Ref WHO & BIRDEM)</label></div>
</section>
<?php } if($specimen1!=="xray"){ ?>
<section id="sign">
	<div class="container-fluid">
		<div class="row">
		<div class="col-md-8"></div>
			<div class="col-md-4">
				<b><u><i>MD. NURUZZAMAN</i></u></b><br>
				<p>Medical Technologist (LAB)<br>I.I.H.S (Dhaka) <br> Katiadi Diagnostic Center (KDC)</p>
			</div>
		</div>
	</div>
</section>
<?php }
		
	if(!empty($_POST)){
		$edit_p_id = $_POST['edit_p_id'];
		$edit_p_name = $_POST['edit_p_name'];
		$edit_sex = $_POST['edit_sex'];
		$edit_doctor = $_POST['doctor'];
		$edit_pat_amount = $_POST['pat_amount'];
		if($specimen1==='xray'){ $doc_amount=50; }else{ $doc_amount=$edit_pat_amount/2; }
		$edit_datetime = $_POST['edit_datetime'];
		$edit_p_age = $_POST['edit_p_age'];
		$update= "UPDATE patient SET p_id='$edit_p_id', p_datetime='$edit_datetime', p_name='$edit_p_name', p_age='$edit_p_age', doctor_id='$edit_doctor', pat_amount='$edit_pat_amount', doc_amount='$doc_amount', sex='$edit_sex' WHERE lab_id='$lab_id'";

		if($specimen1==="xray"){ 
				if($xray_test_res_arry){
				$report_ed= $_POST['edit_reportx'];
				$test_id_ed= $_POST['test_id_editx'];
				$update_r= "UPDATE report SET report='$report_ed' WHERE p_id='$lab_id' AND test_id='$test_id_ed'";
				if($db->query($update_r)){
					echo "record Updated successfully!";

				}else{
					echo "New record creation failed!";
				}
					}else{
					$report_in= $_POST['edit_reportx'];
					$test_id_in= $_POST['test_id_editx'];
					$insertt="INSERT INTO report(p_id,test_id,report)VALUES('$lab_id','$test_id_in','$report_in')";	
						if($db->exec($insertt)){
							echo "New record created test successfully!";
							
						}else{
							echo "New record creation failed!";
						}
					}

		
		}else{
		 $edit_test_id_ary= $_POST['test_id_edit'];
		 $edit_report_ary= $_POST['edit_report'];
			foreach($edit_test_id_ary as $indx => $test_id_ed){
				$report_ed = $edit_report_ary[$indx];
				if($test_res_arry){
				$update_r= "UPDATE report SET report='$report_ed' WHERE p_id='$lab_id' AND test_id='$test_id_ed'";
				if($db->query($update_r)){
					echo "New record created other successfully!";

				}else{
					echo "New record creation failed!";
				}
					}else{
					$insert="INSERT INTO report(p_id,test_id,report)VALUES('$lab_id','$test_id_ed','$report_ed')";	
						if($db->exec($insert)){
							echo "New record created successfully!";
							
						}else{
							echo "New record creation failed!";
						}
					}

			} }
		if($db-> query($update)){
				echo "Update Your Information, Thanks!";
				header('location: pat_details.php?p='.$lab_id);
			 }else{
				 echo "Update not be Saved!";
				}
			}

get_footer(); }else{
		header('location: login.php');
	} ?>