<?php 
	ob_start();
	require('config.php');
	$lab_id=$_GET['p']; 
	$update= "UPDATE patient SET status='0' WHERE lab_id='$lab_id'"; 
	if($db->query($update)){
			echo "Update Your Information, Thanks!";
			header('location: view_patient.php');
		 }else{
			 echo "Update not be Saved!";
			}
?>