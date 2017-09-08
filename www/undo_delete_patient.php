<?php 
	session_start();
	if(isset($_SESSION['username'])){
	ob_start();
	require('config.php');
	$lab_id=$_GET['p']; 
	$update= "UPDATE patient SET status='1' WHERE lab_id='$lab_id'"; 
	if($db-> query($update)){
			echo "Update Your Information, Thanks!";
			header('location: patient_trash.php');
		 }else{
			 echo "Update not be Saved!";
			}

}else{
		header('location: login.php');
	} 
?>