<?php 
	ob_start();
	require('config.php');
	$doctor_id=$_GET['d']; 
	$update= "UPDATE doctor SET status='0' WHERE doctor_id='$doctor_id'"; 
	if($db-> query($update)){
			echo "Update Your Information, Thanks!";
			header('location: view_doctor.php');
		 }else{
			 echo "Update not be Saved!";
			}
?>