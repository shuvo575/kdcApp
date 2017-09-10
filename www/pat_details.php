<?php 
	session_start();
	if(isset($_SESSION['username'])){
	require('config.php');
	get_header();
	$id=$_GET['p']; 
	$sel= "SELECT * FROM patient WHERE lab_id='$id'";
	$res= $db-> query($sel);
	$data=$res-> fetchArray(SQLITE3_ASSOC);
	$specimen1= $data['specimen1'];
	$specimen2= $data['specimen2'];
	$specimen3= $data['specimen3'];
	$test_ref= "SELECT * FROM testref WHERE test_code='$specimen1' OR test_code='$specimen2' OR test_code='$specimen3'" ;
	$test_qry= $db-> query($test_ref);
	$test_code_sel= "SELECT * FROM tast_code WHERE t_code='$specimen1' OR t_code='$specimen2' OR t_code='$specimen3'" ;
	$test_code_qry= $db-> query($test_code_sel);
	
	if($specimen1==="xray"){
		$xray=$test_qry->fetchArray(SQLITE3_ASSOC);
		$xray_id=$xray['test_id'];
		$xray_test_res_fetch = "SELECT * FROM report WHERE p_id='$id' AND test_id='$xray_id' ";
		$xray_test_rse_qry =$db-> query($xray_test_res_fetch);
		$xray_test_res_arry = $xray_test_rse_qry-> fetchArray(SQLITE3_ASSOC); }
?>
<section class="container-fluid">
	<div class="row" style="position: relative;">
	<h2 class="title text-center">Patient's Details</h2>
	<hr>
		<div class="col-md-12">
			<a title="Edit" class="edit_button" href="pat_edit.php?p=<?php echo $id; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></a>
			<a title="Back" class="back_button" href="javascript: history.go(-1)"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
		</div>
		<div class="col-md-7 b_1">
			<p class="report_print">Patient ID: <?php echo $data['p_id']; ?></p>
		</div>
		<div class="col-md-5 b_1">
			<p class="report_print">LAB ID: <?php echo $data['lab_id']; ?></p>
		</div>
		<div class="col-md-8 b_1">
			<p class="report_print"> Patient's Name: <b><?php echo $data['p_name']; ?></b></p>
		</div>
		<div class="col-md-2 textone b_1">
			<p class="report_print"> Age: <?php echo $data['p_age'].'Years'; ?></p>
		</div>
		<div class="col-md-2 b_1 textone text-capitalize">
			<p class="report_print">Sex: <?php echo $data['sex']; ?></p>
		</div>
		<div class="col-md-12 b_1">
			<p class="report_print">Delivery Date & Time: <?php echo $data['p_datetime']; ?></p>
		</div>
		<div class="col-md-12 b_1">
		<p class="report_print">Referred by Dr./ Prof.: <?php 
			$doctorsub = $data['doctor_id'];
			$seldoc= "SELECT * FROM doctor WHERE doctor_id=$doctorsub";
			$resdoc= $db-> query($seldoc);
			$data=$resdoc-> fetchArray(SQLITE3_ASSOC);
			echo $data['d_name']."	".$data['degree'];
			?></p>
		</div>
		<?php if($specimen1==="xray"){ ?>
		<div class="col-md-12 b_1 bb_1">
		<p class="report_print"><?php echo $xray['test_name'].': '.$xray_test_res_arry['report']; ?></p>
		</div>
		<?php }else{ ?>
				<div class="col-md-12 bb_1 b_1">
					<p class="report_print"> Name of Examination: <?php
					$i=0;
					while($test_name= $test_code_qry -> fetchArray(SQLITE3_ASSOC)){
						if($i==1){
							echo ', ';
						}elseif($i==2){
							echo ' & ';
						}
						echo $test_name['t_name'];
						$i++;
					}
				
						  ?>
					</p>
				</div>
				 <?php } ?>
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
		<div class="col-md-12 b_1 bb_1 text-center mb_15">
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
		
			<?php if($test_arry['test_id']===12){
				echo('<div class="col-md-12 bt_1 report_print"><p><b>Total Count:</b></p></div>');
			}elseif($test_arry['test_id']===15){
				echo('<div class="col-md-12 bt_1 report_print"><p><b>Differential Leucocyte Count:</b></p></div>');
			}elseif($test_arry['test_id']===43 || $test_arry['test_id']===63){
				echo('<div class="col-md-12 bt_1 report_print"><p><b>Physical Examination:</b></p></div>');
			}elseif($test_arry['test_id']===49){
				echo('<div class="col-md-12 bt_1 report_print"><p><b>Chemical Examination:</b></p></div>');
			}elseif($test_arry['test_id']===54 || $test_arry['test_id']===67){
				echo('<div class="col-md-12 bt_1 report_print"><p><b>Microscopic Examination:</b></p></div>');
			}
				?>
		
		<div class="col-md-12 b_1 text-center">
			<div class="col-md-4">
				<p class="report_print<?php if($specimen1=="mt"){ echo ' text-right';} ?>"><?php echo $test_arry['test_name']; ?></p>
			</div>
			<div class="<?php if($test_arry['test_id']==='68'){ echo 'col-md-7 text-justify'; }else{ echo 'col-md-5'; } ?>">
				<p class="report_print<?php if($specimen1=="mt"){ echo ' text-left';} ?>">
				<?php 
						$test_id=$test_arry['test_id'];
						$test_res_fetch = "SELECT * FROM report WHERE p_id='$id' AND test_id='$test_id' ";
						$test_rse_qry = $db -> query($test_res_fetch);
						$test_res_arry = $test_rse_qry-> fetchArray(SQLITE3_ASSOC);
						if($specimen1!=="xray"){
				   echo $test_res_arry['report']; 
				?>
				</p>
			</div>
			<div class="<?php if($test_arry['test_id']==='68'){ echo 'col-md-1'; }else{ echo 'col-md-3'; } ?>">
				<p class="report_print ref_test"><?php echo $test_arry['test_ref']; ?></p>
			</div>
		</div>
		<?php } } ?>
	</div>
</section>
<?php if($specimen1==='ogtt1' || $specimen1==='ogtt2' || $specimen1 ==='ogtt3'){ ?>
<section style="margin-top: 25px;" class="container text-center">
	<h3>Oral glucose tolerance test level (OGTT)</h3>
	<div class="col-md-12 b_1">
		<div class="col-md-3"><label for="">Inference</label></div>
		<div class="col-md-4"><label for="">0 min glucose level (venous plasma)</label></div>
		<div class="col-md-5"><label for="">Random Glucose Level (venous plasma)</label></div>
	</div>
	<div class="col-md-12 b_1">
		<div class="col-md-3"><p>Diabetes mellitus (DM)</p></div>
		<div class="col-md-4"><p><u>></u> 7.0 mmol/L</p></div>
		<div class="col-md-5"><p><u>></u> 11.1 mmol/L</p></div>
	</div>
	<div class="col-md-12 b_1">
		<div class="col-md-3"><p>Impaired glucose tolerance</p></div>
		<div class="col-md-4"><p> < 6.1 mmol/L</p></div>
		<div class="col-md-5"><p> <u>></u> 7.8 < 11.1 mmol/L</p></div>
	</div>
	<div class="col-md-12 b_1 bb_1">
		<div class="col-md-3"><p>Normal</p></div>
		<div class="col-md-4"><p>< 6.1 mmol/L</p></div>
		<div class="col-md-5"><p>< 7.8 mmol/L</p></div>
	</div>
	<div class="col-md-12 text-right"><label for="">(Ref WHO & BIRDEM)</label></div>
</section>
<?php } if($specimen1!=="xray"){ ?>
<div class="text-left" id="sign">
	<b><u><i>MD. NURUZZAMAN</i></u></b><br>
	<p>Medical Technologist (LAB)<br>I.I.H.S (Dhaka) <br> Katiadi Diagnostic Center (KDC)</p>
</div>
<?php } ?>
<div class="col-md-12 text-center mt_50">
	<button class="print_button" onClick="window.print()">Print this page</button>
</div>
<?php get_footer(); }else{
		header('location: login.php');
	} ?>