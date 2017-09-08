<?php 
	session_start();
	if(isset($_SESSION['username'])){
	ob_start();
	require('config.php');
	$doctor_id=$_GET['d']; 
	$update= "UPDATE doctor SET status='1' WHERE doctor_id='$doctor_id'"; 
	if($db->query($update)){
			echo "Update Your Information, Thanks!";
			header('location: doc_trash.php');
		 }else{
			 echo "Update not be Saved!";
			}

}else{
		header('location: login.php');
	} 
?>