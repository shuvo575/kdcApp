<?php 
	session_start();
	if(isset($_SESSION['username'])){
	require('config.php');
	get_header();
	$sel= "SELECT * FROM doctor WHERE doctor_id AND status='0'";
	$res= $db-> query($sel);
?>


<section class="container-fluid text-center">
	<div class="col-md-12"  style="position: relative;">
	<h2 class="title text-center">--Trash <del>Doctors</del> List--</h2>
	<hr><div class="col-md-12">
			<a title="Back" class="back_button" href="view_doctor.php"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
		</div>
		<table id="datatable" class="container-fluid" cellspacing="0">
        <thead>
            <tr class="row">
                <th class="col-md-2 text-center b_1"><label for="">Doctor ID:</label></th>
                <th class="col-md-4 text-center b_1"><label for="">Doctor's Name</label></th>
                <th class="col-md-3 text-center b_1"><label for="">Doctor's Degree</label></th>
                <th class="col-md-3 text-center b_1"><label for="">Manage</label></th>
            </tr>
        </thead>
		<tfoot>
            <tr class="row">
                <th class="col-md-2 text-center bb_1 b_1"><label for="">Doctor ID:</label></th>
                <th class="col-md-4 text-center bb_1 b_1"><label for="">Doctor's Name</label></th>
                <th class="col-md-3 text-center bb_1 b_1"><label for="">Doctor's Degree</label></th>
                <th class="col-md-3 text-center bb_1 b_1"><label for="">Manage</label></th>
            </tr>
        </tfoot>
		<tbody>	
		<?php while($data=$res->fetchArray(SQLITE3_ASSOC)){ ?>
			<tr class="row hover">
                <td class="col-md-2 bb_1 b_1"><label for=""><?php echo $data['doctor_id']; ?></label></td>
                <td class="col-md-4 bb_1 textone b_1"><label for=""><?php echo $data['d_name']; ?></label></td>
                <td class="col-md-3 bb_1 textone b_1"><label for=""><?php echo $data['degree']; ?></label></td>
                <td class="col-md-3 bb_1 b_1"><label for=""><a class="manag" id="detail" href="doc_details.php?d=<?php echo $data['doctor_id']; ?>">Details</a><a class="manag<?php if($_SESSION['role']!=='boss'){echo(' btn hidden');} ?>" id="detail" href="undo_delete_doc.php?d=<?php echo $data['doctor_id']; ?>">Undo Delete</a></label></td>
            </tr>
		
		 <?php } ?>
		 </tbody>
		</table>
			</div>
</section>
<script>
	$(document).ready(function() {
		$('#datatable').DataTable( {
			"lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
		} );
	} );
</script>
	
	<?php get_footer(); }else{
		header('location: login.php');
	} ?>