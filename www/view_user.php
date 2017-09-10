<?php 
	session_start();
	if(isset($_SESSION['username'])){
	require('config.php');
	get_header();
	$sel= "SELECT * FROM users WHERE id AND status='1'";
	$res= $db-> query($sel);
?>


<section class="container-fluid text-center">
	<div class="col-md-12"  style="position: relative;">
	<h2 class="title text-center">--Users List--</h2>
	<hr><div class="col-md-12">
			<a class="edit_button trash" href="user_trash.php"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
			<?php if($_SESSION['role']==='boss'){ ?> <a class="back_button" style="left: 230px;" href="add_user.php"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a><?php } ?>
			<a class="back_button" href="user.php?u=<?php echo $_SESSION['username']; ?>&s=n"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
		</div>
		<table id="datatable" class="container-fluid" cellspacing="0">
        <thead>
            <tr class="row">
                <th class="col-md-1 text-center b_1"><label for="">User ID</label></th>
                <th class="col-md-4 text-center b_1"><label for="">Name</label></th>
                <th class="col-md-4 text-center textone b_1"><label for="">Degree</label></th>
                <th class="col-md-1 text-center textone b_1"><label for="">Role</label></th>
                <th class="col-md-1 text-center textone b_1"><label for="">username</label></th>
                <th class="col-md-1 text-center b_1"><label for="">Manage</label></th>
            </tr>
        </thead>
		<tfoot>
            <tr class="row">
                <th class="col-md-1 text-center bb_1 b_1"><label for="">User ID</label></th>
                <th class="col-md-4 text-center bb_1 b_1"><label for="">Name</label></th>
                <th class="col-md-4 text-center textone bb_1 b_1"><label for="">Degree</label></th>
                <th class="col-md-1 text-center textone bb_1 b_1"><label for="">Role</label></th>
                <th class="col-md-1 text-center textone bb_1 b_1"><label for="">username</label></th>
                <th class="col-md-1 text-center bb_1 b_1"><label for="">Manage</label></th>
            </tr>
        </tfoot>
		<tbody>	
		<?php while($data=$res-> fetchArray(SQLITE3_ASSOC)){ ?>
		<tr class="row hover">
                <td class="col-md-2 bb_1 b_1"><label for=""><?php echo $data['id']; ?></label></td>
                <td class="col-md-4 bb_1 textone b_1"><label for=""><?php echo $data['name']; ?></label></td>
                <td class="col-md-4 bb_1 textone b_1"><label for=""><?php echo $data['degree']; ?></label></td>
                <td class="col-md-1 bb_1 textone b_1 text-capitalize"><label for=""><?php echo $data['role']; ?></label></td>
                <td class="col-md-1 bb_1 textone b_1"><label for=""><?php echo $data['username']; ?></label></td>
                <td class="col-md-3 bb_1 b_1">
                <label for="">
                	<a class="manag<?php if($_SESSION['role']!=='boss'){ echo(' btn hidden');}elseif($data['id']===$_SESSION['id']){ echo(' btn hidden'); } ?>" id="delete" href="user_modify.php?u=<?php echo $data['id']; ?>"> Block</a>
                </label>
                </td>
            </tr>
		
		 <?php } ?>
		 </tbody>
		</table>
			</div>
</section>
<script>
	$(document).ready(function() {
		$('#datatable').DataTable( {
			"lengthMenu": [[5, 10, 25, 50, 100, -1], [05, 10, 25, 50, 100, "All"]]
		} );
	} );
</script>

	
	<?php get_footer(); }else{
		header('location: login.php');
	}  ?>