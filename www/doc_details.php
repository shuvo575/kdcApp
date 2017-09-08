<?php 
	session_start();
	ob_start();
	if(isset($_SESSION['username'])){
	require('config.php');
	get_header();
	$id=$_GET['d']; 
	$sel= "SELECT * FROM doctor WHERE doctor_id='$id'";
	$res= $db->query($sel);
	$data=$res-> fetchArray(SQLITE3_ASSOC);
?>
<section class="container-fluid">
	<div class="row" style="position: relative;">
	<h2 class="title text-center">Doctor's Details</h2>
	<hr><div class="col-md-12">
			<a class="edit_button<?php if($_SESSION['role']!=='boss'){echo(' btn hidden');} ?>" href="doc_edit.php?d=<?php echo $id; ?>">edit</a>
			<a class="back_button" href="javascript: history.go(-1)"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
		</div>
		<div class="col-md-12">
		<div class="col-md-1"></div>
			<div class="col-md-7">
			<label for=""> Doctor's Name: <?php echo $data['d_name']; ?></label>
			</div>
			<div class="col-md-3">
			<label for="">ID: <?php echo $data['doctor_id']; ?></label>
			</div>
		</div>
		<div class="col-md-12">
		<div class="col-md-1"></div>
			<div class="col-md-7">
			<label for="">Degree: <?php echo $data['degree']; ?></label>
			</div>
			<div class="col-md-2 text-capitalize">
			<label for="">Sex: <?php echo $data['sex']; ?></label>
			</div>
			<div class="col-md-2">
			<label for=""> Age: <?php echo $data['age']; ?></label>
			</div>
		</div>
		<div class="col-md-12" style="margin-top: 60px;">
			<form method="post">
				<div class="col-md-3">
				</div>
				<div class="col-md-3 form_row">
					<select name="month" id="">
						<?php
						  $month = strtotime(date('Y').'-'.date('m').'-'.date('j').' - 12 months');
						  $end = strtotime(date('Y').'-'.date('m').'-'.date('j').' + 0 months');
						  while($month < $end){
							  $selected = (date('F', $month)==date('F'))? ' selected' :'';
							  echo '<option'.$selected.' value="'.date('F', $month).'">'.date('F', $month).'</option>'."\n\t\t\t\t\t\t";
							  $month = strtotime("+1 month", $month);
						  }
						?>
					</select>
				</div>
				<div class="col-md-3 form_row">
					<select name="year" id="">
					<?php 
						$starting_year  =date('Y', strtotime('-5 year'));
						 $ending_year = date('Y', strtotime('+5 year'));
						 $current_year = date('Y');
						 for($starting_year; $starting_year <= $ending_year; $starting_year++) {
							 echo '<option value="'.$starting_year.'"';
							 if( $starting_year ==  $current_year ) {
									echo ' selected="selected"';
							 }
							 echo ' >'.$starting_year.'</option>';
						 }               
					?>
					</select>
				</div>
				<div class="col-md-3"></div>
				<div class="col-md-12 text-center" style="margin-top: 20px;"><input type="submit" id="go" value="View Bill"></div>
			</form>
		</div>
	</div>
</section>
	
	<?php get_footer(); 
	
	if(!empty($_POST)){
     	$month=$_POST['month']; 
		$year=$_POST['year'];
		$name= $data['d_name'];
		header('location: patient_list.php?d='.$id.'&n='.$name.'&m='.$month.'&y='.$year);
	
	}
	}else{
		header('location: login.php');
	} ?>