<?php
	session_start();
	if(isset($_SESSION['username'])){
	require('config.php');
	get_header();
	$id=$_GET['d'];
	$name=$_GET['n'];
	$month=$_GET['m']; 
	$year=$_GET['y']; 
	$sel= "SELECT * FROM patient WHERE p_datetime LIKE('%$month $year%') AND doctor_id='$id' AND status='1' ORDER BY lab_id DESC";
	$res= $db -> query($sel);
?>


<section class="container-fluid text-center">
	<div class="col-md-12" style="position: relative;">
	<h4 class="title text-center">Patients List of <?php echo $month.' '.$year; ?> of </h4>
	<h4 class="title text-center">Dr. / Prof.: <?php echo $name; ?></h4>
	<hr><div class="col-md-12">
			<a class="back_button" href="javascript: history.go(-1)"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
		</div>
		<table id="datatable" class="container-fluid" cellspacing="0">
        <thead>
            <tr class="row">
                <th class="col-md-1 text-center textone b_1"><div><label for="">Lab ID</label></div></th>
                <th class="col-md-4 text-center textone b_1"><div><label for="">Patient's Name</label></div></th>
                <th class="col-md-2 text-center textone b_1"><div><label for="">Amount Taken</label></div></th>
                <th class="col-md-2 text-center textone b_1"><div><label for="">Doctor %</label></div></th>
                <th class="col-md-3 text-center textone b_1"><div class="in_print_off"><label for="">Manage</label></div></th>
            </tr>
        </thead>
		<tfoot>
            <tr class="row">
                <th class="col-md-1 text-center bb_1 textone b_1"><label for="">Lab ID</label></th>
                <th class="col-md-4 text-center bb_1 textone b_1"><label for="">Patient's Name</label></th>
                <th class="col-md-2 text-center bb_1 textone b_1"><label for="">Amount Taken</label></th>
                <th class="col-md-2 text-center bb_1 textone b_1"><label for="">Doctor %</label></th>
                <th class="col-md-3 text-center bb_1 textone b_1"><div class=" in_print_off"><label for="">Manage</label></div></th>
            </tr>
        </tfoot>
		<tbody>	
		<?php while($data=$res->fetchArray(SQLITE3_ASSOC)){ ?>
		
		
            <tr class="row hover">
                <td class="col-md-1 textone bb_1 b_1 pm_0"><label for=""><?php echo $data['lab_id']; ?></label></td>
                <td class="col-md-4 bb_1 textone b_1 pm_0"><label for=""><?php echo $data['p_name']; ?></label></td>
                <td class="col-md-2 bb_1 textone b_1 pm_0"><label for=""><?php echo $data['pat_amount']; ?>/&#61;</label></td>
                <td class="col-md-2 bb_1 textone b_1 pm_0"><label for=""><?php echo $data['doc_amount']; ?>/&#61;</label></td>
                <td class="col-md-3 bb_1 b_1 textone pm_0"><div class=" in_print_off"><label for="">
                	<a class="manag" id="detail" href="pat_details.php?p=<?php echo $data['lab_id']; ?>"> Details</a>
                	<a class="manag" id="edit" href="pat_edit.php?p=<?php echo $data['lab_id']; ?>">Edit</a>
                	<a class="manag<?php if($_SESSION['role']!=='boss'){echo(' btn hidden');} ?>" id="delete" href="delete_patient.php?p=<?php echo $data['lab_id']; ?>">Delete</a>
                </label></div></td>
            </tr>
		
		 <?php } ?>
		 </tbody>
		</table>
		<div class="col-md-12">
			<div class="col-md-6 text-right"><label for="">Total Amount of Doctor:</label></div>
			<div class="col-md-6 text-left"><label for="">
				<?php
					$mony_sel = "SELECT sum(doc_amount) as TOTAL from patient WHERE doctor_id='$id' AND status='1' AND p_datetime LIKE('%$month $year%')";
					$mony_qry= 	$db -> query($mony_sel);
					$mony_fetch= $mony_qry -> fetchArray(SQLITE3_ASSOC);
					if($mony_fetch['TOTAL']>0){
						echo($mony_fetch['TOTAL']);
					}else{
						echo '0.00';
					}
					
				?>
			/= BDT</label></div>
		</div>
</div>
<div class="col-md-12 text-center mt_50">
	<button class="print_button" onClick="window.print()">Print this page</button>
</div>
</section>
<script>
	$(document).ready(function() {
		$('#datatable').DataTable( {
			"lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
			"order": [[ 0, "desc" ]],
			"bSort": true
		} );
	} );
</script>


	
	<?php get_footer(); 
		}else{
		header('location: login.php');
			} ?>