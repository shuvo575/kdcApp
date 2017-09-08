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
    		<h2 class="title">~~Welcome to~~</h2>
    			<h1 class="main_title">KATIADI &middot; DIAGNOSTIC &middot; CENTER</h1>
    			<hr>
    			<hr>
    			<div class="col-md-6">
    				<form action="search_pat.php" method="get" id="p_form">
    				<h2 class="title"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search Here </h2>
						<div class="col-md-1"></div>
						<div class="col-md-10 form_row">
						  <input style="text-align: center;" id="p_id" type="text" name="search" placeholder="Search by ID, Name, Month or Year!" title="Search Here" required>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-12 text-center">
							<input type="submit" name="go" id="go" value="Search" title="Search">
						</div>
    				</form>
    			</div>
    			<div class="col-md-6">
    			<form action="" method="post" id="p_form">
    			<h2 class="title"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> New Entry </h2>
    				<div class="col-md-1"></div>
					<div class="col-md-10 form_row">
					  <input id="p_id" type="number" name="p_id" style="text-align: center;" placeholder="Enter The Receipt Number Here!" title="Enter The Patient ID Here!" required autofocus>
					</div>
   					<div class="col-md-1"></div>
    				<div class="col-md-12 text-center">
    					<input type="submit" name="go" id="go" value="Add Details" title="Click Here To Add Lab Report.">
    				</div>
    			</form>
    			</div>
			</div>
    	</div>
    </section>
    


		
	<?php 
	if(!empty($_POST)){
     $p_id=$_POST['p_id'];
	header('location: pat_info.php?p_id='.$p_id);
	}
	get_footer(); 
		}else{
				header('location: login.php');
			}
		?>