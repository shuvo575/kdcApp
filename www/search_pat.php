<?php
	session_start();
	if(isset($_SESSION['username'])){
	require('config.php');
	get_header();
	$search=$_GET['search']; 
	$sel= "SELECT * FROM patient WHERE p_datetime LIKE('%$search%') OR lab_id LIKE('%$search%') OR p_id LIKE('%$search%') OR p_name LIKE('%$search%') ORDER BY lab_id DESC";
	$res= $db -> query($sel);
	
	
?>


<section class="container-fluid text-center">
	<div class="col-md-12" style="position: relative;">
	<h2 class="title text-center">~~Searched Patients List for &#91;<?php echo $search; ?>&#93;~~</h2>
	<hr><div class="col-md-12">
			
			<a title="Back" class="back_button" href="javascript: history.go(-1)"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
		</div>
		<table id="datatable" class="container-fluid" cellspacing="0">
        <thead>
            <tr class="row">
                <th class="col-md-1 text-center textone b_1"><div><label for="">Lab ID</label></div></th>
                <th class="col-md-1 text-center textone b_1"><div><label for="">Patient ID</label></div></th>
                <th class="col-md-4 text-center b_1"><div><label for="">Patient's Name</label></div></th>
                <th class="col-md-3 text-center b_1"><div><label for="">Referred by</label></div></th>
                <th class="col-md-1 text-center b_1 textone"><div><label for="">BDT</label></div></th>
                <th class="col-md-2 text-center b_1 textone"><div><label for="">Manage</label></div></th>
            </tr>
        </thead>
		<tfoot>
            <tr class="row">
                <th class="col-md-1 text-center bb_1 textone b_1"><label for="">Lab ID</label></th>
                <th class="col-md-1 text-center bb_1 textone b_1"><label for="">Patient ID</label></th>
                <th class="col-md-4 text-center bb_1 b_1"><label for="">Patient's Name</label></th>
                <th class="col-md-3 text-center bb_1 b_1"><label for="">Referred by</label></th>
                <th class="col-md-1 text-center bb_1 b_1 textone"><label for="">BDT</label></th>
                <th class="col-md-2 text-center bb_1 b_1 textone"><label for="">Manage</label></th>
            </tr>
        </tfoot>
		<tbody>	
		<?php while($data=$res->fetchArray(SQLITE3_ASSOC)){ ?>
		
		
            <tr class="row hover">
                <td class="col-md-1 textone bb_1 b_1"><label for=""><?php echo $data['lab_id']; ?></label></td>
                <td class="col-md-1 bb_1 b_1"><label for=""><?php echo $data['p_id']; ?></label></td>
                <td class="col-md-4 bb_1 textone b_1"><label for=""><?php echo $data['p_name']; ?></label><small><?php
					$idp = $data['lab_id'];
					$selp= "SELECT * FROM patient WHERE lab_id='$idp'";
					$resp= $db-> query($selp);
					$datap= $resp-> fetchArray(SQLITE3_ASSOC);
					$specimen1= $datap['specimen1'];
					$specimen2= $datap['specimen2'];
					$specimen3= $datap['specimen3'];
					$test_code_sel= "SELECT * FROM tast_code WHERE t_code='$specimen1' OR t_code='$specimen2' OR t_code='$specimen3'" ;
					$test_code_qry= $db-> query($test_code_sel);
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
				
						  ?></small></td>
                <td class="col-md-3 bb_1 textone b_1"><label for="">
                <?php 
				$kdcdoc= $data['doctor_id'];
				$d_sel= "SELECT * FROM doctor WHERE doctor_id=$kdcdoc";
				$d_res= $db->query($d_sel);
				$d_data=$d_res->fetchArray(SQLITE3_ASSOC);
				?>
               <a title="View Doctor" id="detail" class="manag" href="doc_details.php?d=<?php echo $d_data['doctor_id']; ?>" ><?php echo $d_data['d_name']; ?></a></label><small><?php echo $d_data['degree']; ?></small>
               </td>
				<td class="col-md-1 bb_1 b_1 textone"><label for=""><?php if($data['pat_amount']>0){ echo $data['pat_amount'].'/=';}else{ echo 'Free'; } ?></label></td>
                <td class="col-md-2 bb_1 b_1 textone"><label for="">
                	<a title="View Details" class="manag" href="pat_details.php?p=<?php echo $data['lab_id']; ?>"><span id="detail" class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a>
                	<a title="Edit" class="manag"  href="pat_edit.php?p=<?php echo $data['lab_id']; ?>"><span id="edit" class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                	<a title="Delete" class="manag<?php if($_SESSION['role']!=='boss'){echo(' btn hidden');} ?>" href="delete_patient.php?p=<?php echo $data['lab_id']; ?>"><span id="delete" class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </label></td>
            </tr>
		
		 <?php } ?>
		 </tbody>
		</table>
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